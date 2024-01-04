<?php

namespace App\Command;

use Pimcore\Console\AbstractCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Uid\Uuid;
use \Pimcore\Model\DataObject\Category;
use Pimcore\Model\DataObject\Folder;
use Pimcore\Model\Asset\Image;


class ImportCategoryCommand extends AbstractCommand
{
    protected function configure(): void{
        $this
            ->setName('importcategory')
            ->setDescription('Import data from CSV file to Pimcore objects');
    }

    public function createFolder($parentPath):Folder{

        //Check if the FOLDER already exists or not

        $existingFolder = Folder::getByPath($parentPath);
        // var_dump($existingFolder);   #INITIALLY NOT PRESENT -> NULL

        if ($existingFolder instanceof Folder){
            // $folderId = $existingFolder->getId();
            $folder = $existingFolder;
        }
        else{
            // Folder does not exist, create a new one of any number of levels
            // var_dump($parentPath);  ///Category/MENS/FORMAL WEAR/
            $parts = explode('/', $parentPath);
            $parentPlaceId = 1;
            $prev = NULL;
            for ($i = 1; $i < sizeof($parts); $i++) {
                $folderName =  $parts[$i];  //1:Category, 2:MENS
                // var_dump($folderName);

                // Check if the folder is already exists or not
                $existingFolder = Folder::getByPath($prev.'/'.$folderName);  //Category"
                
                if ($existingFolder instanceof Folder){
                    // $folderId = $existingFolder->getId();
                    $folder = $existingFolder;
                }
                else{
                    // var_dump($folderName);
                    $folder = new Folder();
                    $folder->setKey($folderName);  //Category
                    $folder->setParentId($parentPlaceId);
                    // var_dump($folder->getId());
                }
                $folder->save();
                $parentPlaceId = $folder->getId();   //Category ID
                $prev = $folder->getPath().$folderName;  //CategoryPATH
                // var_dump($prev);   // 1:/Category" , 2:/Category/MENS" , 3: "/Category/MENS/CASUAL WEAR"
            }  
        }
        return $folder;
    }

    //Object exists or not
    public function objectExistOrNot($parentPath):bool | Category {
        $existingObject = Category::getByPath($parentPath);
        if ($existingObject instanceof Category){
            // $folderId = $existingFolder->getId();
            $object = $existingObject;
            return $object;
        }
        return False;
    }

    public function createObjects($parentPath, $folder, $pdtName):Category{
        $existingObject = Category::getByPath($parentPath.$pdtName);

        if ($existingObject instanceof Category){
            
            $object = $existingObject;
        }
        else{
            $object = new Category();
            $object->setKey($pdtName);
            $object->setParentId($folder->getId());
        }
        return $object; 
    }

    public function createVariants($parentPath, $mObject,$pdtName):Category{
        // Check if the PARENTCategory already exists or not

        if ($mObject != False){
            $existingVarCategory = Category::getByPath($parentPath.'/'. $pdtName);
            if ($existingVarCategory instanceof Category){
                
                $variant = $existingVarCategory;
            }
            else{
                $variant = new Category();
                $variant->setKey($pdtName);
                $variant->setParentId($mObject->getId());
            }
            return $variant;
        }    
    }

    public function fillData($columnMapping,$row, $headers, $category):Category{
        foreach ($columnMapping as $csvColumn => $setterMethod){
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
        return $category;
    }

    protected function execute(InputInterface $input, OutputInterface $output){
        $csvFilePath = "/var/www/PIMPROJECTS/myclothing/subcategory.csv"; // Corrected file path
        $csv = array_map('str_getcsv', file($csvFilePath));
        // var_dump($csv);
        $headers = array_shift($csv);
        // var_dump($headers);

        $columnMapping = [
            'CategoryName' => 'setCategoryName', 
            'CategoryDescription' => 'setCategoryDescription', 
            'Image' => 'setCategoryImage',
            'parentCategory' => 'setParentCategory'
        ];
        
        
       
        foreach ($csv as $row) {
            $type = $row[array_search('Type', $headers)];
            $isObject = ($type === 'Object');
            // var_dump($isObject);     #TRUE/FALSE

            $parentPath = $row[array_search('storage path', $headers)];
            // var_dump($parentPath);    #"/CATEGORY" , /CATEGORY/MENS"
            $pdtName = $row[array_search('CategoryName', $headers)];
            
            if ($isObject == True){

                $folder = $this ->createFolder($parentPath);
                //NOW INSIDE FOLDER MAKE OUR OBJECTS
                $category = $this->createObjects($parentPath, $folder, $pdtName);
            }
            else{
                $mCategory = $this->objectExistOrNot($parentPath);
                    if ($mCategory !== false){
                        $category=$this->createVariants($parentPath, $mCategory, $pdtName);
                    }
            }

            //AFTER OBJECTS ARE CREATED SUCCESSFULLY..YOU NEED TO FILL THE DATA
            $category = $this-> fillData($columnMapping,$row, $headers, $category);
            $category->save();      
        }
        $output->writeln("Import successful!");
        return 0;
    }     
}