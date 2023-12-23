<?php

namespace App\Command;

use Pimcore\Console\AbstractCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use \Pimcore\Model\DataObject\Store;
use Pimcore\Model\DataObject\Folder;


class ImportStoreCommand extends AbstractCommand
{
    protected function configure(): void
    {
        $this
            ->setName('importstore')
            ->setDescription('Import data from CSV file to Pimcore objects');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $csvFilePath = "/var/www/PIMPROJECTS/myclothing/store.csv"; // file path
        $csv = array_map('str_getcsv', file($csvFilePath));
        // var_dump($csv);
        $headers = array_shift($csv);
        // var_dump($headers);

        $columnMapping = [
            'StoreName' => 'setStoreName', 
            'StoreAddress' => 'setStoreAddress', 
            'Rating' => 'setRating',
        ];
        
        
       
        foreach ($csv as $row) {
            // var_dump($row);

            $parentPath = "/STORE";

            //Check if the FOLDER already exists or not

            $existingFolder = Folder::getByPath($parentPath);
            // var_dump($existingFolder);   #INITIALLY NOT PRESENT -> NULL

            if ($existingFolder instanceof Folder){
                // $folderId = $existingFolder->getId();
                $folder = $existingFolder;
            }
            else{
                // Folder does not exist, create a new one
                $folder = new Folder();
                // var_dump($parentPath);
                $folderName = str_replace("/","",$parentPath);
                // // var_dump($folderName);
                $folder->setKey($folderName);
                $folder->setParentId(1);   
            }
            $folder->save();

            //NOW INSIDE FOLDER MAKE OUR Store OBJECTS
            // CHECK if Objects are already  exists or not

            $existingStore = Store::getByPath($parentPath.'/'.$row[array_search('StoreName', $headers)] );

            if ($existingStore instanceof Store){
                    
                $store = $existingStore;
                }
                else{
                    $store = new Store();
                    $storeName = $row[0];
                    $store->setKey($storeName);
                    $store->setParentId($folder->getId());
                }    
            
            //AFTER OBJECTS ARE CREATED SUCCESSFULLY..YOU NEED TO FILL THE DATA

    
            foreach ($columnMapping as $csvColumn => $setterMethod){
                // csvColumn = StoreName
                // setterMethod =  setStoreName
                $index = array_search($csvColumn, $headers);
                $value = $row[$index];
                $store->$setterMethod($value);
            }
            
            $store->save();      
        }
        $output->writeln("ALL Objects of Store class are Import successfully...!");
        return 0;
    }     
}