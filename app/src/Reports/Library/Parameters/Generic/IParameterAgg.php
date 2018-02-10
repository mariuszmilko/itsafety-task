<?php

namespace App\Reports\Library\Parameters\Generic;

use App\Reports\Library\Parameters\Generic\IParameter;




interface IParameterAgg extends IParameter
{



    public function calculate($parameters);
    public function getCalculatedValue();
}