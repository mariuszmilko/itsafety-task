<?php

namespace App\Reports\Library\Classes\Domain\Model\Generic\Point;

use App\Reports\Library\Classes\Domain\Model\Generic\Point\IPoint;


interface IPointUpdate extends IPoint
{
    public function getDateAggData(array &$parameters);
}