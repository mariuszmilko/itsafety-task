<?php

namespace App\Reports\Sheets\Tracks;



class ReportDay  implements IReport
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