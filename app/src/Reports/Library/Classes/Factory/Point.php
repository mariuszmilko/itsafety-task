<?php

namespace App\Reports\Library\Classes\Factory;

use App\Reports\Library\Classes\Domain\Model\Point as PointModel;
use App\Reports\Library\Classes\Factory\Generic\IDictionary;
use stdClass;




final class Point 
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




   public function factory($data)
   {
        return new PointModel($data, $this->oMap, $this->filterDictionary, $this->aggDictionary);
   }
}