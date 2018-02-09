<?php

namespace App\Reports\Sheets\Tracks\Config\Parameters;

use App\Reports\Library\Parameters\Generic\{IParameterAgg, IParameterChain};




class StopFuel implements IParameterAgg, IParameterChain
{
   protected $value;
   protected $first = false;

    public function calculate($parameters)
    {
         $this->value = $parameters['value'];
    }

    public function getCalculatedValue()
    {  
        return $this->value;
    }

    public function handleOperation($value)
    {
        print_r('stop_fuel');
         exit('chainOnEnd');
    } 
    
    public function setSuccessor($nextParam)
    {
        print_r('stop_fuel');
        exit('chainOnEnd');
    }

}