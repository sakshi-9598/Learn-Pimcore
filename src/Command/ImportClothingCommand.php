<?php

namespace App\Command;

use Pimcore\Console\AbstractCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Uid\Uuid;
use \Pimcore\Model\DataObject\Category;
use Pimcore\Model\DataObject\Folder;


class ImportClothingCommand extends AbstractCommand
{
    protected function configure(): void
    {
        $this
            ->setName('clothing')
            ->setDescription('Import data from CSV file to Pimcore objects');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $csvFilePath = "/home/sakshi.kushwaha@happiestminds.com/Documents/finalcloth.csv"; // Corrected file path
        $csv = array_map('str_getcsv', file($csvFilePath));
        $headers = array_shift($csv);
        $columnMapping = [
            'CategoryName' => 'setCategoryName', // Adjusted column mapping based on CSV structure
            'CategoryDescription' => 'setCategoryDescription', // Adjusted column mapping based on CSV structure
            // 'Type' => 'Type'
        ];
        
       
        foreach ($csv as $row) {
            // var_dump($row);
            $type = $row[array_search('Type', $headers)];
            $isObject = ($type === 'object');
            // var_dump($isObject);     #TRUE/FALSE

            $parentPath = $row[array_search('storage path', $headers)];
            // var_dump($parentPath);    #"/CLOTHING/MENS/CASUAL WEAR/" 
            
            if ($isObject == True){

                $fol = explode("/", $parentPath);
                var_dump($fol);

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
                    $folderName = str_replace("/","",$parentPath);
                    $folder->setKey($folderName);
                    $folder->setParentId(1);
                }
                //NOW INSIDE FOLDER MAKE OUR MASTER CATEGORIES
                // CHECK if master categories are already  exists or not
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

                //NOW INSIDE MASTER CATEGORY MAKE OUR SUBCATEGORIES
                // CHECK if master categories are already  exists or not
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
            foreach ($columnMapping as $csvColumn => $setterMethod){
                $index = array_search($csvColumn, $headers);
                $value = $row[$index];
                $category->$setterMethod($value);
            }

        $folder->save();
        $category->save();
        }

        $output->writeln("Import successful!");
        return 0;
    }
}