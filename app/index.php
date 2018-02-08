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

// $firstResolver = new \React\Promise\Deferred();
// $secondResolver = new \React\Promise\Deferred();

// $pending = [
//     $firstResolver->promise(),
//     $secondResolver->promise()
// ];

// $promise = \React\Promise\all($pending)->then(function($resolved){
//     print_r($resolved); // [10, 20]
// });

// $firstResolver->resolve(10);
// $secondResolver->resolve(20);

$resolver = function (callable $resolve, callable $reject) use ($container) {
  // $report = $container->get(ReportDateRange::class);

  $conn = new PDO('mysql:host=172.31.0.2;dbname=itsafety;port=3306','root','p@ssw0rd');

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
  
  $repository = new DeviceRepository($conn);
  $xRecords = $repository->xFindDeviceTracksByDate($deviceId, $datefrom, $dateTo);
  $parameters = [];
  
  $trackGen = new TrackGenerator(new FactoryPoint($oa, $filterDictionary, $aggDictionary), new FactoryTrack());
  $device = new DeviceModel($deviceId, $xRecords, $trackGen);
  $device->generateTracks();
  $resolve($device->getTracks());
};

$canceller = function (callable $resolve, callable $reject) {
    $reject(new \Exception('Brak raportu'));
};


$promise = new React\Promise\Promise($resolver, $canceller);

$promise->then(function ($x) {

            return $x;
        })
        ->done(function($data){
            print_r($data);
            echo "not real: ".(memory_get_peak_usage(false)/1024/1024)." MiB\n";
            echo "real: ".(memory_get_peak_usage(true)/1024/1024)." MiB\n\n";
        });


$loop->run();
