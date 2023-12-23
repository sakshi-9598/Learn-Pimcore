<?php

namespace App\Command;

use Pimcore\Console\AbstractCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use \Pimcore\Model\DataObject\Clothing;
use Pimcore\Model\DataObject\Folder;
use Pimcore\Model\Asset\Image;
use Pimcore\Model\DataObject\Data\QuantityValue;
use Pimcore\Model\DataObject\QuantityValue\Unit;
use Pimcore\Model\DataObject\Data\ImageGallery;
use Carbon\Carbon;
use Pimcore\Model\DataObject\Data\RgbaColor;




class ImportClothingCommand extends AbstractCommand
{
    protected function configure(): void
    {
        $this
            ->setName('importcloth')
            ->setDescription('Import data from CSV file to Pimcore objects');
    }

   

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $csvFilePath = "/var/www/PIMPROJECTS/myclothing/clothing.csv"; // file path
        $csv = array_map('str_getcsv', file($csvFilePath));
        // var_dump($csv);
        $headers = array_shift($csv);
        // var_dump($headers);

        $columnMapping = [
            'sku' => 'setSku', 
            'English ProductName' => 'setProductName', 
            'English Description' => 'setProductDescription',
            'Color' => 'setColor',
            'CountryOfOrigin' => 'setCountryOfOrigin',
            // 'Brand' => '',
            'Weight' => 'setWeight',
            // 'Category' => '',
            // 'SubCategory' => '',
            // 'GenericName' => 'setGenericName',
            'Length' => 'setLength',
            'width' => 'setWidth',
            // 'Generic Size' => 'setGenericSize',
            // 'Numeric Size' => 'setNumericSize',
            // 'Display Image' => 'setDispalyImage',
            'Images' => 'setImages',
            // 'StockSize' => 'setInStockValue',
            'Next Availability' => 'setNextAvailability',
            // 'Price' => 'setPrice',
            // 'Discount' => 'setDiscount',
            // 'Store' => '',
            // 'ManufacturerAddress' => 'setManufacturerAddress',
            // 'MaterialUsed' => 'setMaterialUsed',
            'Date of Manufacturing' => 'setDateOfManufacturing',
            // 'CollarType' => 'setCollarType',
            // 'Pattern' => 'setPattern',
            // 'Season' => 'setSeason',
            // 'SleeveType' => 'etSleeveType',
            // 'neck type' => 'setNeckType',
            // 'rating' => '',
            // 'comment' => '',
            'German Product Name' => 'setProductName',
            'Spanish Product Name' => 'setProductName'

        ];


        
        
       
        foreach ($csv as $row) {
            // var_dump($row);
            $type = $row[array_search('Type', $headers)];
            $isObject = ($type === 'object');
            // var_dump($isObject);     #TRUE/FALSE

            $parentFolder = "CLOTHING";
            // var_dump($parentPath);    #"/CLOTHING/MENS/CASUAL WEAR/"

            
            if ($isObject == True){

                //////////+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++///////////
                //Check if the MAIN FOLDER already exists or not

                $existingFolder = Folder::getByPath("/".$parentFolder);
                // var_dump($existingFolder);   #INITIALLY NOT PRESENT -> NULL

                if ($existingFolder instanceof Folder){
                    // $folderId = $existingFolder->getId();
                    $folder = $existingFolder;
                }
                else{
                    // Main Clothing Folder does not exist, create a new one
                    $parentPlaceId = 1;
                    $folder = new Folder();
                    $folder->setKey($parentFolder);
                    $folder->setParentId($parentPlaceId);                     
                } 
                $folder->save();
                $parentPlaceId = $folder->getId();

                // make levels of folder inside Main Folder
                $category = $row[array_search('Category', $headers)];
                // var_dump($category);
                $existingCatFolder = Folder::getByPath("/".$parentFolder."/".$category);
                if ($existingCatFolder instanceof Folder){
                    $folder2 = $existingCatFolder;
                }
                else{
                    // Main Clothing Folder does not exist, create a new one
                    $folder2 = new Folder();
                    $folder2->setKey($category);
                    $folder2->setParentId($parentPlaceId);     
                }
                $folder2->save();
                $parentPlaceId = $folder2->getId();

                //Make third level
                $subCategory = $row[array_search('Subcategory', $headers)];
                // var_dump($subCategory);
                $subCategoryPath = "/".$parentFolder."/".$category."/".$subCategory;
                $existingSubcatFolder = Folder::getByPath($subCategoryPath);
                if ($existingSubcatFolder instanceof Folder){
                    $folder3 = $existingSubcatFolder;
                }
                else{
                    // Main Clothing Folder does not exist, create a new one
                    $folder3 = new Folder();
                    $folder3->setKey($subCategory);
                    $folder3->setParentId($parentPlaceId);
                }
                $folder3->save();
                $parentPlaceId = $folder3->getId(); 
                //////////+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++////////////



                // NOW INSIDE FOLDER MAKE OUR OBJECTS
                // CHECK if product object is already  exists or not

                $existingCloth = Clothing::getByPath($subCategoryPath.$row[array_search('English ProductName', $headers)] );
                if ($existingCloth instanceof Clothing){
                    $product = $existingCloth;
                }
                else{
                    $product = new Clothing();
                    $productName = $row[array_search('English ProductName', $headers)];
                    $product->setKey($productName);
                    $product->setParentId($parentPlaceId);
                }
            }

            // else{
            //     // FOR SUBClothing -- VARIANTS

            //     // Check if the PARENTClothing already exists or not

            //     $existingMClothing = Clothing::getByPath($parentPath);
            //     // var_dump($parentPath);    #"/Clothing/MENS"
            //     // var_dump($existingMClothing);   #ALReady exists

            //     if ($existingMClothing instanceof Clothing){
            //         // $folderId = $existingFolder->getId();
            //         $mClothing = $existingMClothing;
            //     }
            //     else{
            //         //PARENT Clothing DOES NOT EXIST, CREATE A NEW
            //     }

            //     //NOW INSIDE sub Clothing MAKE OUR SUBCATEGORIES
            //     // CHECK if  sub categories are already  exists or not
            //     // "/Clothing/MENS/CASUAL WEAR"
            //     $existingSubClothing = Clothing::getByPath($parentPath.'/'.$row[array_search('ClothingName', $headers)] );

            //     if ($existingSubClothing instanceof Clothing){
                    
            //         $Clothing = $existingSubClothing;
            //     }
            //     else{
            //         $Clothing = new Clothing();
            //         $ClothingName = $row[0];
            //         $Clothing->setKey($ClothingName);
            //         $Clothing->setParentId($mClothing->getId());
            //     }

                
            // }

            //AFTER OBJECTS ARE CREATED SUCCESSFULLY..YOU NEED TO FILL THE DATA

    
            foreach ($columnMapping as $csvColumn => $setterMethod){
                // var_dump($csvColumn);        // csvColumn = ClothingName
                // var_dump($setterMethod);    // setterMethod =  setClothingName
                $index = array_search($csvColumn, $headers);
                // var_dump($index);
                $value = $row[$index];
                // var_dump($value);

                ///////---------------------------------------------------------------------------------////////
                // DATE
                // Date of Manufacturing
                // $dom = Carbon::createFromFormat('Y-m-d' , $row[array_search('Date of Manufacturing', $headers)]);
                // $product->setDateOfManufacturing($dom);

                // // COLOR
                // $rgbaColor = new RgbaColor;
                // $rgbaColor->setHex($row[array_search('Color', $headers)]);
                // $product->setColor($rgbaColor);


                ///////----------------------------------------------------------------------------------/////////

                // GALLERY
                
                if  ($csvColumn == 'Images'){
                    $imageGallery = new ImageGallery();
                    $imagePaths = explode(',', $value);

                    // Create an array to store image data
                    $imageData = [];


                    foreach ($imagePaths as $imagePath) {
                        var_dump($imagePath);
                        // Check if the image file exists in Pimcore assets
                        $image = Image::getByPath($imagePath);
                        // var_dump($image);
                        if ($image instanceof Image){
                            // Image exists, add it to the array
                            $imageData[] = [
                                'id' => $image->getId(),
                                'type' => 'image',
                            ];
                        }
                        else {
                            echo "Image with path $imagePath not found.\n"; // Debug output
                        }     
                    }
                    //  Set the image data to the ImageGallery
                    $imageGallery->setItems($imageData); 
                    $product->setImages($imageGallery);
                }



                //////----------------------------------------------------------------------------------//////////

                // //     // Check if the column is a Quantity Value
                //     if  ($csvColumn == 'Weight'){
                //         $index = array_search('Weight', $headers);
                //         $value = $row[$index];
                //         var_dump($value);  //"12 g"

                //         list($val, $unitAbb) = explode(' ', $value);
                //         var_dump($val);
                //         var_dump($unitAbb);
                //         $quantityValue = new QuantityValue($val,$unitAbb);

                //         $product->setWeight($quantityValue);
                //     }
                $product->save();
            }
        }
        $output->writeln("ALL Objects of Clothing class are Import successfully...!");
        return 0;
   } 
}   
