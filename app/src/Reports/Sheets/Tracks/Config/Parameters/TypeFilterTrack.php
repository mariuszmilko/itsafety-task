<?php

namespace App\Reports\Sheets\Tracks\Config\Parameters;

use  App\Reports\Library\Parameters\Generic\IParameterFilter;




class TypeFilterTrack implements IParameterFilter
{


    public function filter($parameters)
    {
        return $parameters['value'] > 2;
    }

}