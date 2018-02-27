<?php

namespace App\Reports\Library\Classes\Domain\Model\Generic\Parameter;

use App\Reports\Library\Classes\Domain\Model\Generic\Parameter\{IParameterTrack, IProcess, IUpdate};
use App\Reports\Library\Classes\Domain\Model\Generic\Point\{IPointData};




interface IProcessAndUpdate extends IProcess, IUpdate
{

}