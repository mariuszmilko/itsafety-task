<?php

namespace App\Reports\Sheets\Tracks\Config\Parameters;

class TypeTrack implements IParameterFilter
{
   protected $sum = 0;
   protected $maxCount = 0;
   const TRACK = 2;

    public function filter($parameters)
    {
        return $parameters['value'] > self::TRACK;
    }

}