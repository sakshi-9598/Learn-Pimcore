<?php
namespace App\Service;

use Pimcore\Model\DataObject\Clothing;

class ObjectService{
    //making objects
    public static function createObjects($parentPath, $folder, $pdtname):Clothing{
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
    public static function objectExistOrNot($parentPath):bool | Clothing {
        $existingObject = Clothing::getByPath($parentPath);
        if ($existingObject instanceof Clothing){
            // $folderId = $existingFolder->getId();
            $object = $existingObject;
            return $object;
        }
        return False;
    }
 
    //making variants
    public static function createVariants($parentPath, $mObject, $pdtname):Clothing{ 
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
}