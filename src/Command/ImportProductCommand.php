<?php
 
namespace App\Command;

use App\Command\Exception;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
// use Pimcore\Bundle\DataImporterBundle\Mapping\Operator\Factory\QuantityValue;
use Pimcore\Model\DataObject\Objectbrick\Data\Laptop;
use Pimcore\Console\AbstractCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use \Pimcore\Model\DataObject\Clothing;
use Pimcore\Model\DataObject\Folder;
use Pimcore\Model\DataObject\Store;
use Pimcore\Model\DataObject\Data\RgbaColor;
use Carbon\Carbon;
use  Pimcore\Model\DataObject\Data\QuantityValue;
 
 
 
use Pimcore\Model\Asset\Image;
use Pimcore\Model\Asset;
 
use Pimcore\Model\DataObject\Data\ImageGallery;
use Pimcore\Model\DataObject\Data\Hotspotimage;
use Pimcore\Model\DataObject;
use Pimcore\Model\DataObject\Category;
use Pimcore\Model\DataObject\Objectbrick\Data\GenericSize;
use Pimcore\Model\DataObject\Objectbrick\Data\NumericSize;
use Pimcore\Model\DataObject\Objectbrick\Data\Pattern;
use Pimcore\Model\DataObject\Objectbrick\Data\Season;

use function iter\isEmpty;

// use Pimcore\Model\DataObject\Product\SpecificDetails;
// use Pimcore\Model\DataObject\Objectbrick\Data\Laptop;
 
// use Pimcore\Bundle\DataHubBundle\Configuration\Workspace\DataObject;
 
