<?php

namespace App\Reports\Library\Classes\Factory;

use App\Reports\Library\Classes\Factory\Generic\IDictionary;

use stdClass;


class FilterDictionary implements IDictionary
{


   protected $filtersDictionary = [];  




  public function __construct(stdClass $filters)
  {
     $this->fillDictionary($filters);
  }




  public function fillDictionary(stdClass $data)
  {
       foreach ($data  as $key => $filter) {
           $this->filtersDictionary[$filter->class] = $filter->class;
       }
  }




  public function get(string $key)
  {
      return new $this->filtersDictionary[$key];
  }

}