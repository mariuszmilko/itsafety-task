<?php

namespace App\Reports;



class Application
{


   private $container;




   public function __construct()
   {
        $path = getcwd();   
        $builder = new \DI\ContainerBuilder();
        $builder->useAutowiring(false);
        $builder->useAnnotations(false);
        //$builder->enableCompilation($path . '/app/Cache');
        $builder->addDefinitions($path.'/app/config.php');
        $this->container = $builder->build();
   } 




   public function main()
   {  
        $loop = \React\EventLoop\Factory::create();

        $resolverDateRange = function (callable $resolve, callable $reject) {
             $report = $this->container->get('ReportDateRange');
             $resolve($report->generate());
        };       
        $resolverDay = function (callable $resolve, callable $reject) {
            $report = $this->container->get('ReportDay');
            $resolve($report->generate());
        };
        
        $cancellerDateRange = function (callable $resolve, callable $reject) {
            $reject(new \Exception('Brak raportu'));
        };      
        $cancellerDay = function (callable $resolve, callable $reject) {
            $reject(new \Exception('Brak raportu'));
        };
        
        $pending = [
            new \React\Promise\Promise($resolverDateRange, $cancellerDateRange),
            new \React\Promise\Promise($resolverDay, $cancellerDay)
        ];       
        $promise = \React\Promise\all($pending)->done(function($resolved){
            print_r($resolved); 
            echo "not real: ".(memory_get_peak_usage(false)/1024/1024)." MiB\n";
            echo "real: ".(memory_get_peak_usage(true)/1024/1024)." MiB\n\n";
        });
        
        $loop->run();
   }
}