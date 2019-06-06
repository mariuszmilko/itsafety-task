<?php

namespace App\Reports\Sheets\Tracks\Config\Parameters;

use  App\Reports\Library\Parameters\Generic\IParameterFilter;


/**
 * Class TypeFilterStop
 * @package App\Reports\Sheets\Tracks\Config\Parameters
 */
class TypeFilterStop implements IParameterFilter
{
    /**
     * @param array $parameters
     * @return bool
     */
    public function filter(array $parameters): bool
    {
        return $parameters['value'] <= 2;
    }
}