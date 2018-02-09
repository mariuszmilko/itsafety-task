<?php

require_once __DIR__.'/vendor/autoload.php';

use App\Reports\Library\Classes\Domain\Repository\Device as DeviceRepository;
use App\Reports\Library\Classes\Domain\Model\{Device as DeviceModel, Point, TrackGenerator};
use App\Reports\Library\Classes\Config\Config as TrackConfig;
use App\Reports\Library\Classes\Helpers\Arrays\ArrayToObject;
use App\Reports\Library\Classes\Factory\{FilterDictionary, AggregateDictionary, Point as FactoryPoint, Track as FactoryTrack};


// Manualy bez DI
//TODO
//$builder = new DI\ContainerBuilder();
//$container = $builder->build();
//$container->addDefinitions('config.php');

// var_dump($builder);
// var_dump($conn);
//exit('xxx');
 $loop = React\EventLoop\Factory::create();

$conn = new PDO('mysql:host=172.31.0.2;dbname=itsafety;port=3306','root','p@ssw0rd');

$resolverDateRange = function (callable $resolve, callable $reject) use ($container, $conn) {
  // $report = $container->get(ReportDateRange::class);

  $path = getcwd();
  $map = include $path.'/app/src/Reports/Sheets/Tracks/Config/Schema/Map.php';
  
  $oa = new ArrayToObject();
  $oa = $oa->arrayToObject($map);
  
  $filterDictionary = new FilterDictionary($oa->filters);
  $aggDictionary = new AggregateDictionary($oa->aggregates);
  $filters = $oa->filters;
  $aggregates = $oa->aggregates;
  
  $deviceId = 36580;
  $datefrom = '2018-01-19';
  $dateTo = '2018-01-25';

  $day = '2018-01-25';
  
  $repository = new DeviceRepository($conn);
  $xRecords = $repository->xFindDeviceTracksByDate($deviceId, $datefrom, $dateTo);
  $xDayRecords = $repository->xFindDeviceByDay($deviceId, $day);
  $parameters = [];
  
  $trackGen = new TrackGenerator(new FactoryPoint($oa, $filterDictionary, $aggDictionary), new FactoryTrack());
  $device = new DeviceModel($deviceId, $xRecords, $trackGen);
  $device->processTracks();
  $device->generateTracks();
  $resolve($device->getTracks());
};

$resolverDay = function (callable $resolve, callable $reject) use ($container, $conn) {
    // $report = $container->get(ReportDateRange::class);

    $path = getcwd();
    $map = include $path.'/app/src/Reports/Sheets/Tracks/Config/Schema/Map.php';
    
    $oa = new ArrayToObject();
    $oa = $oa->arrayToObject($map);
    
    $filterDictionary = new FilterDictionary($oa->filters);
    $aggDictionary = new AggregateDictionary($oa->aggregates);
    $filters = $oa->filters;
    $aggregates = $oa->aggregates;
    
    $deviceId = 36580;
    $day = '2018-01-25';
    
    $repository = new DeviceRepository($conn);
    $xDayRecords = $repository->xFindDeviceByDay($deviceId, $day);

    $parameters = [];
    
    $trackGen = new TrackGenerator(new FactoryPoint($oa, $filterDictionary, $aggDictionary), new FactoryTrack());
    $device = new DeviceModel($deviceId, $xDayRecords, $trackGen);
    $device->processTracks();
    $device->generateTracks();
    $resolve($device->getTracks());
  };

$cancellerDateRange = function (callable $resolve, callable $reject) {
    $reject(new \Exception('Brak raportu'));
};

$cancellerDay = function (callable $resolve, callable $reject) {
    $reject(new \Exception('Brak raportu'));
};

$pending = [
    new React\Promise\Promise($resolverDateRange, $cancellerDateRange),
    new React\Promise\Promise($resolverDay, $cancellerDay)
 ];

$promise = \React\Promise\all($pending)->done(function($resolved){
    print_r($resolved); 
    echo "not real: ".(memory_get_peak_usage(false)/1024/1024)." MiB\n";
    echo "real: ".(memory_get_peak_usage(true)/1024/1024)." MiB\n\n";
});


//  $firstResolver = new \React\Promise\Deferred($resolverDay);
//  $secondResolver = new \React\Promise\Deferred($resolverDateRange);

// $pending = [
//     $firstResolver->promise($resolverDay, $cancellerDay),
//     $secondResolver->promise($resolverDateRange, $cancellerDateRange)
// ];

// $promise = new React\Promise\Promise($resolverDateRange, $cancellerDateRange);

// $promise->then(function ($x) {

//             return $x;
//         })
//         ->done(function($data){
//             print_r($data);
//             echo "not real: ".(memory_get_peak_usage(false)/1024/1024)." MiB\n";
//             echo "real: ".(memory_get_peak_usage(true)/1024/1024)." MiB\n\n";
//         });


$loop->run();
