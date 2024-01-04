<?php
 
namespace App\EventListener;
use Pimcore\Model\Asset\Image;
 
use Pimcore\Event\Model\ElementEventInterface;
use Pimcore\Event\Model\DataObjectEvent;
use Pimcore\Model\DataObject\Clothing;

use Pimcore\Model\Element\ValidationException;
 
use function Symfony\Component\HttpFoundation\isEmpty;
 
class ObjectListener
{
    /**
     * Filters subcategories of a Product before update.
     *
     * @param ElementEventInterface $e
     * @return void
     */
    public function onObjectPreUpdate(ElementEventInterface $e): void
    {
        if ($e instanceof DataObjectEvent) {
            $object = $e->getObject();
            // dd($object);
            if($object  instanceof Clothing and  $object->getSku() !== ""){
 
                $images = $object->getImages();
                if ($images instanceof \Pimcore\Model\DataObject\Data\ImageGallery) {
                    $imageArray = $images->getItems();

                    if(count($imageArray)>5){
                        throw new ValidationException("Trying to upload more than 5 images.");
                    }
                    $filteredImages = array_filter($imageArray, function ($image) {
    
                        return $image !== null;
                    });
                    $filteredImages = array_slice($filteredImages, 0, 5);
                    $images->setItems($filteredImages);
                }

                // 
        }
    }
    }
}