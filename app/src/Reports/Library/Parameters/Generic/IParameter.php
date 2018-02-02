<?php

namespace App\Reports\Library\Parameters\Generic;


interface IParameterAgg extends IParameter
{
    public function calculate($parameters);
}