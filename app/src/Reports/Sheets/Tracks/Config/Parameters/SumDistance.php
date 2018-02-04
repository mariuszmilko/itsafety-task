<?php

namespace App\Reports\Sheets\Tracks\Config\Parameters;

use App\Reports\Library\Parameters\Generic\IParameterAgg;

class SumDistance implements IParameterAgg
{
   protected $sum = 0;
   protected $maxCount = 0;
   protected $index = 0;

    public function calculate($parameters)
    {
        $this->sum += $parameters['value'];
        $this->index += $parameters['index'];
    }

    public function getCalculatedValue()
    {  
        return $this->sum;
    }

}