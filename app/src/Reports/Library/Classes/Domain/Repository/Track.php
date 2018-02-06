<?php

namespace App\Reports\Library\Classes\Domain\Repository;

use App\Reports\Library\Classes\Repository\Track\ITrackRepository;




class Track extends ITrackRepository
{




    public function __construct($db)
    {

    }
    




    public function findTracksByDate($dateFrom, $dateTo, $type) 
    {
            yield;
    }




    
    public function findTracksByDay($date, $type) 
    {
            yield;
    }
}

//select device_id, record_timestamp,record_device_state, record_can_speed  from record WHERE device_id =   40285; AND record_device_state = 3 