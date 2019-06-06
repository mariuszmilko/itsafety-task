<?php

namespace App\Reports\Library\Classes\Helpers\Generic;


interface IValidLength
{
    public function isValidLength(int $length = 0): bool;
}