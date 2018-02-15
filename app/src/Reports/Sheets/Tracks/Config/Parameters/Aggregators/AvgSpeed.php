<?php

namespace App\Reports\Sheets\Tracks\Config\Parameters\Aggregators;

use App\Reports\Library\Parameters\Generic\{IMultiAggregator, IParameterAgg};




class AvgSpeed implements  IMultiAggregator
{


    protected $sum = 0;


    protected $maxCount = 0;


    protected $index;




    public function calculate(IParameterAgg $parameter)
    {
        $this->sum += $parameter->getCalculatedValue();
        $this->index += 1;
    }




    public function getCalculatedValue()
    {  
        return !($this->index > 0 && $this->sum > 0) ?: ($this->sum/$this->index);
    }




    public function __toString()
    {
        return 'Średnia prędkość: '.$this->getCalculatedValue();
    }
}