<?php

namespace App\Reports\Library\Classes\Factory;

use App\Reports\Sheets\Tracks\Model\Track;




class TrackBuilder
{



    public function newInstance()
    {
        return new Track();
    }
}