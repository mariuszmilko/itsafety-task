<?php
/**
 * Created by PhpStorm.
 * User: mariuszmilko
 * Date: 06.06.2019
 * Time: 13:50
 */

namespace App\Reports\Sheets\Tracks\Config\Parameters\Values\Generic;


abstract class Value
{
    protected $value;

    public function  __construct(?string $value)
    {
        $this->value  = $value;
    }

    public function __toString()
    {
        return (string) $this->value;
    }
}