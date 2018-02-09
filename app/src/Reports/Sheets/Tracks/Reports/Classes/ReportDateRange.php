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

     $values = $device->getTracks();
    // var_dump($values);
   // ($this->parameters[REPORT_DATERANGE_DF], $this->parameters[REPORT_DATERANGE_DT]);
           
     return $values; //$template->view($values);
   }

}