<?php

namespace App\Reports\Library\Classes\Domain\Model;

use App\Reports\Library\Classes\Domain\Model\Generic\Point\IPoint;
use App\Reports\Library\Classes\Factory\Generic\{IFactoryPoint, IFactoryData, IFactoryAggregator};
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
   private $parameterAggregator; 

   const MINLEGTH = 2; //to env  track config or validator

   
   public function __construct(
        IFactoryData $factoryPoint, 
        IFactoryPoint $factoryTrack, 
        IFactoryAggregator $factoryAggregator
   )
   {
      $this->factoryPoint = $factoryPoint;
      $this->factoryTrack = $factoryTrack;
      $this->parameterAggregator = $factoryAggregator->factory();
   }
     



   public function completeTrack(bool $end, callable $response = null)
   {
      if ($this->isCompleteTrack($end)) {
          $this->track->updateOnEnd($this->current);
          $this->addTrack();
          $this->track = $this->factoryTrack->factory($this->current);
          $this->track->processPoint($this->current);
      }    

      return $this;
   }




   public function aggregate(callable $response = null)
   {
       if (count($this->tracks) > 0 ) {
         $last = $this->tracks[count($this->tracks)-1];
         $this->parameterAggregator->extractParameters($last);
         !is_callable($response) ?: $response($last);
       }

       return $this;
   }

   


   public function multiAggregator(callable $response = null)
   {
       !is_callable($response) ?: $response($this->parameterAggregator);
       return $this;
   }




   public function addTrack(callable $response = null)
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




   public function beginTrack(callable $response = null)
   {
      if ($this->isFirstTrack()) {
        $this->track = $this->factoryTrack->factory($this->current);
      }

      return $this;
   }




   public function setCurrentPoint(IPoint $point, callable $response = null) 
   {
      $this->current = $point;

      return $this;
   }




   public function setPreviousPoint(callable $response = null) 
   {
      $this->previous = $this->current; 

      return $this;
   }




   private function rewind(callable $response = null)
   {
      $this->current = $this->previous;

      return $this;
   }




   public function stream(Generator $xData, callable $response = null)
   {       
        $this->stream = $xData;

        return $this;
   }




   public function isEndStream(callable $response = null)
   {
        if (!$this->stream->valid()) {
            $this->completeTrack(true);
        }

        return $this;
   }

   


   public function beginProcess(callable $response = null)
   {
         $data = $this->stream->current();         
         $this->setCurrentPoint($this->factoryPoint->factory($data));   

        return $this;
   }




   public function nextOrComplete(callable $response = null)
   {
        (!$this->isEndTrack()) ? $this->track->processPoint($this->current) : $this->completeTrack(false); 
    
        return $this;
   }




   public function next()
   {
      $this->stream->next();

      return $this;
   }




   public function getIterator() 
   {
       return new \ArrayIterator($this->tracks);
   }
}

//   public function pipe (\Closure $next)
//   {

//        $next($result);
//       return $this;
//   }


