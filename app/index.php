<?php

require_once __DIR__.'/vendor/autoload.php';


use App\Reports\Sheets\Tracks\Service\DeviceTrackService;
use App\Reports\Sheets\Tracks\Reports\Classes\{ReportDateRange, ReportDay};

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
$loader = new Twig_Loader_Filesystem($path.'/app/src/Reports/Sheets/Tracks/Reports/Documents');
$template = new Twig_Environment($loader, array(
    'cache' => $path.'/app/Cache',
    'debug' => true,
));
$template->addExtension(new Twig_Extension_Debug());


$map = include $path.'/app/src/Reports/Sheets/Tracks/Config/Schema/Map.php';
$service = new DeviceTrackService(null, null, null, $conn);


$resolverDateRange = function (callable $resolve, callable $reject) use ($service, $template, $map) {
    // $report = $container->get(ReportDateRange::class);
    $report = new ReportDateRange(
        $service, 
        $template, 
        $map,
        ['deviceId' => 36580,'dateFrom' => '2018-01-19', 'dateTo' => '2018-01-25']
    );
    $resolve($report->generate());
};

$resolverDay = function (callable $resolve, callable $reject) use ($service, $template, $map) {
    // $report = $container->get(ReportDateRange::class);

    $report = new ReportDay(
        $service, 
        $template, 
        $map,
        ['deviceId' => 36580,'day' => '2018-01-25']
    );
    $resolve($report->generate());
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

$loop->run();
