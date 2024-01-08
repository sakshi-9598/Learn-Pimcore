<?php

namespace App\Service;

class LogSmryService
{
    //LOG AND SUMMARY
    public static function createLogAndSummary($errorstring, $total, $dumbObjects):string{
        $errorFilename = 'ErrorLogs_Clothing_'.date('Y-m-d_H-i-s').'.csv';
        $summaryFileName = 'Summary_Clothing_'.date('Y-m-d_H-i-s').'.csv';
        $errorAsset = new \Pimcore\Model\Asset();
        $summaryAsset = new \Pimcore\Model\Asset();
        $errorAsset->setFilename($errorFilename);
        $summaryAsset->setFilename($summaryFileName);

        if($errorstring !== ""){
            $errorAsset->setData($errorstring);  
            $errorAsset->setParent(\Pimcore\Model\Asset::getByPath("/errorlogs"));
            $errorAsset->save();
        }

        $summary = $total - $dumbObjects." Objects of Clothing class are Import successfully...! \n$dumbObjects Objects are Unsuccessfull";
        $summaryAsset->setData($summary);
        $summaryAsset->setParent(\Pimcore\Model\Asset::getByPath("/errorlogs"));
        $summaryAsset->save();
        return $summary;
    }
}