<?php

namespace App\Reports\Library\Classes\Domain\Model\Generic\Point;


interface IPointData extends IPoint
{
    public function getField(string $name);
    public function getData();
}