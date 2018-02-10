<?php

namespace App\Reports\Library\Classes\Factory;

use stdClass;
use App\Reports\Library\Classes\Helpers\Mappers\Mapper as MapperHelper;
use App\Reports\Library\Classes\Factory\Generic\IDictionary;




final class Mapper
{
   private $oMap;
   private $filterDictionary;
   private $aggDictionary;

   public function __construct(stdClass $oMap, IDictionary $filterDictionary, IDictionary $aggDictionary)
   {
      $this->oMap = $oMap;
      $this->filterDictionary = $filterDictionary;
      $this->aggDictionary = $aggDictionary;
   }

    public function factory($data)  //$mapperfactory(data) 
    {
        return new MapperHelper($data, $this->oMap, $this->filterDictionary, $this->aggDictionary);
    }
}