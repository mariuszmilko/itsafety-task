<?php

namespace App\Reports\Library\Parameters\Generic;



interface IParameterChain 
{



    public function handleOperation($value); 
    public function setSuccessor($nextParam);
}