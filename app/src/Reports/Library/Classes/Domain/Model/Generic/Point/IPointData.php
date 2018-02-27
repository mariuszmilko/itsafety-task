<?php

namespace App\Reports\Library\Classes\Domain\Model\Generic\Point;

use App\Reports\Library\Classes\Domain\Model\Generic\Point\IPoint;


interface IPointData extends IPoint
{
    public function getField(string $name);
    public function getData();
}