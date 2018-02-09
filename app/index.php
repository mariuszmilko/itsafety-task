<?php

require_once __DIR__.'/vendor/autoload.php';


use App\Reports\Sheets\Tracks\Service\DeviceTrackService;

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

$path = getcwd();
$map = include $path.'/app/src/Reports/Sheets/Tracks/Config/Schema/Map.php';
$service = new DeviceTrackService(null, null, null, $conn);


$resolverDateRange = function (callable $resolve, callable $reject) use ($service) {
  // $report = $container->get(ReportDateRange::class);

  $deviceId = 36580;
  $dateFrom = '2018-01-19';
  $dateTo = '2018-01-25';

  $path = getcwd();
  $map = include $path.'/app/src/Reports/Sheets/Tracks/Config/Schema/Map.php';

  $device = $service->getDataByDate($deviceId, $dateFrom, $dateTo, $map);

   $resolve($device->getTracks());
};

$resolverDay = function (callable $resolve, callable $reject) use ($service) {
    // $report = $container->get(ReportDateRange::class);

    $deviceId = 36580;
    $dateDay = '2018-01-25';

    $path = getcwd();
    $map = include $path.'/app/src/Reports/Sheets/Tracks/Config/Schema/Map.php';

    $device = $service->getDataByDay($deviceId, $dateDay, $map);

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
