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