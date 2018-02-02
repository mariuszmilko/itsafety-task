<?php

namespace App\Reports\Sheets\Tracks\Config\Parameters;

class StartFuel implements IParameterAgg
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

}