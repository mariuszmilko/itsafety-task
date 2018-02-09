<?php

namespace App\Reports\Sheets\Tracks\Config\Parameters;

use  App\Reports\Library\Parameters\Generic\IParameterFilter;




class TypeFilterStop implements IParameterFilter
{
   protected $value = null;

    public function filter($parameters)
    {
        return $parameters['value'] <= 2;
    }
    
}