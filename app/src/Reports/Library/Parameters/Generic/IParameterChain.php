<?php

namespace App\Reports\Library\Parameters\Generic;

use App\Reports\Sheets\Tracks\Config\Parameters\Values\Generic\Value;

interface IParameterChain extends IParameter
{
    public function handleOperation(Value $value): void;
    public function setSuccessor(IParameter $nextParam): void;
}