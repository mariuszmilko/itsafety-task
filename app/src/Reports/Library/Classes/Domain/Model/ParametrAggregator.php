<?php

namespace App\Reports\Library\Classes\Domain\Model;

use App\Reports\Library\Classes\Domain\Model\Generic\Track\{IType};
use App\Reports\Library\Classes\Factory\Generic\{IDictionary};
use App\Reports\Library\Classes\Helpers\Arrays\ArrayGenerator;



class ParametrAggregator implements \IteratorAggregate
{


   protected $parameters = [];


   protected $multiAggDictionary; 




   public function __construct(IDictionary $multiAggDictionary)
   {
      $this->multiAggDictionary = $multiAggDictionary;
   }




   public function extractParameters(\IteratorAggregate $track)
   {
       foreach ($track as $index)
       {
          foreach ($index as $parameter)
          {
             $mag = $this->multiAggDictionary->get($parameter->getName()); 
             if (isset($this->parameters[$parameter->getName()])) {
                $mag = $this->parameters[$parameter->getName()];
             } else {
                !(isset($mag)) ?: $this->parameters[$parameter->getName()] = $mag;
             }
             !(isset($mag)) ?: $mag->calculate($parameter);
          }
       }
   }




   public function getIterator() 
   {

     return new ArrayGenerator($this->parameters);
   }
}