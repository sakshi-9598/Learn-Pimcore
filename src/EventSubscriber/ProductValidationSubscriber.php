<?php

namespace App\EventSubscriber;

use Pimcore\Model\DataObject\Category;
use Pimcore\Model\Element\ValidationException;
use Pimcore\Event\Model\DataObjectEvent;
use Pimcore\Model\DataObject\Clothing;

class ProductValidationSubscriber{

    public function onPreUpdate(DataObjectEvent $event)
    {
        // $this->checkClothingclassValidations($event);
    }

    private function checkClothingclassValidations(DataObjectEvent $event){
        $object = $event->getObject();
        if ($object instanceof Clothing){
            $this->validateSku($object);
            // $this->validateSubcategory($object);
            // $this->validateGallery($object);
            $this->validatePrice($object);
            $this->validateSockValue($object);
        }
    }

    private function validateGallery($object){
        $images = $object->getImages();
        if ($images != null && count($images->getItems())>5){
            throw new ValidationException('Only 5 images can be added');
        }
    }

    private function validateSockValue($object)
    {
        $stock = $object->getInStockValue();
        if ($stock <= 0){
            throw new ValidationException('Please enter a valid  stock value');
        }

    }

    private function validatePrice($object)
    {
        $price = $object->getPrice();
        if ($price <= 0){
            throw new ValidationException('Price should be greater than 0');
        }

    }

    private function validateSku($object)
    {
        $sku = $object->getSku();
        if ($sku === ''){
            throw new ValidationException('Empty SKU. Please fill it');
        }
    }

    private function validateSubcategory($object)
    {
        // Check if the object is an instance of Prod
            $category = $object->getCategory();
            $subcategory = $object->getSubCategory();

            // Validate category and subcategory
            $this->validateCategoryAndSubcategory($category, $subcategory);
    }

    private function validateCategoryAndSubcategory(Category $category, ?Category $subcategory)
    {
        // Check if subcategory is null or a child of the selected category
        if ($subcategory instanceof Category && $subcategory->getParentId() !== $category->getId()) {
            // If validation fails, you can throw an exception or handle the error as needed
            throw new ValidationException('Validation failed for SubCategory field');
        }

    }
}