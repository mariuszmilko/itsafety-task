<?php

namespace App\Reports\Library\Classes\Factory;


class FilterDictionary
{

   protected $filtersDictionary = [];  




  public function __construct($filters)
  {
     $this->fillDictionary($filters);
  }




  private function fillDictionary($filters)
  {
       foreach ($filters  as $key => $filter) {
           $this->filtersDictionary[$filter->class] =  new $filter->class;
       }
  }



  
  public function get($key)
  {
      return $this->filtersDictionary[$key];
  }

}