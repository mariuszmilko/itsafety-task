<?php

namespace App\Reports\Sheets\Tracks\Model;

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
   
   public function generateTracks()
   {
       $i = 0;
       $bufer = [];
       foreach ($this->xData as $data) {    
          $i++;   
          if ($i < 4)
          {
            $bufer[] = $data;       
          } 
          else
          {
            $this->trackGen->process($bufer);  
            var_dump($bufer);
            $bufer = [];
            $i = 0;
          }         
          //$this->trackGen->process($data);
       }
       $this->tracks = $this->trackGen->getTracks();
   }

   public function getTracks()
   {
       return $this->tracks;
   }
 
}