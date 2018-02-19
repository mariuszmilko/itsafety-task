<?php

namespace App\Reports\Library\Classes\Domain\Service;

use App\Reports\Library\Classes\Repository\Device\IDeviceRepository;
use App\Reports\Library\Classes\Factory\Generic\IFactoryDevice;
use App\Reports\Library\Classes\Service\IService;
use stdClass;




class DeviceTrackService implements IService
{


   protected $repository;


   protected $factoryDevice;

   
   protected $conn;




   public function __construct(IDeviceRepository $repository, IFactoryDevice $factoryDevice, \PDO $conn)
   {
       $this->repository = $repository;
       $this->factoryDevice = $factoryDevice;
       $this->conn = $conn;
   }


    public function getDataByDate(int $deviceId, string $dateFrom, string $dateTo)
    {   
        $deviceId = $deviceId;
        $datefrom = $dateFrom;
        $dateTo = $dateTo;

        $xRecords = $this->repository->xFindDeviceTracksByDate($deviceId, $datefrom, $dateTo);
       
        $device = $this->factoryDevice->factory($deviceId,  $xRecords);
        $device->processTracks();

        return $device;
    }
 



    public function getDataByDay(int $device_id, string $dateDay)
    { 
        $deviceId = $device_id;
        $day = $dateDay;
        
        $xRecords = $this->repository->xFindDeviceByDay($deviceId, $day);
       
        $device = $this->factoryDevice->factory($deviceId,  $xRecords);
        $device->processTracks();

        return $device;
    }
}