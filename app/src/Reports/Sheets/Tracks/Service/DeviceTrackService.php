<?php

namespace App\Reports\Library\Classes\Repository;


class DeviceTrackService
{
   protected $device;

   public function __construct($device, $repository, $trackGenerator)
   {
       $this->device = $device;
       $this->repository = $repository;
       $this->trackGenerator = $trackGenerator;
   }

    public function getDataByDate($device_id, $dateFrom, $dateTo)
    {
       $xData = $device->xFindDeviceTracksByDate($deviceId = 40285, $datefrom = '2018-01-19', $dateTo='2018-01-25');
 
       $deviceModel =  new DeviceModel($deviceId = 40285, $xData, $this->trackGenerator);
       $deviceModel->generateTracks();
       $deviceModel->getTracks();
    }
 
    public function getDataByDay($dateDay)
    {
 
    }

}