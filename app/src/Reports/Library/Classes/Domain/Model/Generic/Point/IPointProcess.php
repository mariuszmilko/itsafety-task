<?php

namespace App\Reports\Library\Classes\Domain\Model\Generic\Point;


use App\Reports\Library\Classes\Domain\Model\Generic\Point\IPoint;

interface IPointProcess extends IPoint
{
    public function delimiter();
}