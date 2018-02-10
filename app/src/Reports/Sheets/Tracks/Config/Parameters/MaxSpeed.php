<?php

namespace App\Reports\Sheets\Tracks\Config\Parameters;

use App\Reports\Library\Parameters\Generic\{IParameterAgg, Parameter as AbstractParameter};




class MaxSpeed extends AbstractParameter implements IParameterAgg
{
   protected $max = 0;

    public function calculate($parameters)
    {
        $this->max = $this->max < $parameters['value'] ? $parameters['value'] : $this->max; 
    }

    public function getCalculatedValue()
    {  
        return $this->max;
    }
}