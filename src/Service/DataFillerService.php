<?php 

namespace App\Service;

use Pimcore\Model\DataObject;

use Pimcore\Model\Asset\Image;
use Pimcore\Model\DataObject\Data\ImageGallery;
use Pimcore\Model\DataObject\Data\Hotspotimage;

use Pimcore\Model\DataObject\Data\RgbaColor;
use Carbon\Carbon;

use  Pimcore\Model\DataObject\Data\QuantityValue;

use Pimcore\Model\DataObject\Objectbrick\Data\GenericSize;
use Pimcore\Model\DataObject\Objectbrick\Data\NumericSize;
use Pimcore\Model\DataObject\Objectbrick\Data\Pattern;
use Pimcore\Model\DataObject\Objectbrick\Data\Season;


class DataFillerService{

    //CLASSIFICATION STORE
    public static function fillClassificationStore($object, $row, $headers){

        $category = explode('/', $row[array_search('Category', $headers)]);
        $cat = $category[array_key_last($category)];

        $closureType = $row[array_search("Closure Type", $headers)];
        $fitType = $row[array_search("Fit Type", $headers)];
        $pocket = $row[array_search("Pocket Description", $headers)];

        $neckStyle = $row[array_search("Neck Style", $headers)];
        $sleeveType = $row[array_search("Sleeve Type", $headers)];

        $kurtilength = $row[array_search("Kurti length", $headers)];
        $kurtiStyle = $row[array_search("kurti Style", $headers)];
        $neckStyle = $row[array_search("Neck Style", $headers)];
        $sleeveType = $row[array_search("Sleeve Type", $headers)];

        $collar = $row[array_search("Collar Type", $headers)];
        $wash = $row[array_search("wash and  care", $headers)];

        //Bottom Wear
        if (($cat ==='JEANS' || $cat === 'SKIRTS and SHORTS' || $cat ==='CASUAL TROUSERS' || $cat === 'FORMAL TROUSERS' || $cat === 'MENS JEANS' || $cat === 'SHORTS' || $cat === 'TRACK PANTS' || $cat === 'GYM TIGHTS' || $cat === 'JOGGERS' || $cat === 'TROUSERS and JEANS')){
            $object->getSpecificDetails()->setActiveGroups([7=>false, 8=>true, 10=>false, 14=>true]);
            $object->getSpecificDetails()->setFieldname("specificDetails");

            //Bottom Wear
            $object->getSpecificDetails()->setLocalizedKeyValue(8, 5 , $closureType);
            $object->getSpecificDetails()->setLocalizedKeyValue(8, 9 , $fitType);
            $object->getSpecificDetails()->setLocalizedKeyValue(8, 10 , $pocket);
        }
                
        //Top Wear
        else if (($cat === 'SHIRTS' or $cat === 'TSHIRTS' or $cat === 'GIRLS TOPS' or $cat === 'TSHIRTS and TOPS' or $cat === 'CASUAL SHIRTS' or $cat === 'FORMAL SHIRTS' or $cat === 'MENS TSHIRTS' or $cat === 'SWEATSHIRTS' or $cat === 'GYM TIGHTS' or $cat === 'DRESSES' or $cat === 'JACKETS and COATS' or $cat === 'SWEATERS' or $cat === 'TOPS' or $cat === 'TSHIRTS and SHIRTS')){
                $object->getSpecificDetails()->setActiveGroups([7=>true, 8=>false, 10=>false, 14=>true]);
                $object->getSpecificDetails()->setFieldname("specificDetails");

                //Top Wear
                $object->getSpecificDetails()->setLocalizedKeyValue(7, 15 , $neckStyle);
                $object->getSpecificDetails()->setLocalizedKeyValue(7, 6 , $sleeveType);
        }
                
        //Womens Kurti
        else if ($cat === 'KURTIS and SUITS'){
            $object->getSpecificDetails()->setActiveGroups([7=>false, 8=>false, 10=>true, 14=>true]);
            $object->getSpecificDetails()->setFieldname("specificDetails");

            //Womens Kurti
            $object->getSpecificDetails()->setLocalizedKeyValue(10, 14 , $kurtilength);
            $object->getSpecificDetails()->setLocalizedKeyValue(10, 16 , $kurtiStyle);
            $object->getSpecificDetails()->setLocalizedKeyValue(10, 15 , $neckStyle);
            $object->getSpecificDetails()->setLocalizedKeyValue(10, 6 , $sleeveType);
        }
                

        else{
            $object->getSpecificDetails()->setActiveGroups([7=>true, 8=>true, 10=>false, 14=>true]);
            $object->getSpecificDetails()->setFieldname("specificDetails");
            //Top and Bottom Wear
            //Bottom Wear
            $object->getSpecificDetails()->setLocalizedKeyValue(8, 5 , "Zipper");
            $object->getSpecificDetails()->setLocalizedKeyValue(8, 9 , "Regular fit");
            $object->getSpecificDetails()->setLocalizedKeyValue(8, 10 , "No pocket");
            //Top Wear
            $object->getSpecificDetails()->setLocalizedKeyValue(7, 15 , "Round neck");
            $object->getSpecificDetails()->setLocalizedKeyValue(7, 6 , "Full Sleeves");
        }
                
        //Specifications
        $object->getSpecificDetails()->setLocalizedKeyValue(14, 8 , $collar);
        $object->getSpecificDetails()->setLocalizedKeyValue(14, 12 , $fitType);
        $object->getSpecificDetails()->setLocalizedKeyValue(14, 24 , $wash);
        
        
        //-- CUSTOMER REVIEW
        $rating = $row[array_search("Rating", $headers)];
        $comments = $row[array_search("comment", $headers)];

        $object->getCustomerReview()->setActiveGroups([15=>true]);
        $object->getCustomerReview()->setFieldname("customerReview");
        $object->getCustomerReview()->setLocalizedKeyValue(15, 22 , $rating);
        $object->getCustomerReview()->setLocalizedKeyValue(15, 23 , $comments);
    }

