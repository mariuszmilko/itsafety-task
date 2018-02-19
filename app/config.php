<?php

use Psr\Container\ContainerInterface;
use App\Reports\Library\Classes\Helpers\Arrays\ArrayToObject;
use App\Reports\Library\Classes\Domain\Repository\Device as DeviceRepository;
use App\Reports\Library\Classes\Repository\Device\IDeviceRepository;
use App\Reports\Library\Classes\Helpers\Validators\TrackValidator;
use App\Reports\Library\Classes\Domain\Service\DeviceTrackService;
use App\Reports\Sheets\Tracks\Reports\Classes\{ReportDateRange, ReportDay};
use App\Reports\Library\Classes\Factory\{
    FilterDictionary, 
    AggregateDictionary, 
    MultiAggDictionary,
    Point as FactoryPoint, 
    Mapper as FactoryMapper,
    Device as FactoryDevice,
    Track as FactoryTrack,
    Aggregator as FactoryAggregator,
    TrackGenerator as FactoryTrackGenerator};


return [

    'database.host'     => 'mysql:host=172.31.0.2;dbname=itsafety;port=3306',
    
    'database.user'     => 'root',
    
    'database.password' =>  'p@ssw0rd',



    'PDO' => function (ContainerInterface $c) {

        $conn = new \PDO($c->get('database.host'), $c->get('database.user'), $c->get('database.password')); 
  
        return $conn;
    },



    'Map' => function (ContainerInterface $c) {

        $path = getcwd();
        $map = include $path.'/app/src/Reports/Sheets/Tracks/Config/Schema/Map.php';
        $oa = new ArrayToObject();
        $oa = $oa->arrayToObject($map);

        return $oa;
    },



    'filters' => function (ContainerInterface $c) {

        $map = $c->get('Map');

        return $map->filters;
    },



    'aggregates' => function (ContainerInterface $c) {

        $map = $c->get('Map');

        return $map->aggregates;
    },



    'FilterDictionary' => function (ContainerInterface $c) {

        return new FilterDictionary($c->get('filters'));
    },



    'AggregateDictionary' => function (ContainerInterface $c) {

        return new AggregateDictionary($c->get('aggregates'));
    },



    'MultiAggDictionary' => function (ContainerInterface $c) {

        return new MultiAggDictionary($c->get('aggregates'));
    },
   
    

    'DeviceRepository' => function (ContainerInterface $c) {

        return new DeviceRepository($c->get('PDO'));
    },



    'FactoryMapper' => function (ContainerInterface $c) {

        return new FactoryMapper($c->get('Map'), 
        $c->get('FilterDictionary'),
        $c->get('AggregateDictionary')
        );
    },



    'FactoryPoint' => function (ContainerInterface $c) {

        return new FactoryPoint($c->get('FactoryMapper'));
    },



    'FactoryTrack' => function (ContainerInterface $c) {

        return new FactoryTrack($c->get('FactoryMapper'));
    },



    'FactoryAggregator' => function (ContainerInterface $c) {

        return new FactoryAggregator(
            $c->get('FactoryMapper'), 
            $c->get('MultiAggDictionary')
        );
    },



    'FactoryTrackGenerator' => function (ContainerInterface $c) {

        return new FactoryTrackGenerator(
            $c->get('FactoryPoint'), 
            $c->get('FactoryTrack'), 
            $c->get('FactoryAggregator'),
            $c->get('TrackValidator')
        );
    },



    'FactoryDevice' => function (ContainerInterface $c) {

        return new FactoryDevice($c->get('FactoryTrackGenerator'));
    },



    'TrackValidator' => function( ContainerInterface $c) {

        return new TrackValidator();
    },



    'DeviceTrackService'  => function (ContainerInterface $c)  {

        return new DeviceTrackService(
            $c->get('DeviceRepository'), 
            $c->get('FactoryDevice'), 
            $c->get('PDO')
        );
    },



    'ReportDateRange' => function (ContainerInterface $c)  {

        return new ReportDateRange(
            $c->get('DeviceTrackService'), 
            $c->get('Twig_Environment'),
            ['deviceId' => 27184,'dateFrom' => '2018-01-19', 'dateTo' => '2018-01-25']
        );
    },



    'ReportDay' => function (ContainerInterface $c)  {

        return new ReportDay(
            $c->get('DeviceTrackService'), 
            $c->get('Twig_Environment'),
            ['deviceId' => 36580,'day' => '2018-01-25']
        );
    },



    'Twig_Environment' => function (ContainerInterface $c) {

        $path = getcwd();
        $loader = new Twig_Loader_Filesystem($path.'/app/src/Reports/Sheets/Tracks/Reports/Documents');
        $template = new Twig_Environment($loader, array(
            'cache' => $path.'/app/Cache',
            'debug' => true,
        ));
        $template->addExtension(new Twig_Extension_Debug());
        
        return $template;
    }
];