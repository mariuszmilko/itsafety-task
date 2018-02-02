<?php

namespace App\Reports\Sheets\Tracks\Model;

//Device config
class Device
{
   protected  $deviceId;
   protected  $tracks;
   protected  $xData;
   protected  $trackGen;


   public function __construct($deviceId, $xData, $trackGen)
   {
       $this->deviceId = $deviceId;
       $this->xData = $xData;
       $this->trackGen = $trackGen;
   }
   
   public function generateTracks($config)
   {
       foreach ($this->xData as $point) {        
          $trackGen->process($point);
       }
       $this->tracks = $trackGen->addTracks();
   }
 
}