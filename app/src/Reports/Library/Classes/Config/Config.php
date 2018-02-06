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
}





 
