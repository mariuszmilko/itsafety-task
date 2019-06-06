<?php

namespace App\Reports\Library\Classes\Factory\Generic;

use App\Reports\Library\Classes\Domain\Model\Generic\Point\
{
    IPoint
};
use stdClass;

interface IFactoryPoint
{
    public function factory(IPoint $point): IPoint;
}