<?php

namespace App\Service;

use Pimcore\Model\DataObject\Folder;

class FolderService
{
    //making folder
    public static function createFolder($parentPath):Folder{
    
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
                    $folder = new Folder();
                    $folder->setKey($folderName);  //CLOTHING
                    $folder->setType(Folder::OBJECT_TYPE_FOLDER);
                    $folder->setParentId($parentPlaceId);
                }
                $folder->save();
                $parentPlaceId = $folder->getId();   //CLOTHING ID
                $prev = $folder->getPath().$folderName;  //CLOTHINGPATH
                // var_dump($prev);   // 1:/CLOTHING" , 2:/CLOTHING/MENS" , 3: "/CLOTHING/MENS/CASUAL WEAR"
            }  
        }
        return $folder;
    }
}