<?php

namespace App\Command;

use Pimcore\Console\AbstractCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use \Pimcore\Model\DataObject\Brand;

use App\Service\FolderService;

use Pimcore\Model\Asset\Image;

use Symfony\Contracts\Translation\TranslatorInterface;



class ImportBrandCommand extends AbstractCommand
{
    private $brandCsvFilePath;
    private TranslatorInterface $translator;

    public function __construct(TranslatorInterface $translator, $brandCsvFilePath){

        parent::__construct();
        $this->brandCsvFilePath = $brandCsvFilePath;
        $this->translator = $translator;
    }

    protected function configure(): void
    {
        $this
            ->setName('importbrand')
            ->setDescription('Import data from CSV file to Pimcore objects');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $csv = array_map('str_getcsv', file($this->brandCsvFilePath));
        $headers = array_shift($csv);

        $columnMapping = [
            'BrandName' => 'setBrandName', 
            'BrandDescription' => 'setBrandDescription', 
            'countryOfOrigin' => 'setCountryOfOrgin',
            'BrandLogo' => 'setBrandLogo'
        ];
        
        $total = 0;

        foreach ($csv as $row) {

            $parentPath = "/BRAND";
            //Check if the FOLDER already exists or not

            $folder=FolderService::createFolder($parentPath);
            $folder->save();

            //NOW INSIDE FOLDER MAKE OUR BRAND OBJECTS
            // CHECK if Objects are already  exists or not
            $total += 1;
            $brandName = $row[array_search("BrandName", $headers)];
            $existingBrand = Brand::getByPath($parentPath.'/'.$brandName);

            if ($existingBrand instanceof Brand){
                $brand = $existingBrand;
                }
            else{
                $brand = new Brand();
                $brand->setKey($brandName);
                $brand->setParentId($folder->getId());
            }    

            //AFTER OBJECTS ARE CREATED SUCCESSFULLY..YOU NEED TO FILL THE DATA
            foreach ($columnMapping as $csvColumn => $setterMethod){
                // csvColumn = BrandName
                // setterMethod =  setBrandName
                $index = array_search($csvColumn, $headers);
                $value = $row[$index];

                if ($csvColumn === 'BrandLogo') {
                    $imageId = $value;

                    if (!empty($imageId)) {
                        // Check if the image exists
                        $image = Image::getById($imageId);

                        if ($image instanceof Image) {
                            // Image exists, set it using the specified setter method
                            $brand->$setterMethod($image);
                        } 
                        else {
                            echo "Image with ID $imageId not found.\n"; 
                        }
                    }
                }
                else{
                    $brand->$setterMethod($value);
                }
            }
            $brand->save();      
        }

        $key = 'brand_final_message';
        $final_msg = $this->translator->trans($key, ['total' => $total]). "\n";
        $output->writeln($final_msg);
        return 0;
    }     
}