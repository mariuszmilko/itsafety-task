<?php

require_once __DIR__.'/vendor/autoload.php';



$builder = new DI\ContainerBuilder();
$container = $builder->build();
$containerBuilder->addDefinitions('config.php');



$loop = React\EventLoop\Factory::create();



$resolver = function (callable $resolve, callable $reject) use ($container) {
   $report = $container->get(ReportDateRange::class);
   $resolve($report->generate());
};

$canceller = function (callable $resolve, callable $reject) {
    $reject(new \Exception('Brak raportu'));
};


$promise = new React\Promise\Promise($resolver, $canceller);

$promise->then(function ($x) {
            // $x will be the value passed to $deferred->resolve() below
            // and returns a *new promise* for $x + 1
           // sleep(10);
            return $x;
        })
        ->done(function($data){
            echo 'Done: ' . $data . PHP_EOL;
        });





$loop->run();