class ImportProductCommand extends AbstractCommand
{   
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        parent::__construct();
        $this->mailer = $mailer;
        
    }


    protected function configure(): void
    {
        $this
            ->setName('importproduct')
            ->setDescription('Import data from CSV file to Pimcore objects');
    }

    public function isDateGreaterThanToday(string $dateString): bool{
        $today = new \DateTime();
        $nextAvailabilityDate = \DateTime::createFromFormat('Y-m-d', $dateString);

        // Compare the dates
        return $nextAvailabilityDate > $today;
    }

    public function isDateLessThanToday(string $dateString): bool{
        $today = new \DateTime(); // Current date and time
        $manufacturingDate = \DateTime::createFromFormat('Y-m-d', $dateString);
    
        // Compare the dates
        return $manufacturingDate < $today;

    }

    public function isEmptySKU($currentSKU): bool{
        if ($currentSKU === ""){
            return true;
        }
        return false;
    }

    public function validateSKU($currentSKU): bool{
        $pattern = '/^CLOTH\d+$/';
        if (preg_match($pattern,  $currentSKU )) {
            return  true;
        }
        return false;
    }
 
    //=================================================================================================    
    public function validateProductData($arr, $obj): array
    {
        $allErrors = [];
        // $allErrors[] = ["SKU", ]
        foreach ($arr as $element) {
            # $element =  "Price"
                switch ($element) {

                    case 'Price':
                        $currentRowPrice = $obj[array_search('Price', $arr)];
                        $val = $currentRowPrice;
                        try{
                            list($val, $currency) = explode(' ', $currentRowPrice);
                        }catch (\Exception $e){}

                        $basePrice = floatval($val);
                        if ($basePrice <= 0) {
                            $err = 'Price is '.$currentRowPrice.' : [ Must be greater than 0 ].';
                            array_push($allErrors,$err);
                        }
                        break;

                    case 'Discount':
                        $currentRowDiscount = $obj[array_search('Discount', $arr)];
                        $discount = floatval($currentRowDiscount);
                        if ($discount < 0) {
                            $err = 'Discount is '.$currentRowDiscount.' : [ Must be greater or equal to 0 ].';
                            array_push($allErrors,$err);
                        }
                        break;
                    
                    case 'StockSize':
                        $instock = $obj[array_search('Availability', $arr)];
                        $currentStock = $obj[array_search('StockSize', $arr)];
                        $currentStock = (int)$currentStock;
                        if ($instock == 1){
                            if ($currentStock < 0) {
                                $err = 'Product is InStock but StockSize is '.$currentStock.' : [It Must be greater than 0 ].';
                                array_push($allErrors,$err);
                            }
                        }
                        else{
                            if ($currentStock > 0) {
                                $err = 'Product is not InStock but StockSize is '.$currentStock.' : [ Must be 0 ].';
                                array_push($allErrors,$err);
                            }
                        }
                        break;

                    case 'Length':
                        $currentLength = $obj[array_search('Length', $arr)];
                        $val = $currentLength;
                        try{
                            list($val, $unit) = explode(' ', $currentLength);
                        }catch (\Exception $e){}

                        $baseLength = floatval($val);
                        if ($baseLength < 0) {
                            $err = 'Length is '.$currentLength.' : [ Must be greater than 0 ].';
                            array_push($allErrors,$err);
                        }
                        break;

                    case 'Width':
                        $currentWidth = $obj[array_search('Width', $arr)];
                        $val = $currentWidth;
                        try{
                            list($val, $unit) = explode(' ', $currentWidth);
                        }catch (\Exception $e){}

                        $width = floatval($val);
                        if ($width < 0) {
                            $err = 'Length is '.$currentWidth.' : [ Must be greater than 0 ].';
                            array_push($allErrors,$err);
                        }
                        break;

                    case 'Weight':
                        $currentWeight = $obj[array_search('Weigth', $arr)];
                        $val = $currentWeight;
                        try{
                            list($val, $unit) = explode(' ', $currentWeight);
                        }catch (\Exception $e){}

                        $weight = floatval($val);
                        if ($weight < 0) {
                            $err = 'Weighth is '.$currentWeight.' : [ Must be greater than 0 ].';
                            array_push($allErrors,$err);
                        }
                        break;

                    case 'Next Availability':
                        $nextAvailability = $obj[array_search('Next Availability', $arr)];
                        if (!$this->isDateGreaterThanToday($nextAvailability)){
                            $err = 'Date of Next Availability is '.$nextAvailability.' : [ Must be greater than today ].'; 
                            array_push($allErrors,$err);
                        }
                        break;


                    case 'Date of Manufacturing':
                        $dateOfManufacturing = $obj[array_search('Date of Manufacturing', $arr)];
                        if (!$this->isDateLessThanToday($dateOfManufacturing)){
                            $err = 'Date of Manufacturing is '.$dateOfManufacturing.' : [ Must be less than today ].'; 
                            array_push($allErrors,$err);
                        };
                        break;

                    // case 'Images':
                    
                }
        }
        if (isEmpty($allErrors)){
            // All validations passed
            return [true];
        }
        return $allErrors; 
    }

    //=================================================================================================
    //making folder
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
                        $folder->setType(Clothing::OBJECT_TYPE_FOLDER);
                        $folder->setParentId($parentPlaceId);
                        // var_dump($folder->getId());
                    }
                    $folder->save();
                    $parentPlaceId = $folder->getId();   //CLOTHING ID
                    $prev = $folder->getPath().$folderName;  //CLOTHINGPATH
                    // var_dump($prev);   // 1:/CLOTHING" , 2:/CLOTHING/MENS" , 3: "/CLOTHING/MENS/CASUAL WEAR"
                }  
            }
            return $folder;
    }
    //making objects
    public function createObjects($parentPath, $folder, $pdtname):Clothing{
        $existingObject = Clothing::getByPath($parentPath.$pdtname );
 
        if ($existingObject instanceof Clothing){
            $object = $existingObject;
        }
        else{
            $object = new Clothing();
            // $productName = $row[array_search('English ProductName', $headers)];
            $object->setKey($pdtname);
            $object->setType(Clothing::OBJECT_TYPE_OBJECT);
            $object->setParentId($folder->getId());
        }
        return $object;
    }

    //Object exists or not
    public function objectExistOrNot($parentPath):bool | Clothing {
        $existingObject = Clothing::getByPath($parentPath);
        if ($existingObject instanceof Clothing){
            // $folderId = $existingFolder->getId();
            $object = $existingObject;
            return $object;
        }
        return False;
    }
 
    //making variants
    public function createVariants($parentPath, $mObject, $pdtname):Clothing{ 
        // Check if the PARENTClothing already exists or not
        
        if  ($mObject !== False){
            $existingVarClothing = Clothing::getByPath($parentPath.'/'.$pdtname);
            if ($existingVarClothing instanceof Clothing){
                
                $variant = $existingVarClothing;
            }
            else{
                $variant = new Clothing();
                $variant->setKey($pdtname);
                $variant->setParentId($mObject->getId());
                $variant->setType(Clothing::OBJECT_TYPE_VARIANT);
            }
            return $variant;
        }    
    }

    //CLASSIFICATION STORE
    public function fillClassificationStore($object, $row, $headers){

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
    public function fillGallery($object, $value){
        
        $imageGallery = new ImageGallery();
        $imagePaths = explode(',', $value);
        // Create an array to store image data
        $hotspotImages = [];
        foreach ($imagePaths as $imagePath) {
            // Check if the image file exists in Pimcore assets
            $image = Image::getByPath($imagePath);
            $hotspotImage = new Hotspotimage($image);
            $hotspotImages[] = $hotspotImage;
        }

        // var_dump(sizeof($hotspotImages));

        $imageGallery->setItems($hotspotImages);
        $object->setImages($imageGallery); 
    }

    // FILL ALL DATA
    public function fillAllData($object, $row, $headers, $type){

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
        $this->fillGallery($object, $value);
        

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
        $this->fillClassificationStore($object, $row, $headers);
    }

    //LOG AND SUMMARY
    public function createLogAndSummary($errorstring, $total, $dumbObjects):string{
        $errorFilename = 'ErrorLogs_Clothing_'.date('Y-m-d_H-i-s').'.csv';
        $summaryFileName = 'Summary_Clothing_'.date('Y-m-d_H-i-s').'.csv';
        $errorAsset = new \Pimcore\Model\Asset();
        $summaryAsset = new \Pimcore\Model\Asset();
        $errorAsset->setFilename($errorFilename);
        $summaryAsset->setFilename($summaryFileName);

        if($errorstring !== ""){
            $errorAsset->setData($errorstring);  
            $errorAsset->setParent(\Pimcore\Model\Asset::getByPath("/errorlogs"));
            $errorAsset->save();
        }

        $summary = $total - $dumbObjects." Objects of Clothing class are Import successfully...! \n$dumbObjects Objects are Unsuccessfull";
        $summaryAsset->setData($summary);
        $summaryAsset->setParent(\Pimcore\Model\Asset::getByPath("/errorlogs"));
        $summaryAsset->save();
        return $summary;
    }
 
    //code for the execution
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $csvFilePath = "/var/www/PIMPROJECTS/myclothing/finalcloth.csv"; // file path
        $csv = array_map('str_getcsv', file($csvFilePath));
        $headers = array_shift($csv);

        $errorstring = "";
        
        $columnMapping = [
            'sku' => 'setSku',
            'English ProductName' => 'setProductName',
            'German Product Name' => 'setProductName',
            'Spanish Product Name' => 'setProductName',
            'English Description' => 'setProductDescription',
            'CountryOfOrigin' => 'setCountryOfOrigin',
            'GenericName' => 'setGenericName',
            'StockSize' => 'setInStockValue',
            'Price' => 'setPrice',
            'Discount' => 'setDiscount',
            'ManufacturerAddress' => 'setManufacturerAddress',
            'MaterialUsed' => 'setMaterialUsed',

            'Color' => 'setColor',

            'Weight' => 'setWeight',
            'Length' => 'setLength',
            'width' => 'setWidth',

            'Brand' => 'setBrand',
            'Store' => 'setStore',
            'Category' => 'setCategory',

            'Generic Size' => 'getGenericSize',
            'Numeric Size' => 'getNumericSize',
            'Pattern' => 'getClothingPattern',
            'Season' => 'getSeason',

            'Display Image' => 'setDispalyImage',
            'Images' => 'setImages',
            
            'Next Availability' => 'setNextAvailability',
            'Date of Manufacturing' => 'setDateOfManufacturing',
            
            'Sleeve Type' => 'getSpecificDetails()',
            'Closure Type' => 'getSpecificDetails()',
            'Collar Type' => 'getSpecificDetails()',
            'Fit Type' => 'getSpecificDetails()',
            'Kurti Length' => 'getSpecificDetails()',
            'Kurti Style' => 'getSpecificDetails()',
            'Neck Style' => 'getSpecificDetails()',
            'rating' => '',
            'comment' => '',
            
 
        ];
        
        $total = 0;
        $dumbObjects = 0;

        // CREATION of FOLDERS, OBJECTS and VARIANTS and DATA FILLING...
        foreach ($csv as $row)
        {
            $type = $row[array_search("Type", $headers)];
            $isObject = ($type === "object");     #TRUE/FALSE
 
            $parentPath = $row[array_search('storage Path', $headers)];  #"/CLOTHING/MENS/TOP WEAR/FORMAL SHIRTS"
            $pdtname = $row[array_search("English ProductName", $headers)];

            $total += 1; 
            if ($isObject == true){
                $folder=$this->createFolder($parentPath);
                
                //VALIDATION...

                $res=$this->validateProductData($headers, $row);
                if($res[0]===true){
                    $object=$this->createObjects($parentPath, $folder, $pdtname);
                    //fill the data
                    $this->fillAllData($object, $row, $headers, $type);
                    $object->save();

                    // if either color or size either is present, then set this object as base product and now create it's variant
                    $newParentPath = $parentPath."/". $pdtname;
                    $pdtname = $pdtname."1";
                    $type = "variant";
                    $currentSKU = $row[array_search('sku', $headers)];
                    if (!$this->isEmptySKU($currentSKU)){
                        if  ($this->validateSKU($currentSKU)){
                            $variant=$this->createVariants($newParentPath, $object, $pdtname);
                            $this->fillAllData($variant, $row, $headers, $type);
                            $variant->save();
                        }
                        else{
                            $errorstring .= "Error: On $pdtname : [$type] Row number ".$total." -> " . "[ SKU pattern doesn't match ]"."\n";
                        }
                    }
                    else{
                        $errorstring .= "Error: On $pdtname : [$type] Row number ".$total." -> " . "[ Doesn't create variant because SKU is EMPTY ]"."\n";
                    }
                }
                else{
                    $dumbObjects += 1;
                    foreach($res as $error){
                        $errorstring .= "Error: On $pdtname : [$type] Row number ".$total." -> " .$error."\n";
                    } 
                }
            }
                
            else{
                // $valArr = ['SKU','Model Name','Model Number','Base Price','Selling Price','Delivery Charges','Discount','Length','Breadth','Height'];
                $res=$this->validateProductData($headers, $row);
                if($res[0]===true){
                    $mProduct = $this->objectExistOrNot($parentPath);

                    //object exists...
                    if ($mProduct !== false){

                        //if any object have variants, then object's SKU must be empty
                        $mProduct->setSku("");
                        $mProduct->save();

                        $variant=$this->createVariants($parentPath, $mProduct, $pdtname);

                        //fill the data
                        $this->fillAllData($variant, $row, $headers, $type);
                        $variant->save();
                    }
                    else{
                        $dumbObjects += 1;
                        $errorstring .= "Error: On $pdtname : [$type] Row number ".$total." ->  OBJECT doesn't exist, Trying to make variant of $pdtname \n" ;
                    }
                }
                else{
                    $dumbObjects += 1;  
                    foreach($res as $error){
                        $errorstring .= "Error: On $pdtname : [$type] Row number ".$total." ->  $error.\n";
                    } 
                }
            }

        }

        $this->sendNotificationEmail();

        //LOGS and SUMMARY REPORT
        $summary = $this->createLogAndSummary($errorstring, $total, $dumbObjects);

        $output->writeln($summary);
        return 0;
    }

    //mail notification
    private function sendNotificationEmail(): void
    {

        // Creating the email

        $email = (new Email())

            ->from('sakshikushwaha2018@gmail.com')

            ->to('kshivansh816@gmail.com')

            // ->from($mailerFrom)

            // ->to($mailerTo)

            ->subject('Import Notification')

            ->text('The sakshi import process has been completed successfully. This email is only for testing dec-26');

        // Sending the email

        try {

            $this->mailer->send($email);

        } catch (\Exception $e) {

            // Handle email sending failure (log the error, throw an exception, etc.)

        }

    }
    
}

 