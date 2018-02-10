<?php

namespace App\Reports\Sheets\Tracks\Config\Parameters;

use App\Reports\Library\Parameters\Generic\{IParameterAgg, Parameter as AbstractParameter};




class AvgSpeed extends AbstractParameter implements  IParameterAgg
{
   protected $sum = 0;
   protected $maxCount = 0;
   protected $index;

    public function calculate($parameters)
    {
        $this->sum += $parameters['value'];
        $this->index += 1;
    }

    public function getCalculatedValue()
    {  
        return !($this->index > 0 && $this->sum > 0) ?: ($this->sum/$this->index);
    }

    public function  __toString()
    {
        return "Parametr: ".$this->getName()."\r\nWartość: ".$this->getCalculatedValue();
    }
}