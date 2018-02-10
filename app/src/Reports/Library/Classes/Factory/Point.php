<?php

namespace App\Reports\Library\Classes\Factory;

use App\Reports\Library\Classes\Domain\Model\Point as PointModel;
use App\Reports\Library\Classes\Factory\Generic\IDictionary;
use stdClass;




final class Point 
{



   public function factory($data)
   {
        return new PointModel($data);
   }
}