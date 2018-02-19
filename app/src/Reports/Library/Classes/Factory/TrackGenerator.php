<?php

namespace App\Reports\Library\Classes\Factory;


use App\Reports\Library\Classes\Domain\Model\TrackGenerator as TrackGeneratorModel;
use App\Reports\Library\Classes\Factory\Generic\{
    IFactoryAggregator, 
    IFactoryData, 
    IFactoryPoint, 
    IDictionary};
use App\Reports\Library\Classes\Helpers\Validators\TrackValidator;



final class TrackGenerator implements IFactoryAggregator
{


   private $factoryPoint;


   private $factoryTrack;


   private $factoryAggregator; 


   private $trackValidator;




   public function __construct(
       IFactoryData $factoryPoint, 
       IFactoryPoint $factoryTrack, 
       IFactoryAggregator $factoryAggregator, 
       TrackValidator $trackValidator)
   {
       $this->factoryPoint = $factoryPoint;
       $this->factoryTrack = $factoryTrack;
       $this->factoryAggregator = $factoryAggregator;
       $this->trackValidator = $trackValidator;
   }



   
    public function factory()
    {
        return new TrackGeneratorModel(
            $this->factoryPoint, 
            $this->factoryTrack, 
            $this->factoryAggregator, 
            $this->trackValidator);
    }
}