<?php

namespace App\Reports\Library\Classes\Domain\Model;

use App\Reports\Library\Classes\Domain\Model\Generic\Point\IPoint;
use App\Reports\Library\Classes\Factory\Generic\{IFactoryPoint, IFactoryData};
use Generator;



final class TrackGenerator  implements \IteratorAggregate //implements IProcess
{
   private $current;
   private $previous;
   private $track;
   private $tracks = [];
   private $stream;
   private $factoryPoint;
   private $factoryTrack; 
   private $factoryMapper; 

   const MINLEGTH = 2; //to env  track config or validator

   
   public function __construct(
        IFactoryData $factoryPoint, 
        IFactoryPoint $factoryTrack, 
        IFactoryData $factoryMapper
   )
   {
      $this->factoryPoint = $factoryPoint;
      $this->factoryTrack = $factoryTrack;
      $this->factoryMapper = $factoryMapper;
   }
     



   public function completeTrack(bool $end)
   {
      if ($this->isCompleteTrack($end)) {
          $this->track->updateOnEnd($this->current);
          $this->addTrack();
          $this->track = $this->factoryTrack->factory($this->current);
          $this->track->processPoint($this->current);
      }    
      return $this;
   }




   public function addTrack()
   {
       $this->tracks[] = $this->track;
       return $this;
   }


   public function isCompleteTrack(bool $end)
   {   //track validator
       return ($end && $this->isMinLength() || $this->isEndTrack() && $this->isMinLength());
   }




   public function isEndTrack()
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
        $this->track = $this->factoryTrack->factory($this->current);
      }
      return $this;
   }




   public function setCurrentPoint(IPoint $point) 
   {
      $this->current = $point;
      return $this;
   }




   public function setPreviousPoint() 
   {
      $this->previous = $this->current; 
      return $this;
   }




   private function rewind()
   {
      $this->current = $this->previous;
      return $this;
   }




   public function stream(Generator $xData, $buffer = null)
   {       
        $this->stream = $xData;
        return $this;
   }




   public function isEndStream()
   {
        if (!$this->stream->valid()) {
            $this->completeTrack(true);
        }

        return $this;
   }

   


   public function beginProcess()
   {
         $data = $this->stream->current();         
         $this->setCurrentPoint($this->factoryPoint->factory($data));   

        return $this;
   }




   public function nextOrComplete()
   {
        (!$this->isEndTrack()) ? 
        $this->track->processPoint($this->current) : 
        $this->completeTrack(false); 
        $this->stream->next();

        return $this;
   }




  public function pipe (\Closure $next)
  {

       $next($result);
      return $this;
  }




   public function getTracks()
   {
       return $this->tracks;
   }




   public function getIterator() 
   {
       return new ArrayIterator($this->$tracks);
   }
}