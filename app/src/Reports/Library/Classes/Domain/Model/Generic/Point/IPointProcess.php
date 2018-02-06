<?php

namespace App\Reports\Library\Classes\Domain\Model\Generic\Point;

use App\Reports\Library\Classes\Domain\Model\Generic\Point\IPoint;


interface IPointProcess
{
    public function delimiter();
    public function filtering(array &$parameters);
}