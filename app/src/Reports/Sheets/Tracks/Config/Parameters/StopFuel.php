<?php

namespace App\Reports\Sheets\Tracks\Config\Parameters;

use App\Reports\Library\Parameters\Generic\IParameterAgg;




class StopFuel implements IParameterAgg
{
   protected $value;
   protected $first = false;

    public function calculate($parameters)
    {
         $this->value = $parameters['value'];
    }

    public function getCalculatedValue()
    {  
        return $this->value;
    }

}