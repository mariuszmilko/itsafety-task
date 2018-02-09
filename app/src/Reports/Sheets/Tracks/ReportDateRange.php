<?php

namespace App\Reports\Sheets\Tracks;

use App\Reports\Sheets\Tracks\Service\DeviceTrackService;

class ReportDateRange  implements IReport
{
   protected $service;
   protected $template;
   protected $parameters = [];

   public function __construct($service, $template, $parameters = [])
   {
      $this->device = $device;
      $this->parameters = $parameters;
   }

   public function generate()
   {
     $values = $this->service->getDataByDate($this->parameters[REPORT_DATERANGE_DF], $this->parameters[REPORT_DATERANGE_DT]);
           
     return $template->view($values);
   }

}