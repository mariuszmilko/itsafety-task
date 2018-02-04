<?php

namespace App\Reports\Library\Classes\Config;

use App\Reports\Library\Classes\Config\AbstractConfig;


class Config extends AbstarctConfig
{
    protected $oMap;
    protected $filterDictionary;
    protected $aggDictionary;
    protected $filters;
    protected $aggreagtes;

    public function __construct($oMap, $filterDictionary, $aggDictionary)
    {
        $this->oMap = $oMap;
        $this->filterDictionary = $filterDictionary;
        $this->aggDictionary = $aggDictionary;
        $this->filters = $this->oMap->filters;
        $this->aggreagtes = $this->oMap->aggregates;
    }

//THIS
    public function generate($point, $parameters)
    {
        $this->filtering($point, $parameters);
        return true;
    }

    public function filtering($point, $parameters)
    {
        foreach ($this->filters as $fMap){
             $filter = $this->filterDictionary->get($fMap->class);
      
             if (isset($point[$fMap->rowname]) && 
                 isset($filter) && 
                 $filter->filter(['value' => $point[$fMap->rowname]])) {
 
               foreach ($this->aggregates  as $gMap) {  
                    if ($gMap->type == $fMap->type) {
                        $type = $fMap->type;
                    } else {
                      continue;
                    }

                    if (isset($parameters[$type][$gMap->class])) {
                        $agg = $parameters[$type][$gMap->class];
                    } else {
                        $agg = $this->aggDictionary->get($gMap->class);  
                        $parameters[$type][$gMap->class] = $agg;
                    }
         
                    $agg->calculate(['value' => $point[$gMap->rowname], 'index' => 1]); // $point->value 
                }
             }
         }

        return null;
    }
     //in DI
    // private function extractFromMap($fileName) 
    // {
    //       $map = include $fileName;
    // }
//OR //First Version
    // public function generate($generator, $parameters) //or $genertor
    // {
    //     $filters = $this->map['filters']; //const  env
    //     $aggreagtes = $this->map['aggregates'];  //const env
    //    // $parameters[$aggreagtes['name'][$row[RECORD]]] =  $aggreagtes['name'][$row[RECORD]]; //inject form container
    
    //    //callable def ??
    //     $configFilters = function($value) use ($filters) {
    //         foreach ($filters as $filter) {
    //             $response = $response && $filter->filter($value);
    //     }    
    //         return $response;
    //     };
        
    //     // Iterate over the trackpoint set from the gpx file, displaying each point detail in turn
    //     foreach ($this->filter($generator, $configFilters, ARRAY_FILTER_USE_VALUE) as $row) {
    //         $parameters[$aggreagtes['name'][$row[RECORD]]] =  $aggreagtes['name'][$row[RECORD]]; 
    //     }
    // }
}





 
