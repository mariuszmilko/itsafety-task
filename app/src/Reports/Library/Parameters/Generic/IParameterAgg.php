<?php

namespace App\Reports\Library\Parameters\Generic;


interface IParameterAgg
{
    public function calculate($parameters);
}