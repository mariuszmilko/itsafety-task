<?php

namespace App\Reports\Library\Classes\Domain\Model;

use App\Reports\Library\Classes\Domain\Model\Generic\Point\{IPointProcess, IPointUpdate};
use App\Reports\Library\Classes\Domain\Model\Generic\Track\{IType};



class Track implements IType, \IteratorAggregate
{


   protected $parameters = [];




   public function __construct($parameters)
   {
       $this->parameters = $parameters;
   }
   



   public function getParameter(string $name) 
   {
       if (!isset($this->parameters[$name])) 
          throw new Exception('Błędna nazwa parametru');
        
       return $this->parameters[$name];
   }




   public function getParameters() 
   {
       return $this->parameters;
   }




   public function processPoint(IPointProcess $point)
   {
        $point->processing($this->parameters);  //callable test fail
   }




   public function updateOnEnd(IPointUpdate $point)
   {
       $point->getDateAggData($this->parameters['end']); //dla ułatwienia później słownik
   }




   public function getIterator() {
       return new \ArrayIterator($this->parameters);
   }
}