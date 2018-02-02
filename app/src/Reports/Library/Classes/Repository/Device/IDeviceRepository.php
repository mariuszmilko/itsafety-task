<?php

namespace App\Reports\Library\Classes\Repository\Device;

use App\Reports\Library\Classes\Repository\IRepository;

interface IDeviceRepository extends IRepository
{
    public function xFindDeviceTracksByDate($dateFrom, $dateTo, $type);
    public function xFindDeviceByDay($date, $type);
}