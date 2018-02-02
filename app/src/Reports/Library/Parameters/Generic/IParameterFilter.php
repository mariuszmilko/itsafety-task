<?php

namespace App\Reports\Library\Parameters\Generic;


interface IParameterFilter extends IParameter
{
    public function filter($parameters);
}