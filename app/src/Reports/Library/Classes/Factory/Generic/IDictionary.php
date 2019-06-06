<?php

namespace App\Reports\Library\Classes\Factory\Generic;

use stdClass;

interface IDictionary
{
    public function get(string $key);

    public function fillDictionary(stdClass $data);
}