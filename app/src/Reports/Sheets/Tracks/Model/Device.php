<?php

namespace App\Reports\Sheets\Tracks\Model;


class Device
{
   protected  $deviceId;
   protected  $track;

   public function __construct($deviceId, Track $track)
   {
       $this->deviceId = $deviceId;
       $this->track = $track;
   }
    
   public  function getDataByDate($dateFrom, $dateTo)
   {
       return $this->track->getDataByDate($this->device_id, $dateFrom, $dateTo);
   }

   public function getDataByDay($dateDay)
   {
       return $this->track->getDataByDay($this->device_id, $dateDay);
   }


}