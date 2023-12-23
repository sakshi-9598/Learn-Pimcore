<?php

namespace App\Command;

use Pimcore\Console\AbstractCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Pimcore\Model\DataObject;
use Pimcore\Model\DataObject\Clothing;
use Pimcore\Model\DataObject\Folder;
use Pimcore\Model\Asset\Image;
use Pimcore\Model\DataObject\Data\ImageGallery;
use Pimcore\Model\DataObject\Data\Hotspotimage;
use Pimcore\Model\DataObject\Objectbrick\Data\CollarType;
// use Pimcore\Model\DataObject\Objectbrick\



class ImportProductCommand extends AbstractCommand
{
    protected function configure(): void
    {
        $this
            ->setName('importproduct')
            ->setDescription('Import data from CSV file to Pimcore objects');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $csvFilePath = "/var/www/PIMPROJECTS/myclothing/finalcloth.csv"; // file path
        $csv = array_map('str_getcsv', file($csvFilePath));
        // var_dump($csv);
        $headers = array_shift($csv);
        // var_dump($headers);

        $columnMapping = [
            'sku' => 'setSku', 
            'English ProductName' => 'getProductName', 
            'English Description' => 'setRating',
            'Color' => '',
            'CountryOfOrigin' => '',
            'Brand' => '',
            'Weight' => '',
            'Category' => '',
            'SubCategory' => '',
            'GenericName' => '',
            'Length' => '',
            'width' => '',
            'Generic Size' => '',
            'Numeric Size' => '',
            'Display Image' => '',
            'Images' => '',
            'StockSize' => '',
            'Next Availability' => '',
            'Price' => '',
            'Discount' => '',
            'Store' => '',
            'ManufacturerAddress' => '',
            'MaterialUsed' => '',
            'Date of Manufacturing' => '',
            'CollarType' => '',
            'Pattern' => '',
            'Season' => '',
            'SleeveType' => '',
            'neck type' => '',
            'rating' => '',
            'comment' => '',
            'German Product Name' => '',
            'Spanish Product Name' => ''

        ];
        
        
       
        foreach ($csv as $row) {
            // var_dump($row);
            $type = $row[array_search('Type', $headers)];
            $isObject = ($type === 'object');
            // var_dump($isObject);     #TRUE/FALSE

            $parentPath = $row[array_search('storage path', $headers)];
            // var_dump($parentPath);    #"/CLOTHING/MENS/FORMAL WEAR/"

            
            if ($isObject == True){

                //Check if the FOLDER already exists or not

                $existingFolder = Folder::getByPath($parentPath);
                // var_dump($existingFolder);   #INITIALLY NOT PRESENT -> NULL

                if ($existingFolder instanceof Folder){
                    // $folderId = $existingFolder->getId();
                    $folder = $existingFolder;
                }
                else{
                    // Folder does not exist, create a new one of any number of levels
                    // var_dump($parentPath);  ///CLOTHING/MENS/FORMAL WEAR/
                    $parts = explode('/', $parentPath);
                    $parentPlaceId = 1;
                    $prev = NULL;
                    for ($i = 1; $i < sizeof($parts); $i++) {
                        $folderName =  $parts[$i];  //1:CLOTHING, 2:MENS
                        // var_dump($folderName);

                        // Check if the folder is already exists or not
                        $existingFolder = Folder::getByPath($prev.'/'.$folderName);  //CLOTHING"
                        
                        if ($existingFolder instanceof Folder){
                            // $folderId = $existingFolder->getId();
                            $folder = $existingFolder;
                        }
                        else{
                            // var_dump($folderName);
                            $folder = new Folder();
                            $folder->setKey($folderName);  //CLOTHING
                            $folder->setParentId($parentPlaceId);
                            // var_dump($folder->getId());
                        }
                        $folder->save();
                        $parentPlaceId = $folder->getId();   //CLOTHING ID
                        $prev = $folder->getPath().$folderName;  //CLOTHINGPATH
                        // var_dump($prev);   // 1:/CLOTHING" , 2:/CLOTHING/MENS" , 3: "/CLOTHING/MENS/CASUAL WEAR"
                    }  
                }

                //NOW INSIDE FOLDER MAKE OUR OBJECTS
                // CHECK if product object is already  exists or not

                $existingCloth = Clothing::getByPath($parentPath.$row[array_search('English ProductName', $headers)] );

                if ($existingCloth instanceof Clothing){
                    
                    $product = $existingCloth;
                }
                else{
                    $product = new Clothing();
                    $productName = $row[array_search('English ProductName', $headers)];
                    $product->setKey($productName);
                    $product->setParentId($folder->getId());
                }
                
                
            }
            else{
                // FOR SUBClothing -- VARIANTS

                // Check if the PARENTClothing already exists or not

                // --------/CLOTHING/WOMENS/TRADITIONAL WEAR/Saree---------

                $existingMClothing = Clothing::getByPath($parentPath);
                //     // var_dump($existingMClothing);   #ALReady exists

                if ($existingMClothing instanceof Clothing){
                    // $folderId = $existingFolder->getId();
                    $mProduct = $existingMClothing;
                }

                //NOW INSIDE Clothing MAKE OUR VARIANTS
                // CHECK if  variants are already  exists or not
                //   "/CLOTHING/WOMENS/TRADITIONAL WEAR/Saree/RoyalBlueSaree"


                $existingVarClothing = Clothing::getByPath($parentPath.'/'.$row[array_search('English ProductName', $headers)] );
                if ($existingVarClothing instanceof Clothing){
                    
                    $product = $existingVarClothing;
                }
                else{
                    $product = new Clothing();
                    $productName = $row[2];
                    $product->setKey($productName);
                    $product->setParentId($mProduct->getId());
                }
            }



            $object = isset($context["object"]) ? $context["object"] : null;
            var_dump($object);

            // SET THE VALUES....
            // RELATION MAPPING
            // $path = $row[array_search('Brand', $headers)];
            // $object = DataObject::getbyPath($path);
            // $product->setBrand($object);


            /////////////---------------------------------------------------------------------/////////
            // $obj = DataObject\Product::getById(418);
            // $product->getNew()->setActiveGroups([1=>true,2=>true,3=>true]);
            // $product->getNew()->setFieldname('new');
            // $product->getNew()->setLocalizedKeyValue(1,5,'clothes');


    ///////////------------------------------------------------------------------------------///////////

            // OBJECT BRICKS
            // $index = array_search("CollarType", $headers);
            // $value = $row[$index];
            
            // $collar = new CollarType($product); 
            // $collar->setCollarType($value);   //string
            // $product->getCollarType()->setCollarType($collar);

    ///////////------------------------------------------------------------------------------////////////
            // GALLERY
            // $imageGallery = new ImageGallery();
            // $imagePaths = explode(',', $value);

            // // Create an array to store image data
            // $hotspotImages = [];

            // foreach ($imagePaths as $imagePath) {
            //     var_dump($imagePath);

            //     // Assuming Hotspotimage is another class in your Pimcore installation

            //     // Check if the image file exists in Pimcore assets
            //     $image = Image::getByPath($imagePath);

            //     $hotspotImage = new Hotspotimage($image);
            //     // var_dump($image);
            //     $hotspotImages[] = $hotspotImage;
            // }

            // $imageGallery->setItems($hotspotImages);
            // //  Set the image data to the ImageGallery
            // // $imageGallery->setItems($imageData); 
            // $product->setImages($imageGallery);   
           


            $product->save();
        }
            
            
        $output->writeln("ALL Objects of Clothing class are Import successfully...!");
        return 0;     
    }

        
}     