    // GALLERY
    public static function fillGallery($object, $value){
        
        $imageGallery = new ImageGallery();
        $imagePaths = explode(',', $value);
        // Create an array to store image data
        $hotspotImages = [];
        foreach ($imagePaths as $imagePath) {
            // Check if the image file exists in Pimcore assets
            $image = Image::getByPath($imagePath);
            $hotspotImage = new Hotspotimage($image);
            $hotspotImages[] = $hotspotImage;
            if (count($hotspotImages) === 5){
                break;
            }
        }

        $imageGallery->setItems($hotspotImages);
        $object->setImages($imageGallery); 
    }

    // FILL ALL DATA
    public static function fillAllData($object, $row, $headers, $type){

        if ($type === 'variant'){
            //  SKU
            $object->setSku($row[array_search("sku", $headers)]);

            // COLOR
            $rgbaColor = new RgbaColor;
            $rgbaColor->setHex($row[array_search('Color', $headers)]);
            $object->setColor($rgbaColor);

            // SIZE
            $value = $row[array_search("Generic Size", $headers)];
            $brick = new GenericSize($object);
            $brick->setGenericSize($value);
            $object->getGenericSize()->setGenericSize($brick);

            $value = (float)$row[array_search("Numeric Size", $headers)];
            $brick = new NumericSize($object);
            $brick->setNumericSize($value);
            $object->getNumericSize()->setNumericSize($brick);


            $object->setDiscount($row[array_search("Discount", $headers)]);
        }

        $object->setProductName($row[array_search("English ProductName", $headers)],'en');
        $object->setProductName($row[array_search("German Product Name", $headers)],'de');
        $object->setProductName($row[array_search("Spanish Product Name", $headers)],'es');
        $object->setProductDescription($row[array_search("English Description", $headers)],'en');
        $object->setProductDescription($row[array_search("German Description", $headers)],'de');
        $object->setProductDescription($row[array_search("Spanish Description", $headers)],'es');

        $object->setCountryOfOrigin($row[array_search("CountryOfOrigin", $headers)]);
        $object->setGenericName($row[array_search("GenericName", $headers)]);
        $object->setProductAvailability($row[array_search("Availability", $headers)]);
        $object->setInStockValue($row[array_search("StockSize", $headers)]);
        // $object->setPrice($row[array_search("Price", $headers)]);
        $object->setManufacturerAddress($row[array_search("ManufacturerAddress", $headers)]);
        $object->setMaterialUsed($row[array_search("MaterialUsed", $headers)]);

        

        //    QUANTITY VALUE
        $index = array_search('Weight', $headers);
        $value = $row[$index];
        list($val, $unitAbb) = explode(' ', $value);
        $quantityValue = new QuantityValue($val,$unitAbb);
        $object->setWeight($quantityValue);

        $index = array_search('Length', $headers);
        $value = $row[$index];
        list($val, $unitAbb) = explode(' ', $value);
        $quantityValue = new QuantityValue($val,$unitAbb);
        $object->setLength($quantityValue);

        $index = array_search('width', $headers);
        $value = $row[$index];
        list($val, $unitAbb) = explode(' ', $value);
        $quantityValue = new QuantityValue($val,$unitAbb);
        $object->setWidth($quantityValue);

        $index = array_search('Price', $headers);
        $value = $row[$index];
        list($val, $unitAbb) = explode(' ', $value);
        $quantityValue = new QuantityValue($val,$unitAbb);
        $object->setActualPrice($quantityValue);


        //  DATE
        $dom = Carbon::createFromFormat('Y-m-d' , $row[array_search('Date of Manufacturing', $headers)]);
        $object->setDateOfManufacturing($dom);

        $dom = Carbon::createFromFormat('Y-m-d' , $row[array_search('Next Availability', $headers)]);
        $object->setNextAvailability($dom);

        //  IMAGE
        $imagepath = $row[array_search("Display Image", $headers)];
        $var = Image::getByPath($imagepath);
        $object->setDispalyImage($var);

        //  GALLERY
        $index = array_search("Images", $headers);
        $value = $row[$index];
        DataFillerService::fillGallery($object, $value);
        

        //  RELATION STORE
        $value=$row[array_search('Brand', $headers)];
        $path = "/BRAND/".$value;
        $relation = DataObject::getByPath($path);
        $object->setBrand($relation);

        $value=$row[array_search('Store', $headers)];
        $path = "/STORE/".$value;
        $relation = DataObject::getByPath($path);
        $object->setStore([$relation]);

        $path=$row[array_search('Category', $headers)];
        $relation = DataObject::getByPath($path);
        $object->setCategory($relation);

        //OBJECT BRICKS


        $value = $row[array_search("Season", $headers)];
        $brick = new Season($object);
        $brick->setSeason($value);
        $object->getSeason()->setSeason($brick);

        $pattern = $row[array_search("Pattern", $headers)];
        $design = $row[array_search("Design", $headers)];
        $brick = new Pattern($object);
        $brick->setPatternStyle($pattern);
        $brick->setDesignStyle($design);
        $object->getClothingPattern()->setPattern($brick);

        // CLASSIFICATION STORE
        DataFillerService::fillClassificationStore($object, $row, $headers);
    }

}