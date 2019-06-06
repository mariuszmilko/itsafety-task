<?php

namespace App\Reports\Library\Parameters\Generic;

use App\Reports\Sheets\Tracks\Config\Parameters\Values\Generic\Value;

interface IParameterAgg extends IParameter
{
    public function calculate(array $parameters): void;
    public function getCalculatedValue(): Value;
}