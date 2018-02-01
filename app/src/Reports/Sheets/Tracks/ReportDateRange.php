<?php

namespace App\Reports\Sheets\Tracks;



class ReportDay  implements IReport
{
   protected $device;
   protected $template;
   protected $parameters = [];

   public function __construct(Device $device, $template, $parameters = [])
   {
      $this->device = $device;
      $this->parameters = $parameters;
   }

   public function generate()
   {
     $values = $this->device->getDataByDate($this->parameters[REPORT_DATERANGE_DF], $this->parameters[REPORT_DATERANGE_DT]]);
           
     return $template->view($values);
   }

}