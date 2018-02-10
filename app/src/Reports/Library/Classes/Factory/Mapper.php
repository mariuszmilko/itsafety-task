<?php

namespace App\Reports\Library\Classes\Factory;

use stdClass;
use App\Reports\Library\Classes\Helpers\Mappers\Mapper as MapperModel;
use App\Reports\Library\Classes\Factory\{FilterDictionary, AggregateDictionary};



final class Mapper
{

   public function __construct(stdClass $oMap, IDictionary $filterDictionary, IDictionary $aggDictionary)
   {

   }

    public function factory($point)  //$mapperfactory(data) 
    {
        return new MapperHelper($point, $oMap, $filterDictionary, $aggDictionary);
    }
}