<?php
// src/YourBundle/Command/ExportDataToCsvCommand.php
 
namespace App\Command;
// use Pimcore\Model\DataObject\Objectbrick;
use Pimcore\Console\AbstractCommand;
use Pimcore\Model\Asset;
use Pimcore\Model\Asset\Folder;
use Pimcore\Model\DataObject\Category;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Pimcore\Model\DataObject;
use Pimcore\Model\DataObject\Clothing;
use Pimcore\Model\DataObject\Objectbrick\Data\Laptop;
 
class ExportProductCommand extends AbstractCommand
{
    protected function configure()
    {
        $this
            ->setName('exportcsv')
            ->setDescription('Export data to a CSV file and save it in assets');
    }
 
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        // Use fgets to get user input
        $output->write('Enter filename, which you want to give to your csv file : ');
        $filename = trim(fgets(STDIN));
        if ($filename === ''){
            $filename = 'exported';
        }
        
        $output->writeln('Note -> This filename include date and time by default, Do you want to continue with this format: ');
        $userInput = trim(fgets(STDIN));
        $lowercaseInput = strtolower($userInput);
        // Check if the user entered yes or no
        if ($lowercaseInput === 'yes' || $lowercaseInput === 'y') {
            $timestamp = date('dFY_His');
            $finalFileName = $timestamp.'_'.$filename.'.csv';
        } elseif ($lowercaseInput === 'no' || $lowercaseInput === 'n') {
            $finalFileName = $filename.'.csv';
        } else {
            $output->writeln("Invalid input.");
            $finalFileName = "";
        }

        $productListing = new Clothing\Listing();
        $productListing->load();
        $data = [];
    
        foreach ($productListing as $product) {
            $productData = [
                'SKU' => $product->getSku(),
                'English Name' => $product->getProductName('en'),
                'German Name' => $product->getProductName('de'),
                'Spanish Name' => $product->getProductName('es'),
                'English Description' => $product->getProductDescription('en'),
                'German Description' => $product->getProductDescription('de'),
                'Spanish Description' => $product->getProductDescription('es'),
                
                'Country' => $product->getCountryOfOrigin(),
                'ActualPrice' => $product->getActualPrice(),
                'Discount' => $product->getDiscount(),
                

                // COLOR
                'Color' => $product->getColor()->getHex(),


                // RELATION
                'Category' => $product->getCategory()->getKey(),
                'Brand' => $product->getBrand()->getKey(),
                'Store' => $product->getStore()[0]->getKey(),


                // QUANTITY VALUE
                'Weight' => $product->getWeight(),
                'Length' => $product->getLength(),
                'Width' => $product->getWidth(),
                'DiscountedPrice' => $product->getDiscountedPrice(),

                'Manufacturer Address' => $product->getManufacturerAddress(),
                'Material Used' => $product->getMaterialUsed(),
              
                'Stock value'=> $product->getInStockValue(),
               
                // OBJECT BRICKS
                'Season' => $product->getSeason()?->getSeason()?->getSeason(),
                'Numeric Size' => $product->getNumericSize()?->getNumericSize()?->getNumericSize(),
                'Generic Size' => $product->getGenericSize()?->getGenericSize()?->getGenericSize(),
                'Pattern' => $product->getClothingPattern()?->getPattern()?->getPatternStyle(),
                'Pattern' => $product->getClothingPattern()?->getPattern()?->getDesignStyle(),
            ];
    
            $data[] = $productData;
        }
        // Create a CSV string
        $csv = $this->arrayToCsv($data);
    
        // Define the file path to save the CSV
        
        $csvFilePath = '/var/www/PIMCLONE/public/bundles/assets/exported_data.csv';
    
        // Check if the directory exists, and create it if not
        if (!is_dir(dirname($csvFilePath))) {
            mkdir(dirname($csvFilePath), 0755, true);
        }
        // Save the CSV to a file
        file_put_contents($csvFilePath, $csv);

        // Save the CSV file as an asset
        $folderPath = '/EXPORTSCSV';
        $folder = Folder::getByPath($folderPath);
    
        if (!$folder instanceof Folder) {
            $folder = new Folder();
            $folder->setKey('EXPORTSCSV');
            $folder->setParentId(Asset\Folder::getByPath('/')->getId());
            $folder->save();
        }
    
        $asset = new Asset();
        $asset->setParentId($folder->getId());
        $asset->setData(file_get_contents($csvFilePath));
        if ($finalFileName !== ''){
            $asset->setFilename($finalFileName);
            $asset->save();
            $this->output->writeln('Data exported to CSV and saved in assets.');
        } 
        return 0;
    }
    
    private function arrayToCsv($data)
    {
        $output = fopen('php://temp', 'a'); // Create a temporary stream
 
        if ($output === false) {
            throw new \Exception('Failed to open a temporary stream for CSV generation.');
        }
 
        foreach ($data as $row) {
            foreach($row as $key => $value){
                fputcsv($output,["$key => $value"]);
            }
            fwrite($output, PHP_EOL);
        }
 
        rewind($output); // Rewind the stream to the beginning
 
        return stream_get_contents($output);
    }
}