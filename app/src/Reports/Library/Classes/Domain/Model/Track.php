<?php

namespace App\Reports\Library\Classes\Domain\Model;

use App\Reports\Library\Classes\Domain\Model\Generic\Point\{IPointProcess, IPointUpdate};
use App\Reports\Library\Classes\Domain\Model\Generic\Track\{IType};
use App\Reports\Library\Classes\Helpers\Validators\TrackValidator;




class Track implements IType, \IteratorAggregate
{


   protected $parameters = [];


   protected $length = 0;




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




   public function processPoint(IPointProcess $point)
   {
        $point->processing($this->parameters);  //callable test fail
        $this->length++;
   }




   public function updateOnEnd(IPointUpdate $point)
   {
       $point->getDateAggData($this->parameters['end']); //dla ułatwienia później słownik

       return $this;
   }




   public function isValidLength(TrackValidator $tValid)
   {
       return $tValid->isMinLength($this->length);
   }




   public function getIterator() {
       return new \ArrayIterator($this->parameters);
   }
}