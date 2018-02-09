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
        $datefrom = $dateFrom;//'2018-01-19';
        $dateTo = $dateTo;//'2018-01-25';
     

        $repository = new DeviceRepository($this->conn);
        $xRecords = $repository->xFindDeviceTracksByDate($deviceId, $datefrom, $dateTo);

        $parameters = [];
       
        $trackGen = new TrackGenerator(new FactoryPoint($oa, $filterDictionary, $aggDictionary), new FactoryTrack());
        $device = new DeviceModel($deviceId, $xRecords, $trackGen);
        $device->processTracks();
        $device->generateTracks();
        return $device;
    }
 
    public function getDataByDay($device_id, $dateDay, $map)
    { 
        $path = getcwd();
        $map = include $path.'/app/src/Reports/Sheets/Tracks/Config/Schema/Map.php';
        
        $oa = new ArrayToObject();
        $oa = $oa->arrayToObject($map);
        
        $filterDictionary = new FilterDictionary($oa->filters);
        $aggDictionary = new AggregateDictionary($oa->aggregates);
        $filters = $oa->filters;
        $aggregates = $oa->aggregates;
        
        $deviceId = $device_id;
        $day = $dateDay;//'2018-01-25';
        
        $repository = new DeviceRepository($this->conn);
        $xDayRecords = $repository->xFindDeviceByDay($deviceId, $day);

        $parameters = [];
        
        $trackGen = new TrackGenerator(new FactoryPoint($oa, $filterDictionary, $aggDictionary), new FactoryTrack());
        $device = new DeviceModel($deviceId, $xDayRecords, $trackGen);
        $device->processTracks();
        $device->generateTracks(); 
        return $device;
    }

}