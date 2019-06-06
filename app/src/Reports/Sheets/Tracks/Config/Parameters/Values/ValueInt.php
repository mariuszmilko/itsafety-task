<?php
/**
 * Created by PhpStorm.
 * User: mariuszmilko
 * Date: 06.06.2019
 * Time: 13:55
 */

namespace App\Reports\Sheets\Tracks\Config\Parameters\Values;

use App\Reports\Sheets\Tracks\Config\Parameters\Values\Generic\Value;

final class ValueInt extends Value
{
    public function __invoke(): int
    {
       return (int) $this->value;
    }
}