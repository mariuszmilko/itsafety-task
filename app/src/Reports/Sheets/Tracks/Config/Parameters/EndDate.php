<?php

namespace App\Reports\Sheets\Tracks\Config\Parameters;

use App\Reports\Library\Parameters\Generic\{IParameterAgg, Parameter as AbstractParameter};




class EndDate extends AbstractParameter implements IParameterAgg
{
    protected  $endDate;
    protected  $last = false;

    public function calculate($parameters)
    {
        if ($this->last == false) {
            $this->endDate = $parameters['value'];
        }
    }

    public function getCalculatedValue()
    {  
        return $this->endDate;
    }

}