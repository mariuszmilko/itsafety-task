<?php

namespace App\Reports\Library\Classes\Factory;

use App\Reports\Library\Classes\Domain\Model\Point as PointModel;
use App\Reports\Library\Classes\Factory\Generic\IDictionary;
use stdClass;




final class Point 
{



   public function factory($data, $factoryMapper)
   {
       $delimiter = '';
        $factoryMapper->factory($data)
            ->delimiter(function($d) use (&$delimiter){
              $delimiter = $d;
        });
     
        return new PointModel($data, $delimiter);
   }
}