<?php

namespace App\Reports\Library\Classes\Factory;


class AggregateDictionary
{


   protected $aggregatesDictionary = [];  




  public function __construct($aggs)
  {
     $this->fillDictionary($aggs);
  }




  private function fillDictionary($aggs)
  {
       foreach ($aggs  as $key => $agg) {
           $this->aggregatesDictionary[$agg->class] = $agg->class;
       }
  }



  
  public function get($key)
  {
      return new $this->aggregatesDictionary[$key];
  }

}