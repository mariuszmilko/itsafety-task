<?php

namespace App\Reports\Library\Classes\Factory\Generic;

use App\Reports\Library\Classes\Domain\Model\Generic\Device\
{
    IDevice
};


interface IFactoryDevice
{
    public function factory(int $deviceId, \Generator $xRecords): IDevice;
}