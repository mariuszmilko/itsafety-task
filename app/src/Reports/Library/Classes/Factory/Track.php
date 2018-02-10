<?php

namespace App\Reports\Library\Classes\Factory;

use App\Reports\Library\Classes\Domain\Model\Track as TrackModel;




final class Track
{



    public function factory($factoryMapper, $point) 
    {
        $parameters = $factoryMapper->factory($point)
            ->delimiter()
            ->extractParameters()
            ->inject()
            ->getParameters();


        return new TrackModel($parameters);
    }
}