<?php

namespace App\Reports\Sheets\Tracks\Config\Parameters;

public class TypeTrack implements IParameterFilter
{
   protected $sum = 0;
   protected $maxCount = 0;

    public function compare($parameters)
    {
        return $parameters['value'] > 2;
    }

}