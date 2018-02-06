<?php

namespace App\Reports\Library\Classes\Factory;

use App\Reports\Library\Classes\Domain\Model\Track as TrackModel;




final class Track
{



    public function factory()
    {
        return new TrackModel();
    }
}