<?php

namespace App\Reports\Sheets\Tracks\Model;

class TrackGenerator 
{
   private $currentPoint;
   private $previousPoint;
   private $track;
   private $tracks = [];
   private $factoryPoint;

   
   public function __construct($factoryPoint, $trackBuilder)//$config
   {
      $this->factoryPoint = $factoryPoint;
      $this->trackBuilder = $trackBuilder;
   }
     
 //  To Track generator
   public function isEndTrack($point)
   {
      if (isset($this->previous) && $this->current != $this->previous) { //count
       // $this->track->processPoint($point);
          $this->tracks[] = $this->track;
          $this->track = $this->trackBuilder->newInstance();
          echo 'end track';
      }    
   }

   public function isFirstTrack()
   {
      if (!isset($this->previous)) {
        $this->track = $this->trackBuilder->newInstance();
        echo 'start track';
        return true;
      }
      return false;
   }

   private function setCurrentPoint($delimiter) 
   {
    //    if (isset($this->current) && $this->current != $delimiter) {
    //        echo 'ERROR: '.$this->current, $delimiter;
    //        throw new \Exception('Problem z delimiterem');
    //    }
    var_dump($delimiter);
      $this->current = $delimiter; //record_device_state
   }

   private function setPreviousPoint() 
   {
      $this->previous = $this->current;   //record_device_state
   }

   public function process($data) // $bufor
   {
      $point = $this->factoryPoint->factory($data);
     // var_dump($point);exit('xxx');
      $this->setCurrentPoint($point->delimiter());//filtering($point);
      $this->isFirstTrack();// ? 
      // : true;  //LastPoint 
      $data = $this->track->processPoint($point);
      $this->isEndTrack($point);
      $this->setPreviousPoint();
      
      
   }

   public function getTracks()
   {
       return $this->tracks;
   }

}