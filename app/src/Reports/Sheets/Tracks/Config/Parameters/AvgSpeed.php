<?php

namespace App\Reports\Sheets\Tracks\Config\Parameters;

use App\Reports\Library\Parameters\Generic\IParameterAgg;




class AvgSpeed implements  IParameterAgg
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
        return ($this->sum/$this->index);
    }

    public function handleOperation($value)
    {

    } 

    public function setSuccessor($nextParam)
    {

    }

}