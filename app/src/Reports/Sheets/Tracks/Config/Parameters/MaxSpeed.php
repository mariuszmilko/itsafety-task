<?php

namespace App\Reports\Sheets\Tracks\Config\Parameters;

use App\Reports\Library\Parameters\Generic\IParameterAgg;




class MaxSpeed implements IParameterAgg
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

    public function  __toString()
    {
        return (string)$this->getCalculatedValue();
    }
}