<?php

namespace App\Reports\Library\Classes\Domain\Model;

use App\Reports\Library\Classes\Domain\Model\Generic\Point\{IPoint, IPointProcess, IPointUpdate};
use App\Reports\Library\Classes\Domain\Model\Generic\Parameter\{IProcessAndUpdate};
use App\Reports\Library\Classes\Domain\Model\Generic\Track\{IType};
use App\Reports\Library\Classes\Helpers\Validators\TrackValidator;
use App\Reports\Library\Classes\Helpers\Generic\IValidLength;
use App\Reports\Library\Classes\Helpers\Arrays\ArrayGenerator;




class Track implements IType, \IteratorAggregate
{


   protected $parameterTrack;


   protected $length = 0;




   public function __construct(IProcessAndUpdate $parameter)
   {
       $this->parameterTrack = $parameter;
   }
   



   public function getParameter(string $name) 
   {
       if (!isset($this->parameterTrack)) 
          throw new Exception('Błędna nazwa parametru');
        
       return $this->parameterTrack->getParameter($name);
   }




   public function processPoint(IPoint $point)
   {
        $this->parameterTrack->processing($point); 
        $this->length++;
   }




   public function updateOnEnd(IPoint $point)
   {
       $this->parameterTrack->getDateAggData($point);

       return $this;
   }




   public function isValidLength(IValidLength $tValid)
   {

       return $tValid->isValidLength($this->length);
   }




   public function getIterator() 
   {

       return $this->parameterTrack;
   }
}