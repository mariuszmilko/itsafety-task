<?php

namespace App\Reports\Library\Classes\Helpers\Reports;


use App\Reports\Library\Classes\Report\IReport;




class Cache  implements IReport
{


   protected $report;


   protected $result;


   protected $debug;


   

   public function __construct(IReport $report, $debug = false)
   {
      $this->report = $report;
      $this->debug = $debug;
   }




   public function generate()
   {
      $this->result = $this->result ?:$this->report->generate();

      return $this->result;
   }
}