<?php

namespace App\Reports\Sheets\Tracks\Reports\Classes;

use App\Reports\Library\Classes\Domain\Service\DeviceTrackService;
use App\Reports\Library\Classes\Service\IService;
use App\Reports\Library\Classes\Report\IReport;




class ReportDay  implements IReport
{


   protected $service;


   protected $template;


   protected $parameters = [];




   public function __construct(IService $service, \Twig_Environment $template,  array $parameters = [])
   {
      $this->service = $service;
      $this->parameters = $parameters;
      $this->template = $template;
   }




   public function generate()
   {
      $device = $this->service->getDataByDay(
       $this->parameters['deviceId'], 
       $this->parameters['day']
      );

      $deviceId = $this->parameters['deviceId'];
      $day = $this->parameters['day'];
      $summary = $device->getSummary();

      return $this->template->render(
        'day.report', 
        array('deviceId' => $deviceId,
            'day' => $day,
            'device' => $device,
            'summary' => $summary)
      );    
   }
}