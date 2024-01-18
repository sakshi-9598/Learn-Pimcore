<?php

namespace App\Command;

use Pimcore\Console\AbstractCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use \Pimcore\Model\DataObject\Category;
use App\Service\FolderService;
use Pimcore\Model\Asset\Image;

use Symfony\Contracts\Translation\TranslatorInterface;


class ImportCategoryCommand extends AbstractCommand
{
    private $categoryCsvFilePath;
    private TranslatorInterface $translator;

    public function __construct(TranslatorInterface $translator, $categoryCsvFilePath){

        parent::__construct();
        $this->categoryCsvFilePath = $categoryCsvFilePath;
        $this->translator = $translator;
    }

    protected function configure(): void{
        $this
            ->setName('importcategory')
            ->setDescription('Import data from CSV file to Pimcore objects');
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

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $csv = array_map('str_getcsv', file($this->categoryCsvFilePath));
        $headers = array_shift($csv);

        $columnMapping = [
            'CategoryName' => 'setCategoryName', 
            'CategoryDescription' => 'setCategoryDescription', 
            'Image' => 'setCategoryImage',
            'parentCategory' => 'setParentCategory'
        ];
        
        
        $total = 0;
        foreach ($csv as $row) {
            $type = $row[array_search('Type', $headers)];
            $isObject = ($type === 'Object');
            // var_dump($isObject);     #TRUE/FALSE

            $parentPath = $row[array_search('storage path', $headers)];
            // var_dump($parentPath);    #"/CATEGORY" , /CATEGORY/MENS"
            $pdtName = $row[array_search('CategoryName', $headers)];
            
            $total += 1;
            if ($isObject == True){

                $folder=FolderService::createFolder($parentPath);
                    
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
        $key = 'category_final_message';
        $final_msg = $this->translator->trans($key, ['total' => $total]). "\n";
        $output->writeln($final_msg);
        return 0;
    }     
}