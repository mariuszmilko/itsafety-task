<?php

namespace App\Reports;


/**
 * Class Application
 * @package App\Reports
 */
class Application
{
    /**
     * @var \DI\Container
     */
    private $container;


    /**
     * Application constructor.
     */
    public function __construct()
    {
        $path    = getcwd();
        $builder = new \DI\ContainerBuilder();
        $builder->useAutowiring(false);
        $builder->useAnnotations(false);
        //$builder->enableCompilation($path . '/app/Cache');
        $builder->addDefinitions($path . '/app/config.php');
        $this->container = $builder->build();
    }


    /**
     *
     */
    public function main()
    {
        $loop = \React\EventLoop\Factory::create();

        // $resolverDateRange = function (callable $resolve, callable $reject) {
        //     //  $report = $this->container->get('ReportDateRange');
        //     //  $resolve($report->generate());
        // };       
        // $resolverDay = function (callable $resolve, callable $reject) {
        //     // $report = $this->container->get('ReportDay');
        //     // $resolve($report->generate());
        // };

        // $cancellerDateRange = function (callable $resolve, callable $reject) {
        //     $reject(new \Exception('Brak raportu'));
        // };      
        $canceller = function(callable $resolve, callable $reject) {
            $reject(new \Exception('Brak raportu'));
        };

        $def = new \React\Promise\Deferred($canceller);
        $def->resolve('OK');

        $resolverDay = function() use ($canceller) {
            $def    = new \React\Promise\Deferred($canceller);
            $report = $this->container->get('ReportDay');
            $def->resolve($report->generate());

            return $def;
        };

        $resolverDateRange = function() use ($canceller) {
            $def    = new \React\Promise\Deferred($canceller);
            $report = $this->container->get('ReportDateRange');
            $def->resolve($report->generate());

            return $def;
        };

        $pending = [$resolverDateRange()->promise(),
                    $resolverDay()->promise(),
                    //new \React\Promise\Promise($resolverDateRange, $cancellerDateRange),
                    //new \React\Promise\Promise($r)
        ];

        // $loop->addPeriodicTimer(0.001, function() use(&$pending) {
        $promise = \React\Promise\all($pending)->done(function($resolved) {
            print_r($resolved);
            echo "not real: " . (memory_get_peak_usage(false) / 1024 / 1024) . " MiB\n";
            echo "real: " . (memory_get_peak_usage(true) / 1024 / 1024) . " MiB\n\n";
        });
        //  });


        $promise = $def->promise();
        $promise->done(function($data) {
            echo 'Done: ' . $data . PHP_EOL;
        });


        $loop->run();
    }
}