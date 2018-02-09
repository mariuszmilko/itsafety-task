<?php

namespace App\Reports\Sheets\Tracks\Service;

use App\Reports\Library\Classes\Domain\Repository\Device as DeviceRepository;
use App\Reports\Library\Classes\Domain\Model\{Device as DeviceModel, Point, TrackGenerator};
use App\Reports\Library\Classes\Config\Config as TrackConfig;
use App\Reports\Library\Classes\Helpers\Arrays\ArrayToObject;
use App\Reports\Library\Classes\Factory\{FilterDictionary, AggregateDictionary, Point as FactoryPoint, Track as FactoryTrack};
use App\Reports\Library\Classes\Service\IService;


class DeviceTrackService implements IService
{
   protected $device;
   protected $conn;

   public function __construct($device, $repository, $trackGenerator, $conn)
   {
       $this->device = $device;
       $this->repository = $repository;
       $this->trackGenerator = $trackGenerator;
       $this->conn = $conn;
   }

    public function getDataByDate($device_id, $dateFrom, $dateTo, $map)
    {   
        $oa = new ArrayToObject();
        $oa = $oa->arrayToObject($map);
       
        $filterDictionary = new FilterDictionary($oa->filters);
        $aggDictionary = new AggregateDictionary($oa->aggregates);
        $filters = $oa->filters;
        $aggregates = $oa->aggregates;
       
        $deviceId = $device_id;
        $datefrom = $dateFrom;
        $dateTo = $dateTo;
     

        $repository = new DeviceRepository($this->conn);
        $xRecords = $repository->xFindDeviceTracksByDate($deviceId, $datefrom, $dateTo);

        $parameters = [];
       
        $trackGen = new TrackGenerator(new FactoryPoint($oa, $filterDictionary, $aggDictionary), new FactoryTrack());
        $device = new DeviceModel($deviceId, $xRecords, $trackGen);
        $device->processTracks();
        $device->generateTracks();

         return $device->getTracks();
    }
 
    public function getDataByDay($device_id, $dateDay, $map)
    { 
        $oa = new ArrayToObject();
        $oa = $oa->arrayToObject($map);
        
        $filterDictionary = new FilterDictionary($oa->filters);
        $aggDictionary = new AggregateDictionary($oa->aggregates);
        $filters = $oa->filters;
        $aggregates = $oa->aggregates;
        
        $deviceId = $device_id;
        $day = $dateDay;
        
        $repository = new DeviceRepository($this->conn);
        $xDayRecords = $repository->xFindDeviceByDay($deviceId, $day);

        $parameters = [];
        
        $trackGen = new TrackGenerator(new FactoryPoint($oa, $filterDictionary, $aggDictionary), new FactoryTrack());
        $device = new DeviceModel($deviceId, $xDayRecords, $trackGen);
        $device->processTracks();
        $device->generateTracks(); 

        return $device->getTracks();
    }

}