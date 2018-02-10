<?php

namespace App\Reports\Sheets\Tracks\Config\Parameters;

use App\Reports\Library\Parameters\Generic\{IParameterAgg, IParameterChain, Parameter as AbstractParameter};




class SumDistance extends AbstractParameter implements IParameterAgg, IParameterChain
{
   protected $sum = 0;
   protected $maxCount = 0;
   protected $index = 0;

    public function calculate($parameters)
    {
        $this->sum += $parameters['value'];
        $this->index += 1;
    }

    public function getCalculatedValue()
    {  
        return $this->sum;
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