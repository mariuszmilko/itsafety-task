<?php

namespace App\Reports\Library\Classes\Factory\Generic;

use App\Reports\Library\Parameters\Generic\IParameter;
use stdClass;

interface IDictionary
{
    public function get(string $key);

    public function fillDictionary(stdClass $data);
}