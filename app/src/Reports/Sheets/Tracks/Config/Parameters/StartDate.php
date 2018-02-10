<?php

namespace App\Reports\Sheets\Tracks\Config\Parameters;

use App\Reports\Library\Parameters\Generic\{IParameterAgg, Parameter as AbstractParameter};




class StartDate extends AbstractParameter implements IParameterAgg
{
    protected  $startDate;
    protected  $first = false;

    public function calculate($parameters)
    {
        if ($this->first == false) {
            $this->startDate = $parameters['value'];
            $this->first = true;
        }
    }

    public function getCalculatedValue()
    {  
        return $this->startDate;
    }

    public function  __toString()
    {
        return "Parametr: ".(string)$this->getName()."\r\nWartość: ".$this->getCalculatedValue();
    }

}