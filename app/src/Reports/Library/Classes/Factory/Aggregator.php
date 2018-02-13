<?php

namespace App\Reports\Library\Classes\Factory;


use App\Reports\Library\Classes\Domain\Model\{ParametrAggregator};
use App\Reports\Library\Classes\Factory\Generic\{IFactoryAggregator, IFactoryData, IDictionary};




final class Aggregator implements IFactoryAggregator
{


    private $factoryMapper;


    private $multiAggDictionary;




   public function __construct(IFactoryData $factoryMapper, IDictionary $multiAggDictionary)
   {
       $this->factoryMapper = $factoryMapper;
       $this->multiAggDictionary = $multiAggDictionary;
   }



   
    public function factory()
    {
        return new ParametrAggregator($this->multiAggDictionary);
    }
}