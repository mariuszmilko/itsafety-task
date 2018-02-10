<?php

namespace App\Reports\Sheets\Tracks\Config\Parameters;

use App\Reports\Library\Parameters\Generic\{IParameterAgg, Parameter as AbstractParameter};

class EndFuel extends AbstractParameter implements IParameterAgg
{
   protected $sum = 0;
   protected $maxCount = 0;

    public function calculate($parameters)
    {
        $this->sum += $parameters['value'];
        $this->index += $parameters['index'];
    }

    public function getCalculatedValue()
    {  
        return ($this->sum/$this->index);
    }

    public function  __toString()
    {
        return "Parametr: ".$this->getName()."\r\nWartość: ".$this->getCalculatedValue();
    }

}