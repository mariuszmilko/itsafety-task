<?php

namespace App\Reports\Sheets\Tracks\Model;

class Device implements \IteratorAggregate
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
       $this->trackGen->process($this->xData);  
       $this->tracks = $this->trackGen->getTracks();
   }

   public function getTracks()
   {
       return $this->tracks;
   }

   public function getIterator() {
	  return new ArrayIterator($this->tracks);
   }
 
}