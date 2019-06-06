<?php

namespace App\Reports\Sheets\Tracks\Config\Parameters;

use  App\Reports\Library\Parameters\Generic\IParameterFilter;


/**
 * Class TypeFilterTrack
 * @package App\Reports\Sheets\Tracks\Config\Parameters
 */
class TypeFilterTrack implements IParameterFilter
{
    /**
     * @param array $parameters
     * @return bool
     */
    public function filter(array $parameters): bool
    {
        return $parameters['value'] > 2;
    }
}