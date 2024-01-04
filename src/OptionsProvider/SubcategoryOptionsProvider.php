<?php

namespace App\OptionsProvider;

use Pimcore\Model\DataObject\ClassDefinition\Data;
use Pimcore\Model\DataObject\Clothing;

use Pimcore\Model\DataObject\AbstractObject;

use Pimcore\Model\DataObject\ClassDefinition\DynamicOptionsProvider\SelectOptionsProviderInterface;


class SubcategoryOptionsProvider implements SelectOptionsProviderInterface
{


    public function getOptions(array $context, Data $fieldDefinition): array
    {
        $object = isset($context["object"]) ? $context["object"] : null;

        // $currentCat= Category::getById(($object ? $object->getId() : "unknown"));

        $parentCategory = Clothing::getById($object ? $object->getParentId():"unknown");

        $parentCategoryName = "";

        if ($parentCategory instanceof Clothing){
                    
            $parentCategoryName = $parentCategory->getProductName('en');
        }
        

        $fieldname = $parentCategoryName;

        $options  = array(
            array("key" => $fieldname , "value" => 5)
            );
            return $options;
        }


    /**
     * Returns the value which is defined in the 'Default value' field
     */
    public function getDefaultValue(array $context, Data $fieldDefinition): ?string 
    {
        return $fieldDefinition->getDefaultValue();
    }

    public function hasStaticOptions(array $context, Data $fieldDefinition): bool
    {
        return true; // Options are dynamically generated
    }

}