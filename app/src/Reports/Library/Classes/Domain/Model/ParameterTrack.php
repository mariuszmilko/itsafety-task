<?php

namespace App\Reports\Library\Classes\Domain\Model;

use App\Reports\Library\Classes\Domain\Model\Generic\Track\{IType};
use App\Reports\Library\Classes\Domain\Model\Generic\Point\{IPointData};
use App\Reports\Library\Classes\Factory\Generic\{IDictionary};
use App\Reports\Library\Classes\Helpers\Arrays\ArrayGenerator;
use App\Reports\Library\Classes\Domain\Model\Generic\Parameter\{
    IParameterTrack, 
    IParameterTrackUpdate, 
    IProcessAndUpdate
};



class ParameterTrack implements IProcessAndUpdate, \IteratorAggregate
{


  protected $parameters = []; 




  public function __construct(array $parameters)
  {
     $this->parameters = $parameters;
  }




  public function getEndLastAware()
  {
     return current($this->parameters['end']);
  }




  public function getDateAggData(IPointData $point)
  {
      $p = $this->getEndLastAware();
      $data = $point->getField($p->getRowname());
      $p->calculate(['value' => $data]); 
  }




  public function getParameter(string $name)
  {
      return $this->parameters[$name];
  } 




   public function processing(IPointData $point) //$context  ->get callable
   {          
       foreach ($this->parameters as &$parameter)
       {
         foreach ($parameter as &$p)
         {
            $p->calculate([ 'value' => $point->getField($p->getRowname()) ]);
         }
       }
    }




    public function getIterator() 
    {

        return new ArrayGenerator($this->parameters);
    }
}