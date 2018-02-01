<?php

namespace App\Reports\Library\Classes\Repository\Track;

use App\Reports\Library\Classes\Repository\IRepository;

interface ITrackRepository extends IRepository
{
    public function findTracksByDate($dateFrom, $dateTo);
    public function findTracksByDay($date);
}