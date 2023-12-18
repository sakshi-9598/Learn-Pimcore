<?php
 
namespace App\EventSubscriber;
 
use Pimcore\Db;
use DateTime;
use Pimcore\Bundle\DataImporterBundle\Event\DataObject\PreSaveEvent;
use Pimcore\Bundle\DataImporterBundle\Event\DataObject\PostSaveEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Pimcore\Model\Asset;
use Pimcore\Model\DataObject\Data\Video;
use Pimcore\Model\DataObject\Clothing;
 
 
 
use Pimcore\Model\Notification\Service\NotificationService;
 
class NotificationSubscriber implements EventSubscriberInterface
{
    private $notificationService;
    private $timestamp = null;
    private $sender;
    private $receiver;
    private $count;
    private $total;
    private $formatedTimestamp = null;

 
    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
        $this->sender = 2;
        $this->receiver = 10;
        $this->count = 0;
        $this->total=0;
    
    }
 
    public static function getSubscribedEvents()
    {
        return [
            PreSaveEvent::class => 'onPreSave',
            PostSaveEvent::class => 'onPostSave',
        ];
    }
 
 
    public function onPreSave(PreSaveEvent $event)
    {
        if($this->timestamp == null){
            $this->timestamp = date("Y-m-d H:i:s");
        }
        $dataObject = $event->getDataObject();
    }
 
 
 
    public function onPostSave(PostSaveEvent $event)
    {
        
        $dataObject = $event->getDataObject();

        try {
            $sql = "SELECT COUNT(*) FROM bundle_data_hub_data_importer_queue";
            $rowCount = Db::get()->fetchOne($sql);

            
            $this->total = $rowCount;
            $this->total = max($this->count,$this->total);
            $this->count = $this->total;

            if ($rowCount === 1) {
                // var_dump("ssss. \n. $rowCount");
                $this->import();
                $this->import1();
                $this->sendNotification($this->total);
            }
        } catch (\Exception $e) {
            // Handle Error.
        }
    }
 
    
    private function sendNotification($count)
    {
        $title = 'Data Import Complete';
        $message = $count. 'objects are imported.';
 
        $this->notificationService->sendToUser($this->receiver, $this->sender, $title, $message);
    }
 
 
 
    private function import(){
        // $file1 = fopen('/var/www/PIMPROJECTS/myclothing/public/var/assets/importlog.txt','a');
    
        $q3 = "Select message,timestamp from application_logs where priority = 'error' and timestamp >= '$this->timestamp' ";
        $result1 = Db::get()->fetchAllAssociative($q3); 
        $csvContent = "Message,Occurred On\n";
        // var_dump($result1);

        foreach ($result1 as $row) {
            $message = '"'.$row['message'].'"';
            $occurredOn = $row['timestamp'];
            $csvContent .= "$message,$occurredOn\n";
        }
        $assetFilename = 'importer_error_logs '.$this->getFormatedTimestamp().'.csv';
        $asset = new \Pimcore\Model\Asset();
        $asset->setFilename($assetFilename);
        $asset->setData($csvContent);
        $asset->setParent(\Pimcore\Model\Asset::getByPath("/Logs"));
        $asset->save();
    }
 
    private function import1(){
        $file = fopen('/var/www/PIMPROJECTS/myclothing/public/var/assets/import.txt','a');
        $q1 = "Select COUNT(*)+1 from application_logs where message LIKE '%success%' and timestamp >= '$this->timestamp'";
        $q2 = "Select COUNT(*) from application_logs where priority = 'error' and timestamp >= '$this->timestamp'";
        $result = "\n Successful Data Imported: ". Db::get()->fetchOne($q1) . " and  Unsuccesful record Imported :" .Db::get()->fetchOne($q2)." on Date: " . date("Y-m-d");  
        
        $csvContent = "Message,Occurred On\n";
        $csvContent .= "$result\n";

        $assetFilename = 'importer_success_logs '.$this->getFormatedTimestamp().'.csv';
        $asset = new \Pimcore\Model\Asset();
        $asset->setFilename($assetFilename);
        $asset->setData($csvContent);
        $asset->setParent(\Pimcore\Model\Asset::getByPath("/Logs"));
        $asset->save();  
        fwrite($file,$result);
    }

    public function getFormatedTimestamp() 
    { 
        $timeStamp = new DateTime($this->timestamp); 
        $formatedTime = $timeStamp->format('Y-m-d H:i:s'); 
        return $this->formatedTimestamp = str_replace([':'],'',$formatedTime); 
    }
 
}