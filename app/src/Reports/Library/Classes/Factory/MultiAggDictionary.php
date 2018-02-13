<?php

namespace App\Reports\Library\Classes\Factory;

use App\Reports\Library\Classes\Factory\Generic\IDictionary;

use stdClass;


class MultiAggDictionary implements IDictionary
{


   protected $multiAggDictionary = [];  




  public function __construct(stdClass $filters)
  {
     $this->fillDictionary($filters);
  }




  public function fillDictionary(stdClass $data)
  {
    foreach ($data  as $key => $agg) {
        if (isset($agg->summary))
        {
          $this->multiAggDictionary[$agg->name] = new $agg->summary;
        }  
     }
  }




  public function get(string $key)
  {
      return isset($this->multiAggDictionary[$key]) ? $this->multiAggDictionary[$key] : null;
  }

}