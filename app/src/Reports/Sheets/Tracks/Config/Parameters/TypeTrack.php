<?php

namespace App\Reports\Sheets\Tracks\Config\Parameters;

use App\Reports\Library\Parameters\Generic\IParameterAgg;

class TypeTrack implements IParameterAgg
{
   protected $type;
   const TRACK = 'TRACK';

    public function calculate($parameters)
    {
        $this->type = $parameters['value'];
    }

    public function getCalculatedValue()
    {  
        return self::TRACK;
    }

}