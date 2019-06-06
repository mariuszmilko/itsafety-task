<?php

namespace App\Reports\Library\Classes\Repository\Device;

use App\Reports\Library\Classes\Repository\IRepository;


interface IDeviceRepository extends IRepository
{
    public function xFindDeviceTracksByDate(int $deviceId, string $dateFrom, string $dateTo): \Generator;
    public function xFindDeviceByDay(int $deviceId, string $day): \Generator;
}