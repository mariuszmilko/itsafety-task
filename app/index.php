<?php

require_once __DIR__.'/vendor/autoload.php';

use App\Reports\Sheets\Tracks\Repository\Device as DeviceRepository;
use App\Reports\Sheets\Tracks\Model\Device as DeviceModel;
use App\Reports\Sheets\Tracks\Model\TrackGenerator;
use App\Reports\Library\Classes\Config\Config as TrackConfig;
use App\Reports\Library\Classes\Helpers\Arrays\ArrayToObject;
use App\Reports\Library\Classes\Factory\FilterDictionary;
use App\Reports\Library\Classes\Factory\AggregateDictionary;
use App\Reports\Sheets\Tracks\Model\Point;
use App\Reports\Library\Classes\Factory\Point as FactoryPoint;
use App\Reports\Library\Classes\Factory\TrackBuilder;

// Manualy
// 1. Query
// 2. namespaces
// 3. aggregator i filtrowanie
// 4. 


$conn = new PDO('mysql:host=172.31.0.2;dbname=itsafety;port=3306','root','p@ssw0rd');

$path = getcwd();
$map = include $path.'/app/src/Reports/Sheets/Tracks/Config/Schema/Map.php';

$oa = new ArrayToObject();
$oa = $oa->arrayToObject($map);

$filterDictionary = new FilterDictionary($oa->filters);
$aggDictionary = new AggregateDictionary($oa->aggregates);
$filters = $oa->filters;
$aggregates = $oa->aggregates;

$deviceId = 27184;
$datefrom = '2018-01-19';
$dateTo = '2018-01-25';

$repository = new DeviceRepository($conn);
$xRecords = $repository->xFindDeviceTracksByDate($deviceId, $datefrom, $dateTo);
$parameters = [];

$trackGen = new TrackGenerator(new FactoryPoint($oa, $filterDictionary, $aggDictionary), new TrackBuilder());
$device = new DeviceModel($deviceId, $xRecords, $trackGen);
$device->generateTracks();

print_r($device->getTracks());
echo "not real: ".(memory_get_peak_usage(false)/1024/1024)." MiB\n";
  echo "real: ".(memory_get_peak_usage(true)/1024/1024)." MiB\n\n";

// foreach ($xRecords as $row)
// {

//     $device = new DeviceModel($deviceId, $xData, $trackGen);
//          $point = new Point($row, $oa, $filterDictionary, $aggDictionary);
//          print_r($point->filtering($parameters)
//                     ->delimiter());
//     //   foreach ($filters as $fMap){

//     //    //  print_r($fMap);
     
//     //     $filter = $filterDictionary->get($fMap->class);


//     //     if (isset($point[$fMap->rowname]) && 
//     //         isset($filter) && 
//     //         $filter->filter(['value' => $point[$fMap->rowname]])) {

//     //       foreach ($aggregates  as $gMap) {  
//     //         if ($gMap->type == $fMap->type) {
//     //             $type = $fMap->type;
//     //         } else {
//     //             continue;
//     //         }
           
//     //         if (isset($parameters[$type][$gMap->class])) {
//     //             $agg = $parameters[$type][$gMap->class];
//     //         } else {
//     //             $agg = $aggDictionary->get($gMap->class);  
//     //             $parameters[$type][$gMap->class] = $agg;
//     //         }

//     //         $agg->calculate(['value' => $point[$gMap->rowname], 'index' => 1]); // $point->value 
//     //        }
//     //     }
        
//     // }




// }

//var_dump($oa->filters);
//var_dump($oa->aggregates);
exit('xxx');

//TODO
//$builder = new DI\ContainerBuilder();
//$container = $builder->build();
//$container->addDefinitions('config.php');

// var_dump($builder);
// var_dump($conn);
//exit('xxx');
// $loop = React\EventLoop\Factory::create();



// $resolver = function (callable $resolve, callable $reject) use ($container) {
//    $report = $container->get(ReportDateRange::class);
//    $resolve($report->generate());
// };

// $canceller = function (callable $resolve, callable $reject) {
//     $reject(new \Exception('Brak raportu'));
// };


// $promise = new React\Promise\Promise($resolver, $canceller);

// $promise->then(function ($x) {
//             // $x will be the value passed to $deferred->resolve() below
//             // and returns a *new promise* for $x + 1
//            // sleep(10);
//             return $x;
//         })
//         ->done(function($data){
//             echo 'Done: ' . $data . PHP_EOL;
//         });





// $loop->run();
