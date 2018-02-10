<?php

namespace App\Reports\Library\Classes\Factory;

use App\Reports\Library\Classes\Domain\Model\Track as TrackModel;
use App\Reports\Library\Classes\Domain\Model\Generic\Point\IPoint;




final class Track
{



    public function factory(IPoint $point, $factoryMapper) 
    {
        $parameters = $factoryMapper->factory($point->getData())
            ->delimiter()
            ->extractParameters()
            ->getParameters();

        return new TrackModel($parameters);
    }
}