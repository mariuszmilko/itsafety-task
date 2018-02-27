<?php

namespace App\Reports\Library\Classes\Factory;


use App\Reports\Library\Classes\Domain\Model\{ParameterTrack as ParameterTrackModel};
use App\Reports\Library\Classes\Factory\Generic\{IFactoryData, IDictionary};




final class ParameterTrack implements IFactoryData
{




   public function __construct()
   {

   }



   
    public function factory(array $parameters)
    {
        return new ParameterTrackModel($parameters);
    }
}