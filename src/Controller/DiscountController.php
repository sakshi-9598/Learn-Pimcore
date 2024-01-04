<?php

namespace App\Controller;
 
use Pimcore\Model\DataObject\Concrete;
use Pimcore\Model\DataObject\ClassDefinition\CalculatorClassInterface;
use Pimcore\Model\DataObject\Data\CalculatedValue;
 
class DiscountController implements CalculatorClassInterface
{
    public function compute(Concrete $object, CalculatedValue $context): string
    {
        if (($context->getFieldname() == "discountedPrice") or ($context->getFieldname() == "sellingprice")) {
            if ($object->getActualPrice()){
                return ((float)($object->getActualPrice()->getValue()) - ($object->getActualPrice()->getValue() *$object->getDiscount()/100));
            }
            return "";
            // return 10;
            
        } else {
            \Logger::error("unknown field");
            // return 0;
        }
    }
    public function getCalculatedValueForEditMode(Concrete $object, CalculatedValue $context): string {
       
        $result = $this->compute($object, $context);
        return $result;
    }
}