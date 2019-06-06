<?php

namespace App\Reports\Library\Parameters\Generic;

use App\Reports\Sheets\Tracks\Config\Parameters\Values\Generic\Value;

interface IMultiAggregator extends IParameter
{
    public function calculate(IParameterAgg $parameter);
    public function getCalculatedValue(): Value;
}