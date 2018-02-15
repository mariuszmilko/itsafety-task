<?php

namespace App\Reports\Library\Classes\Domain\Model;

use App\Reports\Library\Classes\Domain\Model\Generic\Point\IPoint;
use App\Reports\Library\Classes\Factory\Generic\{IFactoryPoint, IFactoryData, IFactoryAggregator};
use App\Reports\Library\Classes\Helpers\Validators\TrackValidator;
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


   private $trackValidator;


   private $parameterAggregator; 

   

   
   public function __construct(
        IFactoryData $factoryPoint, 
        IFactoryPoint $factoryTrack, 
        IFactoryAggregator $factoryAggregator,
        TrackValidator $trackValidator
   )
   {
      $this->factoryPoint = $factoryPoint;
      $this->factoryTrack = $factoryTrack;
      $this->parameterAggregator = $factoryAggregator->factory();
      $this->trackValidator = $trackValidator;
   }
     



   public function completeTrack(bool $end, callable $response = null)
   {
      if ($this->trackValidator->isCompleteTrack($end, $this->current, $this->previous)) {
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




   public function beginTrack(callable $response = null)
   {
      if ($this->trackValidator->isFirstTrack($this->previous)) {
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




   public function processing(callable $response = null)
   {
      (!$this->trackValidator->isEndTrack($this->current, $this->previous)) ?
        $this->track->processPoint($this->current) : 
        $this->completeTrack(false); 
      
        return $this;
   }




   public function next(callable $response = null)
   {
      $this->stream->next();

      return $this;
   }




   private function rewind(callable $response = null)
   {
      $this->current = $this->previous;

      return $this;
   }




   public function getIterator() 
   {
       return new \ArrayIterator($this->tracks);
   }
}