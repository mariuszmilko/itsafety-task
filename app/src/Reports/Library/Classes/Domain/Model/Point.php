<?php

namespace App\Reports\Library\Classes\Domain\Model;

use stdClass;
use App\Reports\Library\Classes\Factory\{FilterDictionary, AggregateDictionary};

class Point //interface IPoint if vrtual
{ 

    /** @var string|null Should contain a description if available */
    protected $oMap;

    /** @var string|null Should contain a description if available */
    protected $filterDictionary;

    /** @var string|null Should contain a description if available */
    protected $aggDictionary;

    /** @var string|null Should contain a description if available */
    protected $filters;

    /** @var string|null Should contain a description if available */
    protected $aggregates;

    /** @var string|null Should contain a description if available */
    protected $data;
    
    /**
     * This method sets a description.
    *
    * @param array $description A text with a maximum of 80 characters.
    * @param stdClass $description A text with a maximum of 80 characters.
    * @param  $description A text with a maximum of 80 characters.
    * @param string $description A text with a maximum of 80 characters.
    *
    * @return void
    */
    public function __construct(array $data, stdClass $oMap, FilterDictionary $filterDictionary, AggregateDictionary $aggDictionary)
    {
        $this->oMap = $oMap;
        $this->filterDictionary = $filterDictionary;
        $this->aggDictionary = $aggDictionary;
        $this->filters = $this->oMap->filters;
        $this->aggregates = $this->oMap->aggregates;
        $this->data = $data;
    }
    /**
     * This method sets a description.
    *
    * @param string $description A text with a maximum of 80 characters.
    *
    * @return void
    */
    public function delimiter()
    {   //to Ireator
       foreach ($this->filters as $fMap){ //iterator or calbale filter
            $filter = $this->filterDictionary->get($fMap->class);
     
            if (isset($this->data[$fMap->rowname]) && 
            isset($filter) && 
            $filter->filter(['value' => $this->data[$fMap->rowname]]) &&
            isset($fMap->delimiter)) {
                return $fMap->delimiter; //$this->data[$fMap->rowname];
            }
        }
        throw new \Exception('Brak delimitera w mapie');
    }
    /**
     * This method sets a description.
    *
    * @param string $description A text with a maximum of 80 characters.
    *
    * @return void
    */
    public function filtering(&$parameters) //$context  ->get callable
    {    //to Ireator
        foreach ($this->filters as $fMap){
            $filter = $this->filterDictionary->get($fMap->class);
            if ($this->isToFiltering($filter, $fMap->rowname)) {  //zamist warunk dołoyć filtr do foreach callable
                foreach ($this->aggregates  as $gMap) {  
                    if ($this->isCorrectAggTypeInFilter($gMap, $fMap) ) {
                        $type = $fMap->type;
                    } else {
                        continue;
                    }
                    $this->aggPrametersValues($parameters, $type, $gMap->rowname, $gMap->class);
                }
            }
        }

       return $this;
    }
    /**
     * This method sets a description.
    *
    * @param string $description A text with a maximum of 80 characters.
    *
    * @return void
    */
    private function isToFiltering($filter, $rowname)
    {
       return  (isset($filter) && $filter->filter(['value' => $this->data[$rowname]])); 
    }
    /**
     * This method sets a description.
    *
    * @param string $description A text with a maximum of 80 characters.
    *
    * @return void
    */
    private function isCorrectAggTypeInFilter($gMap, $fMap) 
    {
       return $gMap->type == $fMap->type;
    } 
    /**
     * This method sets a description.
    *
    * @param string $description A text with a maximum of 80 characters.
    *
    * @return void
    */
    private function aggPrametersValues(&$parameters, $type, $rowname, $clazz)
    {
        if (isset($parameters[$type][$clazz])) {
            $agg = $parameters[$type][$clazz];
        } else {
            $agg = $this->aggDictionary->get($clazz);  
            $parameters[$type][$clazz] = $agg;
        }

        $agg->calculate(['value' => $this->data[$rowname], 'index' => 1]);   
    }
    /**
     * This method sets a description.
    *
    * @param string $description A text with a maximum of 80 characters.
    *
    * @return void
    */
    public function getDateAggData(&$trackParameters) //TO TrackGenerator ?? unikniecie polaczenie z track ?
    {
        foreach ($this->aggregates as $agg)
        {
            if ($agg->type && $agg->lastaware) {
                $p = &$trackParameters['end'][$agg->class];
                $p->calculate(['value' => $this->data['end_date']]); //const in map
                return true;
            }
        }
        return false;
    }
}