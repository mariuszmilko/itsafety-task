<?php

namespace App\Reports\Sheets\Tracks\Reports\Classes;

use App\Reports\Sheets\Tracks\Service\DeviceTrackService;
use App\Reports\Library\Classes\Service\IService;
use App\Reports\Library\Classes\Report\IReport;




class ReportDateRange  implements IReport
{


   protected $service;


   protected $template;


   protected $map;


   protected $parameters = [];




   public function __construct(IService $service, $template, $map, $parameters = [])
   {
      $this->service = $service;
      $this->parameters = $parameters;
      $this->template = $template;
      $this->map = $map;
   }




   public function generate()
   {
      $device = $this->service->getDataByDate(
        $this->parameters['deviceId'], 
        $this->parameters['dateFrom'], 
        $this->parameters['dateTo'], 
        $this->map
      );

      $deviceId = $this->parameters['deviceId'];
      $dateFrom = $this->parameters['dateFrom'];
      $dateTo = $this->parameters['dateTo'];


      return $this->template->render(
        'daterange.report', 
        array('deviceId' => $deviceId,  
             'dateFrom' => $dateFrom,
             'dateTo' =>  $dateTo,
             'device' => $device)
      );      
   }
}