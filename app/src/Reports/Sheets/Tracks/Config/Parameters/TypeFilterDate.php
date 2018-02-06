<?php

namespace App\Reports\Sheets\Tracks\Config\Parameters;

use  App\Reports\Library\Parameters\Generic\IParameterFilter;




class TypeFilterDate implements IParameterFilter
{
   protected $value = null;

    public function filter($parameters)
    {
        //isdate format
        return true;
    }
    
}