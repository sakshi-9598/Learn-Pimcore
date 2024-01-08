<?php
 
namespace App\Command;

use App\Service\DataFillerService;
use App\Service\FolderService;
use App\Service\ObjectService;
use App\Service\ValidatorService;
use App\Service\LogSmryService;


use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Pimcore\Console\AbstractCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class ImportProductCommand extends AbstractCommand
{   
    private MailerInterface $mailer;
    private $csvFilePath;

    public function __construct(MailerInterface $mailer, $csvFilePath)
    {
        parent::__construct();
        $this->mailer = $mailer;
        $this->csvFilePath = $csvFilePath;
    }


    protected function configure(): void
    {
        $this
            ->setName('importproduct')
            ->setDescription('Import data from CSV file to Pimcore objects');
    }

 
    //code for the execution
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // $csvFilePath = "/var/www/PIMPROJECTS/myclothing/finalcloth.csv"; // file path
        $csv = array_map('str_getcsv', file($this->csvFilePath));
        $headers = array_shift($csv);

        $errorstring = "";
        $total = 0;
        $dumbObjects = 0;

        // CREATION of FOLDERS, OBJECTS and VARIANTS and DATA FILLING...
        foreach ($csv as $row)
        {
            $type = $row[array_search("Type", $headers)];
            $isObject = ($type === "object");     #TRUE/FALSE
 
            $parentPath = $row[array_search('storage Path', $headers)];  #"/CLOTHING/MENS/TOP WEAR/FORMAL SHIRTS"
            $pdtname = $row[array_search("English ProductName", $headers)];
            $currentSKU = $row[array_search('sku', $headers)];
            
            $total += 1; 
            if ($isObject == true){
                $folder=FolderService::createFolder($parentPath);
                
                //VALIDATION...

                $res=ValidatorService::validateProductData($headers, $row);
                if($res[0]===true){
                    $object=ObjectService::createObjects($parentPath, $folder, $pdtname);
                    //fill the data
                    DataFillerService::fillAllData($object, $row, $headers, $type);
                    $object->save();

                    // if either color or size either is present, then set this object as base product and now create it's variant
                    $newParentPath = $parentPath."/". $pdtname;
                    $pdtname = $pdtname."1";
                    $type = "variant";
                    
                    if (!ValidatorService::isEmptySKU($currentSKU)){
                        if  (ValidatorService::validateSKU($currentSKU)){
                            $variant=ObjectService::createVariants($newParentPath, $object, $pdtname);
                            DataFillerService::fillAllData($variant, $row, $headers, $type);
                            $variant->save();
                        }
                        else{
                            $errorstring .= "Error: On $pdtname : [$type] Row number ".$total." -> " . "[ SKU pattern doesn't match ]"."\n";
                        }
                    }
                    else{
                        $errorstring .= "Error: On $pdtname : [$type] Row number ".$total." -> " . "[ Doesn't create variant because SKU is EMPTY ]"."\n";
                    }
                }
                else{
                    $dumbObjects += 1;
                    foreach($res as $error){
                        $errorstring .= "Error: On $pdtname : [$type] Row number ".$total." -> " .$error."\n";
                    } 
                }
            }
                
            else{
                // $valArr = ['SKU','Model Name','Model Number','Base Price','Selling Price','Delivery Charges','Discount','Length','Breadth','Height'];
                $res=ValidatorService::validateProductData($headers, $row);
                if($res[0]===true){
                    $mProduct = ObjectService::objectExistOrNot($parentPath);

                    //object exists...
                    if ($mProduct !== false){
                        if (!ValidatorService::isEmptySKU($currentSKU)){
                            if  (ValidatorService::validateSKU($currentSKU)){
                                $variant=ObjectService::createVariants($parentPath, $mProduct, $pdtname);
                                DataFillerService::fillAllData($variant, $row, $headers, $type);
                                $variant->save();
                            }
                            else{
                                $errorstring .= "Error: On $pdtname : [$type] Row number ".$total." -> " . "[ SKU pattern doesn't match ]"."\n";
                            }
                        }
                        else{
                            $errorstring .= "Error: On $pdtname : [$type] Row number ".$total." -> " . "[ Doesn't create variant because SKU is EMPTY ]"."\n";
                        }
                        
                    }
                    else{
                        $dumbObjects += 1;
                        $errorstring .= "Error: On $pdtname : [$type] Row number ".$total." ->  OBJECT doesn't exist, Trying to make variant of $pdtname \n" ;
                    }
                }
                else{
                    $dumbObjects += 1;  
                    foreach($res as $error){
                        $errorstring .= "Error: On $pdtname : [$type] Row number ".$total." ->  $error.\n";
                    } 
                }
            }

        }

        $this->sendNotificationEmail();

        //LOGS and SUMMARY REPORT
        $summary = LogSmryService::createLogAndSummary($errorstring, $total, $dumbObjects);

        $output->writeln($summary);
        return 0;
    }

    //mail notification
    private function sendNotificationEmail(): void
    {

        // Creating the email

        $email = (new Email())

            ->from('sakshikushwaha2018@gmail.com')

            ->to('kshivansh816@gmail.com')

            // ->from($mailerFrom)

            // ->to($mailerTo)

            ->subject('Import Notification')

            ->text('The sakshi import process has been completed successfully. This email is only for testing dec-26');

        // Sending the email

        try {

            $this->mailer->send($email);

        } catch (\Exception $e) {

            // Handle email sending failure (log the error, throw an exception, etc.)

        }

    }
    
}

 