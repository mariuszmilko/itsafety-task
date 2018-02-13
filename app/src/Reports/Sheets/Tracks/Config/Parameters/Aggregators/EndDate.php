<?php

namespace App\Reports\Sheets\Tracks\Config\Parameters\Aggregators;

use App\Reports\Library\Parameters\Generic\{IMultiAggregator, IParameterAgg};




class EndDate implements  IMultiAggregator
{


    protected  $endDate;


    protected  $last = false;




    public function calculate(IParameterAgg $parameter)
    {
        if ($this->last == false) {
            $this->endDate = $parameter->getCalculatedValue();
        }
    }




    public function getCalculatedValue()
    {  
        return $this->endDate;
    }




    public function  __toString()
    {
        return 'Data Końcowa: '.$this->getCalculatedValue();
    }
}