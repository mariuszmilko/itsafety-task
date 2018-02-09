<?php

namespace App\Reports\Sheets\Tracks\Config\Parameters;

use App\Reports\Library\Parameters\Generic\{IParameterAgg, IParameterChain};




class SumOdoDistance implements IParameterAgg, IParameterChain 
{
   protected $start = 0;
   protected $end = 0;
   protected $first = false;

    public function calculate($parameters)
    {
        if ($parameters['value'] > 0) {
            if ($this->first == false) {
                $this->start = $parameters['value'];
                $this->first = true;
            } else {
                $this->end = $parameters['value'];
            }
        }
    }

    public function getCalculatedValue()
    {  
        return $this->end - $this->first;
    }

    public function __toString()
    {
        return (string)$this->getCalculatedValue();
    }

    public function handleOperation($value)
    {
        print_r('sum_distance');
        exit('chainOnEnd');
    } 
    
    public function setSuccessor($nextParam)
    {
        print_r('sum_distance');
        exit('chainOnEnd');
    }

}