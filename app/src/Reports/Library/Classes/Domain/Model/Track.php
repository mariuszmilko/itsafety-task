<?php

namespace App\Reports\Library\Classes\Domain\Model;

use App\Reports\Library\Classes\Domain\Model\Generic\Point\{IPointProcess, IPointUpdate};



class Track implements \IteratorAggregate
{
   protected $parameters = [];



   public function __construct()
   {
       $this->parameters = [];
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
       return $point->filtering($this->parameters);
   }




   public function updateOnEnd(IPointUpdate $point)
   {
       $point->getDateAggData($this->parameters);
   }




   public function getIterator() {
       return new ArrayIterator($this->parameters);
   }

}
