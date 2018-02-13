<?php

namespace App\Reports\Library\Parameters\Generic;

use App\Reports\Library\Parameters\Generic\{IParameterAgg, IParameter};




interface IMultiAggregator extends IParameter
{



    public function calculate(IParameterAgg $parameter);
    public function getCalculatedValue();
}