<?php

namespace App\Reports\Sheets\Tracks\Model;

class TrackGenerator   //implements IProcess
{
   private $current;
   private $previous;
   private $track;
   private $tracks = [];
   private $factoryPoint;
   private $lastPointFromBuffer;

   
   public function __construct($factoryPoint, $trackBuilder)//$config
   {
      $this->factoryPoint = $factoryPoint;
      $this->trackBuilder = $trackBuilder;
   }
     
 //  To Track generator
   public function completeTrack($point, $end)
   {
      if ($end || $this->isEndTrack($point)) { //count
        //  $this->track->processPoint($this->previousPoint);
          $this->tracks[] = $this->track;
          $this->track = $this->trackBuilder->newInstance();
      }    
   }

   public function isEndTrack($point)
   {
       return (isset($this->previous) && $this->current->delimiter() != $this->previous->delimiter());
   }

   public function isFirstTrack()
   {
       return (!isset($this->previous));
   }

   public function beginTrack()
   {
      if ($this->isFirstTrack()) {
        $this->track = $this->trackBuilder->newInstance();
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
  //  var_dump($delimiter);
      $this->current = $delimiter; //record_device_state
   }

   private function setPreviousPoint() 
   {
      $this->previous = $this->current;   //record_device_state
   }

   private function rewind()
   {
      $this->current = $this->previous;
   }

   public function process($xData, $buffer = null)
   {
      while ($xData->valid()) {
        $data =  $xData->current();
        
        $point = $this->factoryPoint->factory($data);
        $this->setCurrentPoint($point);//filtering($point);
        $this->beginTrack();
        if (!$this->isEndTrack($point)) {
          $data = $this->track->processPoint($point);
        } else {
          $this->completeTrack($point, false);
        }
        $this->setPreviousPoint();
        $xData->next();
        if (!$xData->valid()) {
            $this->completeTrack($point, true);
        }
     }
    //    exit('uuu');
    //   foreach ($xData as $data) {       //$buffer->add()
    //     //  $i++;   
    //     //  if ($i < 2){
    //     //    $buffer[] = $data;       
    //     //  } else {
    //     //    $this->processOnBuffer($buffer); 
    //     //    var_dump($buffer);
    //     //    $buffer = [];
    //     //    $i = 0;
    //     //  }         

   

    //   }
   }

   public function preProcess($buffer)
   {
      $data = $buffer[0];
      $nextData = $buffer[1];  
      $buffer_ = [$data, $nextData]; 
      for ($i = 0; $i < 2; $i++)
      {
         $data = $buffer_[$i];  
         $point = $this->factoryPoint->factory($data); 
         if (!$this->isEndTrack($point)) { 
           $this->setCurrentPoint($point->delimiter());
           $this->setPreviousPoint();
         } else {
           $this->rewind();
             
           return new VirtualPoint($point);
         }
      }
   }

   public function processOnBuffer($buffer)
   {
     $buffer = $this->preProcess($buffer);

     $count = count($buffer);
     for ($i = 0; $i < $count; $i++)
     {
        // $prev = $buffer->get();
        // $next = $buffer->next()
        // $buffer->rewind();
        //$this->isEndTrack($point); aaddtoBufor End Point

        $point = $this->factoryPoint->factory($data);
        // var_dump($point);exit('xxx');
        $this->setCurrentPoint($point->delimiter());//filtering($point);
        $this->beginTrack();// ? 
        // : true;  //LastPoint 
        $data = $this->track->processPoint($point, $point_next);
        $this->completeTrack($point);
        $this->setPreviousPoint();
     }  
   }

   public function getTracks()
   {
       return $this->tracks;
   }

}