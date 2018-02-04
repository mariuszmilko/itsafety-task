<?php

namespace App\Reports\Library\Classes\Repository\Device;

use App\Reports\Library\Classes\Repository\IRepository;

interface IDeviceRepository extends IRepository
{
    public function xFindDeviceTracksByDate($deviceId, $dateFrom, $dateTo);
    public function xFindDeviceByDay($deviceId, $day);
}