<?php

namespace App\Controller;
 
use Pimcore\Model\DataObject\Concrete;
use Pimcore\Model\DataObject\ClassDefinition\CalculatorClassInterface;
use Pimcore\Model\DataObject\Data\CalculatedValue;
 
class DiscountController implements CalculatorClassInterface
{
    public function compute(Concrete $object, CalculatedValue $context): string
    {
        if ($context->getFieldname() == "discountedPrice") {
          
            return $object->getPrice() - ($object->getPrice()*$object->getDiscount()/100);
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