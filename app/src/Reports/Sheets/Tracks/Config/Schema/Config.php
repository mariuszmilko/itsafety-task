<?php

namespace App\Reposrts\Sheets\Tracks\Config\Schema;


class Config implements ISchema
{
    protected $map;
    protected $filterDictionary;
    protected $aggDictionary;

    public function __construct($map, $filterDictionary, $aggDictionary)
    {
        $this->map = $map;
        $this->filterDictionary = $filterDictionary;
        $this->aggDictionary = $aggDictionary;
    }

//THIS
    public function generate($row, $parameters) //or $genertor
    {
        $map = $this->map['parameters'];
        $parameters[$map['name'][$row[RECORD]]] =  $map['name'][$row[RECORD]]; //inject form container
    }
//OR //First Version
    public function generate($generator, $parameters) //or $genertor
    {
        $filters = $this->map['filters']; //const  env
        $aggreagtes = $this->map['aggregates'];  //const env
       // $parameters[$aggreagtes['name'][$row[RECORD]]] =  $aggreagtes['name'][$row[RECORD]]; //inject form container
    
       //callable def ??
        $configFilters = function($value) use ($filters) {
            foreach ($filters as $filter) {
                $response = $response && $filter->filter($value);
        }    
            return $response;
        };
        
        // Iterate over the trackpoint set from the gpx file, displaying each point detail in turn
        foreach ($this->filter($generator, $configFilters, ARRAY_FILTER_USE_VALUE) as $row) {
            $parameters[$aggreagtes['name'][$row[RECORD]]] =  $aggreagtes['name'][$row[RECORD]]; 
        }
    }
}





 
