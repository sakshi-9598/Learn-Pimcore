<?php

namespace App\OptionsProvider;

use Pimcore\Model\DataObject\ClassDefinition\Data;
use Pimcore\Model\DataObject\Category;

use Pimcore\Model\DataObject\AbstractObject;

use Pimcore\Model\DataObject\ClassDefinition\DynamicOptionsProvider\SelectOptionsProviderInterface;

class MasterSubCategoryOptionsProvider implements SelectOptionsProviderInterface
{


    public function getOptions(array $context, Data $fieldDefinition): array
    {
        $object = isset($context["object"]) ? $context["object"] : null;

        $currentCat= Category::getById(($object ? $object->getId() : "unknown"));

        $parentCategory = Category::getById($object ? $object->getParentId():"unknown");

        $masterParentCategory = Category::getById($parentCategory ? $parentCategory->getParentId():"unknown");

        $masterParentCategoryName = "No Parent";

        if ($masterParentCategory instanceof Category){
                    
            $masterParentCategoryName = $masterParentCategory->getCategoryName();
        }
        

        $fieldname = $masterParentCategoryName;

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