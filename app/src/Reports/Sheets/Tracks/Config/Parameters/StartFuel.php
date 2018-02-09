<?php

namespace App\Reports\Sheets\Tracks\Config\Parameters;

use App\Reports\Library\Parameters\Generic\IParameterAgg;




class StartFuel implements IParameterAgg
{
   protected $last;
   protected $first = false;
   protected $next;

    public function calculate($parameters)
    {
        if ($this->first == false) {
         $this->value = $parameters['value'];
         $this->first = true;
        }
    }

    public function getCalculatedValue()
    {  
        return $this->value;
    }

    public function  __toString()
    {
        return (string)$this->getCalculatedValue();
    }
}