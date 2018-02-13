<?php

namespace App\Reports\Sheets\Tracks\Config\Parameters\Aggregators;

use App\Reports\Library\Parameters\Generic\{IMultiAggregator, IParameterAgg};




class StartDate implements  IMultiAggregator
{


    protected  $startDate;


    protected  $first = false;




    public function calculate(IParameterAgg $parameter)
    {
        if ($this->first == false) {
            $this->startDate = $parameter->getCalculatedValue();
            $this->first = true;
        }
    }




    public function getCalculatedValue()
    {  
        return $this->startDate;
    }




    public function  __toString()
    {
        return "Parametr: ".(string)$this->getName()."\r\nKoniec dla zakresu: ".$this->getCalculatedValue();
    }
}