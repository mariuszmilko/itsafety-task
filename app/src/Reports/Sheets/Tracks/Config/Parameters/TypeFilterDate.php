<?php

namespace App\Reports\Sheets\Tracks\Config\Parameters;

use  App\Reports\Library\Parameters\Generic\IParameterFilter;


class TypeFilterDate implements IParameterFilter
{
    /**
     * @param array $parameters
     * @return bool
     */
    public function filter(array $parameters): bool
    {
        return true;
    }
}