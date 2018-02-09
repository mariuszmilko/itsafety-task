<?php

namespace App\Reports\Sheets\Tracks\Config\Parameters;

use App\Reports\Library\Parameters\Generic\IParameterAgg;




class MinSpeed implements IParameterAgg
{
    protected $min = 1000000;

    public function calculate($parameters)
    {
        $this->min = $this->min > $parameters['value'] ? $parameters['value'] : $this->min; 
    }

    public function getCalculatedValue()
    {  
        return $this->min;
    }
}