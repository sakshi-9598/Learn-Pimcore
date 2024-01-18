<?php

namespace App\Service;


use function iter\isEmpty;

class ValidatorService
{
    public static function isDateGreaterThanToday(string $dateString): bool{
        $today = new \DateTime();
        $nextAvailabilityDate = \DateTime::createFromFormat('Y-m-d', $dateString);

        // Compare the dates
        return $nextAvailabilityDate > $today;
    }

    public static function isDateLessThanToday(string $dateString): bool{
        $today = new \DateTime(); // Current date and time
        $manufacturingDate = \DateTime::createFromFormat('Y-m-d', $dateString);
    
        // Compare the dates
        return $manufacturingDate < $today;

    }

    public static function isEmptySKU($currentSKU): bool{
        if ($currentSKU === ""){
            return true;
        }
        return false;
    }

    public static function validateSKU($currentSKU): bool{
        $pattern = '/^CLOTH\d+$/';
        if (preg_match($pattern,  $currentSKU )) {
            return  true;
        }
        return false;
    }
 
    //=================================================================================================   
    public static function validateProductData($arr, $obj): array{
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
                        if (!ValidatorService::isDateGreaterThanToday($nextAvailability)){
                            $err = 'Date of Next Availability is '.$nextAvailability.' : [ Must be greater than today ].'; 
                            array_push($allErrors,$err);
                        }
                        break;


                    case 'Date of Manufacturing':
                        $dateOfManufacturing = $obj[array_search('Date of Manufacturing', $arr)];
                        if (!ValidatorService::isDateLessThanToday($dateOfManufacturing)){
                            $err = 'Date of Manufacturing is '.$dateOfManufacturing.' : [ Must be less than today ].'; 
                            array_push($allErrors,$err);
                        };
                        break;

                    
                }
        }
        if (isEmpty($allErrors)){
            // All validations passed
            return [true];
        }
        return $allErrors; 
    }


}