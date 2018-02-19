<?php

namespace App\Reports\Library\Classes\Factory;

use App\Reports\Library\Classes\Factory\Generic\IDictionary;
use stdClass;


class AggregateDictionary implements IDictionary
{


   protected $aggregatesDictionary = [];  




  public function __construct(stdClass $aggs)
  {
     $this->fillDictionary($aggs);
  }




  public function fillDictionary(stdClass $data)
  {
     foreach ($data  as $key => $agg) {
           $this->aggregatesDictionary[$agg->class] = $agg->class;
     }
  }




  public function get(string $key)
  {

      return new $this->aggregatesDictionary[$key];
  }

}