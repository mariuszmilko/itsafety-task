<?php

namespace App\Reports\Sheets\Tracks\Config\Parameters;

use App\Reports\Library\Parameters\Generic\{IParameterAgg, Parameter as AbstractParameter};


class DiffFuel extends AbstractParameter implements IParameterAgg
{
   protected $first = 0;
   protected $lastValue = 0;
   protected $firstValue;

    public function calculate($parameters)
    {
        if ($this->first == false) {
            $this->firstValue = $parameters['value'];
            $this->first = true;
        } else {
            $this->lastValue = $parameters['value'];;
        }
    }

    public function getCalculatedValue()
    {  
        return $this->firstValue - $this->lastValue;
    }

    public function  __toString()
    {
        return "Parametr: ".$this->getName()."\r\nWartość: ".$this->getCalculatedValue();
    }
}