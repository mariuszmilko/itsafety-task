<?php

namespace App\Reports\Library\Classes\Domain\Model;

use Generator;



class Device implements \IteratorAggregate
{

   protected  $deviceId;
   protected  $tracks;
   protected  $xData;
   protected  $trackGen;




   public function __construct(int $deviceId, Generator $xData, TrackGenerator $trackGen)
   {
       $this->deviceId = $deviceId;
       $this->xData = $xData;
       $this->trackGen = $trackGen;
   }
   



   public function generateTracks()
   {
    while ($this->xData->valid()) {   
       $this->trackGen->process($this->xData);  
    }
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