<?php

namespace App\Reports\Library\Classes\Domain\Model;

use App\Reports\Library\Classes\Domain\Model\Generic\Point\IPoint;
use App\Reports\Library\Classes\Factory\{Point as FactoryPoint, Track as FactoryTrack};
use Generator;



final class TrackGenerator  implements \IteratorAggregate //implements IProcess
{
   private $current;
   private $previous;
   private $track;
   private $tracks = [];
   private $factoryPoint;
   private $factoryTrack; 
   private $lastPointFromBuffer;
   const MINLEGTH = 2; //to env  track config or validator

   
   public function __construct(FactoryPoint $factoryPoint, FactoryTrack $factoryTrack)//$config
   {
      $this->factoryPoint = $factoryPoint;
      $this->factoryTrack = $factoryTrack;
   }
     



   public function completeTrack(IPoint $point, bool $end)
   {
      if ($this->isCompleteTrack($point, $end)) { //count
          $this->track->updateOnEnd($point);
          $this->addTrack();
          $this->track = $this->factoryTrack->factory();
          $this->track->processPoint($point);
      }    
   }




   public function addTrack()
   {
       $this->tracks[] = $this->track;
   }


   public function isCompleteTrack(IPoint $point, bool $end)
   {   //track validator
       return ($end && $this->isMinLength() || $this->isEndTrack($point) && $this->isMinLength());
   }




   public function isEndTrack(IPoint $point)
   { //track validator
       return (isset($this->previous) && $this->current->delimiter() != $this->previous->delimiter());
   }




   public function isFirstTrack()
   { //track validator
       return (!isset($this->previous));
   }




   public function isMinLength()
   {
       //track validator
       return true;
   }




   public function beginTrack()
   {
      if ($this->isFirstTrack()) {
        $this->track = $this->factoryTrack->factory();
        return true;
      }
      return false;
   }




   private function setCurrentPoint(IPoint $point) 
   {
      $this->current = $point; //record_device_state
   }




   private function setPreviousPoint() 
   {
      $this->previous = $this->current;   //record_device_state
   }




   private function rewind()
   {
      $this->current = $this->previous;
   }




   public function process(Generator $xData, $buffer = null)
   {
      while ($xData->valid()) {
           $data =  $xData->current();         
           $point = $this->factoryPoint->factory($data);
           $this->setCurrentPoint($point);
           $this->beginTrack();
           (!$this->isEndTrack($point)) ? 
                $this->track->processPoint($point) : 
                $this->completeTrack($point, false); 
           $this->setPreviousPoint();
           $xData->next();
           if (!$xData->valid()) {
             $this->completeTrack($point, true);
           }
      }
   }




   public function getTracks()
   {
       return $this->tracks;
   }




   public function getIterator() 
   {
       return new ArrayIterator($this->$tracks);
   }
//buffer option
//    public function preProcess($buffer)
//    {
//       $data = $buffer[0];
//       $nextData = $buffer[1];  
//       $buffer_ = [$data, $nextData]; 
//       for ($i = 0; $i < 2; $i++)
//       {
//          $data = $buffer_[$i];  
//          $point = $this->factoryPoint->factory($data); 
//          if (!$this->isEndTrack($point)) { 
//            $this->setCurrentPoint($point->delimiter());
//            $this->setPreviousPoint();
//          } else {
//            $this->rewind();
             
//            return new VirtualPoint($point);
//          }
//       }
//    }

//    public function processOnBuffer($buffer)
//    {
//      $buffer = $this->preProcess($buffer);

//      $count = count($buffer);
//      for ($i = 0; $i < $count; $i++)
//      {
//         // $prev = $buffer->get();
//         // $next = $buffer->next()
//         // $buffer->rewind();
//         //$this->isEndTrack($point); aaddtoBufor End Point

//         $point = $this->factoryPoint->factory($data);
//         // var_dump($point);exit('xxx');
//         $this->setCurrentPoint($point->delimiter());//filtering($point);
//         $this->beginTrack();// ? 
//         // : true;  //LastPoint 
//         $data = $this->track->processPoint($point, $point_next);
//         $this->completeTrack($point);
//         $this->setPreviousPoint();
//      }  
//    }
}