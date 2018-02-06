<?php

namespace App\Reports\Library\Classes\Factory;

use App\Reports\Library\Classes\Domain\Model\Track;




class TrackBuilder
{



    public function newInstance()
    {
        return new Track();
    }
}