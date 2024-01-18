<?php

namespace App\Command;

use Pimcore\Console\AbstractCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use \Pimcore\Model\DataObject\Store;

use App\Service\FolderService;
use Symfony\Contracts\Translation\TranslatorInterface;


class ImportStoreCommand extends AbstractCommand
{
    private $storeCsvFilePath;
    private TranslatorInterface $translator;

    public function __construct(TranslatorInterface $translator, $storeCsvFilePath){

        parent::__construct();
        $this->storeCsvFilePath = $storeCsvFilePath;
        $this->translator = $translator;
    }

    protected function configure(): void{
        $this
            ->setName('importstore')
            ->setDescription('Import data from CSV file to Pimcore objects');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $csv = array_map('str_getcsv', file($this->storeCsvFilePath));
        $headers = array_shift($csv);

        $columnMapping = [
            'StoreName' => 'setStoreName',
            'StoreAddress' => 'setStoreAddress', 
            'Rating' => 'setRating',
        ];

        $total = 0;
        
        foreach ($csv as $row) {

            $parentPath = "/STORE";

            //Check if the FOLDER already exists or not

            $folder=FolderService::createFolder($parentPath);
            $folder->save();

            //NOW INSIDE FOLDER MAKE OUR Store OBJECTS
            // CHECK if Objects are already  exists or not
            $total += 1;
            $storeName = $row[array_search("StoreName", $headers)];

            $existingStore = Store::getByPath($parentPath.'/'.$storeName );

            if ($existingStore instanceof Store){
                    
                $store = $existingStore;
                }
                else{
                    $store = new Store();
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

        $key = 'store_final_message';
        $final_msg = $this->translator->trans($key, ['total' => $total]). "\n";
        $output->writeln($final_msg);
        return 0;
    }     
}