<?php

namespace App\Reports\Sheets\Tracks;

use App\Reports\Sheets\Tracks\Service\DeviceTrackService;

class ReportDay implements IReport
{
   protected $device;
   protected $template;

   public function __contruct(Device $device, $template)
   {
      $this->device = $device;
   }

   public function generate()
   {

    $this->device->getDataByDay($dateDay);
       
   }

}
