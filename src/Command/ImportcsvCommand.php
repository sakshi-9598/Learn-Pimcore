<?php

namespace App\Command;

use Pimcore\Console\AbstractCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Uid\Uuid;
use \Pimcore\Model\DataObject\Category;
use Pimcore\Model\DataObject\Folder;
use Pimcore\Model\Asset\Image;


class ImportcsvCommand extends AbstractCommand
{
    protected function configure(): void
    {
        $this
            ->setName('importcsv')
            ->setDescription('Import data from CSV file to Pimcore objects');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $csvFilePath = "/var/www/PIMPROJECTS/myclothing/categories.csv"; // Corrected file path
        $csv = array_map('str_getcsv', file($csvFilePath));
        // var_dump($csv);
        $headers = array_shift($csv);
        // var_dump($headers);

        $columnMapping = [
            'CategoryName' => 'setCategoryName', 
            'CategoryDescription' => 'setCategoryDescription', 
            'Image' => 'setCategoryImage'
        ];
        
        
       
        foreach ($csv as $row) {
            // var_dump($row);
            $type = $row[array_search('Type', $headers)];
            $isObject = ($type === 'Object');
            // var_dump($isObject);     #TRUE/FALSE

            $parentPath = $row[array_search('storage path', $headers)];
            // var_dump($parentPath);    #"/CATEGORY" , /CATEGORY/MENS"
            
            if ($isObject == True){

                //Check if the FOLDER already exists or not

                $existingFolder = Folder::getByPath($parentPath);
                // var_dump($existingFolder);   #INITIALLY NOT PRESENT -> NULL

                if ($existingFolder instanceof Folder){
                    // $folderId = $existingFolder->getId();
                    $folder = $existingFolder;
                }
                else{
                    // Folder does not exist, create a new one
                    $folder = new Folder();
                    // var_dump($parentPath);
                    $folderName = str_replace("/","",$parentPath);
                    // var_dump($folderName);
                    $folder->setKey($folderName);
                    $folder->setParentId(1);
                }

                //NOW INSIDE FOLDER MAKE OUR MASTER CATEGORIES
                // CHECK if master categories are already  exists or not

                // var_dump($row[array_search('CategoryName', $headers)]);
                #   /CATEGORY/MENS
                // $existingMCategory = Category::getByPath("/CATEGORY/MENS");

                $existingMCategory = Category::getByPath($parentPath.'/'.$row[array_search('CategoryName', $headers)] );

                if ($existingMCategory instanceof Category){
                    
                    $category = $existingMCategory;
                }
                else{
                    $category = new Category();
                    $categoryName = $row[0];
                    $category->setKey($categoryName);
                    $category->setParentId($folder->getId());
                }
                
                
            }
            else{
                // FOR SUBCATEGORY -- VARIANTS

                // Check if the PARENTCATEGORY already exists or not

                $existingMCategory = Category::getByPath($parentPath);
                // var_dump($parentPath);    #"/CATEGORY/MENS"
                // var_dump($existingMCategory);   #ALReady exists

                if ($existingMCategory instanceof Category){
                    // $folderId = $existingFolder->getId();
                    $mCategory = $existingMCategory;
                }
                else{
                    //PARENT CATEGORY DOES NOT EXIST, CREATE A NEW
                }

                //NOW INSIDE CATEGORY MAKE OUR SUBCATEGORIES
                // CHECK if  sub categories are already  exists or not
                // "/CATEGORY/MENS/CASUAL WEAR"
                $existingSubCategory = Category::getByPath($parentPath.'/'.$row[array_search('CategoryName', $headers)] );

                if ($existingSubCategory instanceof Category){
                    
                    $category = $existingSubCategory;
                }
                else{
                    $category = new Category();
                    $categoryName = $row[0];
                    $category->setKey($categoryName);
                    $category->setParentId($mCategory->getId());
                }

                
            }

            //AFTER OBJECTS ARE CREATED SUCCESSFULLY..YOU NEED TO FILL THE DATA

    
            foreach ($columnMapping as $csvColumn => $setterMethod){
                // csvColumn = CategoryName
                // setterMethod =  setCategoryName
                $index = array_search($csvColumn, $headers);
                $value = $row[$index];

                // Check if the column is an image column
                if ($csvColumn === 'Image') {
                    // Handle image column
                    $imageId = $value;
                    if (!empty($imageId)) {
                        // Check if the image exists
                        $image = Image::getById($imageId);

                        if ($image instanceof Image) {
                            // Image exists, set it using the specified setter method
                            $category->$setterMethod($image);
                        } 
                        else {
                            echo "Image with ID $imageId not found.\n"; 
                        }
                    }
                }
                else{
                    $category->$setterMethod($value);
                }
            }
            $folder->save();
            $category->save();      
        }
        $output->writeln("Import successful!");
        return 0;
    }     
}