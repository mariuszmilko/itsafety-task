<?php

namespace App\Reports\Library\Parameters\Generic;

use App\Reports\Library\Parameters\Generic\IParameter;

interface IParameterFilter extends IParameter
{
    public function filter(array $parameters);
}