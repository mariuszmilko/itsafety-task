<?php

namespace App\Reports\Library\Parameters\Generic;

use App\Reports\Library\Parameters\Generic\IParameter;

interface IParameterChain  extends IParameter
{



    public function handleOperation($value); 
    public function setSuccessor($nextParam);
}