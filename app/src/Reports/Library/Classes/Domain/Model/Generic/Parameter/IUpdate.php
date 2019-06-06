<?php

namespace App\Reports\Library\Classes\Domain\Model\Generic\Parameter;

use App\Reports\Library\Classes\Domain\Model\Generic\Parameter\IParameterTrack;
use App\Reports\Library\Classes\Domain\Model\Generic\Point\
{
    IPointData
};


interface IUpdate extends IParameterTrack
{
    public function getEndLastAware();
    public function getDateAggData(IPointData $point);
}



