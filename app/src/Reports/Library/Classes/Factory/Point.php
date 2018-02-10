<?php

namespace App\Reports\Library\Classes\Factory;

use App\Reports\Library\Classes\Domain\Model\Point as PointModel;
use App\Reports\Library\Classes\Factory\Generic\{IDictionary, IFactoryData};
use App\Reports\Library\Classes\Factory\{Mapper as FactoryMapper};
use stdClass;




final class Point implements IFactoryData
{

   private $factoryMapper;

   public function __construct(FactoryMapper $fm)
   {
        $this->factoryMapper = $fm;
   }


   public function factory($data)
   {
       $delimiter = '';
       $this->factoryMapper->factory($data)
            ->delimiter(function($d) use (&$delimiter){
              $delimiter = $d;
        });
     
        return new PointModel($data, $delimiter);
   }
}