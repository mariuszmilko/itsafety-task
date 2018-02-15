<?php

namespace App\Reports\Library\Classes\Domain\Model;

use App\Reports\Library\Classes\Domain\Model\Generic\Track\{IType};
use App\Reports\Library\Classes\Factory\Generic\{IDictionary};



class ParametrAggregator implements \IteratorAggregate
{


   protected $parameters = [];

   
   protected $multiAggDictionary; 




   public function __construct(IDictionary $multiAggDictionary)
   {
      $this->multiAggDictionary = $multiAggDictionary;
   }




   public function extractParameters(IType $track)
   {
       foreach ($track as $index)
       {
          foreach ($index as $parameter)
          {
             $mag = $this->multiAggDictionary->get($parameter->getName()); 
             if (isset($mag)) {
                $mag->calculate($parameter);
                $this->parameters[$parameter->getName()] = $mag;
             }
          }
       }
   }




   public function getIterator() {

     return new \ArrayIterator($this->parameters);
  }
}