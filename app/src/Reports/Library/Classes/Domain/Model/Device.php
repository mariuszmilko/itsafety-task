<?php

namespace App\Reports\Library\Classes\Domain\Model;

use Generator;



class Device implements \IteratorAggregate
{

   protected  $deviceId;


   protected  $tracks;


   protected  $xData;


   protected  $trackGen;

   
   protected  $summaryTracks;




   public function __construct(int $deviceId, Generator $xData, TrackGenerator $trackGen)
   {
       $this->deviceId = $deviceId;
       $this->xData = $xData;
       $this->trackGen = $trackGen;
   }
   



   public function processTracks()
   {
      while ($this->xData->valid()) {   
         $this->trackGen->stream($this->xData)
            ->beginProcess() 
            ->beginTrack()
            ->processing()
            ->setPreviousPoint()
            ->next()
            ->isEndStream()
            ->aggregate();
      }
   }




   public function getSummary()
   {
        $this->trackGen->multiAggregator(function ($mAgg) {
            $this->summaryTracks = $mAgg;
        });

       return $this->summaryTracks;
   }




   public function getIterator() {

	  return $this->trackGen->getIterator();
   }
}