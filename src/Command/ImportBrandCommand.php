<?php

namespace App\Command;

use Pimcore\Console\AbstractCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Uid\Uuid;
use \Pimcore\Model\DataObject\Brand;
use Pimcore\Model\DataObject\Folder;
use Pimcore\Model\Asset\Image;


class ImportBrandCommand extends AbstractCommand
{
    protected function configure(): void
    {
        $this
            ->setName('importbrand')
            ->setDescription('Import data from CSV file to Pimcore objects');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $csvFilePath = "/var/www/PIMPROJECTS/myclothing/brand.csv"; // Corrected file path
        $csv = array_map('str_getcsv', file($csvFilePath));
        // var_dump($csv);
        $headers = array_shift($csv);
        // var_dump($headers);

        $columnMapping = [
            'BrandName' => 'setBrandName', 
            'BrandDescription' => 'setBrandDescription', 
            'countryOfOrigin' => 'setCountryOfOrgin',
            'BrandLogo' => 'setBrandLogo'
        ];
        
        
       
        foreach ($csv as $row) {
            // var_dump($row);
            // var_dump($isObject);     #TRUE/FALSE

            $parentPath = "/BRAND";

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
                // // var_dump($folderName);
                $folder->setKey($folderName);
                $folder->setParentId(1);
                
            }

            //NOW INSIDE FOLDER MAKE OUR BRAND OBJECTS
            // CHECK if Objects are already  exists or not

            $existingBrand = Brand::getByPath($parentPath.'/'.$row[array_search('BrandName', $headers)] );

            if ($existingBrand instanceof Brand){
                    
                $brand = $existingBrand;
                }
                else{
                    $brand = new Brand();
                    $brandName = $row[0];
                    $brand->setKey($brandName);
                    $brand->setParentId($folder->getId());
                }    
            
            //AFTER OBJECTS ARE CREATED SUCCESSFULLY..YOU NEED TO FILL THE DATA

    
            foreach ($columnMapping as $csvColumn => $setterMethod){
                // csvColumn = BrandName
                // setterMethod =  setBrandName
                $index = array_search($csvColumn, $headers);
                $value = $row[$index];

                // Check if the column is an logo column
                if ($csvColumn === 'BrandLogo') {
                    // Handle logo olumn
                    $imageId = $value;

                    if (!empty($imageId)) {
                        // Check if the image exists
                        $image = Image::getById($imageId);

                        if ($image instanceof Image) {
                            // Image exists, set it using the specified setter method
                            $brand->$setterMethod($image);
                        } 
                        else {
                            echo "Image with ID $imageId not found.\n"; 
                        }
                    }
                }
                else{
                    $brand->$setterMethod($value);
                }
            }
            $folder->save();
            $brand->save();      
        }
        $output->writeln("ALL Objects of BRAND class are Import successfully...!");
        return 0;
    }     
}