<?php
 
namespace App\Command;

use Pimcore\Console\AbstractCommand;

use App\Service\DataFillerService;
use App\Service\FolderService;
use App\Service\ObjectService;
use App\Service\ValidatorService;
use App\Service\LogSmryService;


use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Contracts\Translation\TranslatorInterface;



class ImportProductCommand extends AbstractCommand
{   
    private MailerInterface $mailer;
    private $csvFilePath;
    private TranslatorInterface $translator;

    public function __construct(MailerInterface $mailer, $csvFilePath, TranslatorInterface $translator)
    {
        parent::__construct();
        $this->mailer = $mailer;
        $this->csvFilePath = $csvFilePath;
        $this->translator = $translator;
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
        
        $csv = array_map('str_getcsv', file($this->csvFilePath));
        $headers = array_shift($csv);

        $errorstring = "";
        $total = 0;
        $dumbObjects = 0;

        // CREATION of FOLDERS, OBJECTS and VARIANTS and DATA FILLING...
        try{
            foreach ($csv as $row)
            {
                $type = $row[array_search("Type", $headers)];
                $isObject = ($type === "object");  
    
                $parentPath = $row[array_search('storage Path', $headers)]; 
                $pdtname = $row[array_search("English ProductName", $headers)];
                $currentSKU = $row[array_search('sku', $headers)];
                
                $total += 1; 
                if ($isObject == true){
                    $folder=FolderService::createFolder($parentPath);
                    
                    //VALIDATION...
                    $res=ValidatorService::validateProductData($headers, $row);
                    if($res[0]===true){
                        $object = ObjectService::createObjects($parentPath, $folder, $pdtname);
                        //fill the data
                        DataFillerService::fillAllData($object, $row, $headers, $type);
                        $object->save();

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
                                // Use translation key
                                $errorKey = 'sku_pattern_mismatch';
                                $errorstring .= $this->translator->trans($errorKey, ['pdtname' => $pdtname, 'type' => $type, 'total' => $total]) . "\n";
                            }
                        }
                        else{

                            // Use translation key
                            $errorKey = 'empty_sku_variant';
                            $errorstring .= $this->translator->trans($errorKey, ['pdtname' => $pdtname, 'type' => $type, 'total' => $total]) . "\n";

                        }
                    }
                    else{
                        $dumbObjects += 1;
                        foreach($res as $error){
                            $errorKey = 'validation';
                            $errorstring .= $this->translator->trans($errorKey, ['pdtname' => $pdtname, 'type' => $type, 'total' => $total, 'error' => $error]) . "\n";
                        } 
                    }
                }
                    
                else{
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
                                    // Use translation key
                                    $errorKey = 'sku_pattern_mismatch';
                                    $errorstring .= $this->translator->trans($errorKey, ['pdtname' => $pdtname, 'type' => $type, 'total' => $total]) . "\n";
                                    }
                            }
                            else{
                                // Use translation key
                                $errorKey = 'empty_sku_variant';
                                $errorstring .= $this->translator->trans($errorKey, ['pdtname' => $pdtname, 'type' => $type, 'total' => $total]) . "\n";

                            }
                            
                        }
                        else{
                            $dumbObjects += 1;
                            // Use translation key
                            $errorKey = 'object_does_not_exist';
                            $errorstring .= $this->translator->trans($errorKey, ['pdtname' => $pdtname, 'type' => $type, 'total' => $total]) . "\n";

                        }
                    }
                    else{
                        $dumbObjects += 1;  
                        foreach($res as $error){
                            $errorKey = 'validation';
                            $errorstring .= $this->translator->trans($errorKey, ['pdtname' => $pdtname, 'type' => $type, 'total' => $total, 'error' => $error]) . "\n";
                        } 
                    }
                }
            }
            $this->sendNotificationEmail($total, $dumbObjects);

            //LOGS and SUMMARY REPORT
            $summary = LogSmryService::createLogAndSummary($errorstring, $total, $dumbObjects);
            $output->writeln($summary);
            return 0;
        }
        catch (\Exception $e) {
            // Handle exceptions 
            $output->writeln($this->translator->trans('error', ['message' => $e->getMessage()]));

            return 0; 
        }   
    }

    //mail notification
    private function sendNotificationEmail($total, $dumbObjects): void
    {
        $mailkey = 'mail_message';
        $message = $this->translator->trans($mailkey, ['today_date' => date("Y/m/d"), 'total' => $total, 'success_objects' => $total - $dumbObjects]) . "\n";
        // Creating the email
        $email = (new Email())
            ->from('sakshikushwaha2018@gmail.com')
            ->to('kshivansh816@gmail.com')
            ->subject('Import Notification')
            
            ->text($message);
        // Sending the email
        try {

            $this->mailer->send($email);

        } catch (\Exception $e) {
        }

    }
    
}

 