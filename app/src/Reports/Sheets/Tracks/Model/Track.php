<?php

namespace App\Reports\Sheets\Tracks\Model;


class Track 
{
   protected $parameters = [];
   protected $config;
   protected $repository;

   public function __construct(ITrackRepository $repository, $config)
   {
       $this->repository = $repository;
       $this->config = $config;
   }
   
   public function getParameter($name) 
   {
        if (!isset($this->parameters[$name])) 
            throw new Exception('Błędna nazwa parametru');
        
        return $this->parameters[$name];
   }

   public function getDataByDate($device_id, $dateFrom, $dateTo)
   {
        $generator = $repository->findTracksByDate($device_id, $dateFrom, $dateTo);  
        foreach ($generator as $row ) {
             $config->generate($row, $this->parameters);
        }

       return $this->parameters;
   }

   public function getDataByDay($dateDay)
   {
        $generator = $repository->findTracksByDay($device_id, $dateDay);  
        foreach ($generator as $row ) {
             $config->generate($row, $this->parameters);
        }
        
       return $this->parameters;
   }

//    private function map(callable $cb, $collection) {
//     foreach ($collection as $key => $item) {
//         yield $item => $cb($item);
//     }

   }

}
