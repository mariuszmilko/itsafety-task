<?php

namespace App\Reports\Library\Classes\Domain\Model\Generic\Parameter;

use App\Reports\Library\Classes\Domain\Model\Generic\Parameter\
{
    IParameterTrack
};
use App\Reports\Library\Classes\Domain\Model\Generic\Point\
{
    IPointData
};


interface IProcess extends IParameterTrack
{
    public function processing(IPointData $point);
}