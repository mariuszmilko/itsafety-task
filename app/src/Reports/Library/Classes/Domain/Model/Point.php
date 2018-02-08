<?php

namespace App\Reports\Library\Classes\Domain\Model;

use stdClass;
use App\Reports\Library\Classes\Factory\{FilterDictionary, AggregateDictionary};
use App\Reports\Library\Parameters\Generic\{IParameterAgg, IParameterFilter};
use App\Reports\Library\Classes\Domain\Model\Generic\Point\{IPointChain};

/**
*  Elementary part of track
*/
class Point implements IPointChain
{ 

    /** @var string|null Should contain a description if available */
    protected $oMap;

    /** @var FilterDictionary Should contain a description if available */
    protected $filterDictionary;

    /** @var AggregateDictionary Should contain a description if available */
    protected $aggDictionary;

    /** @var array Should contain a description if available */
    protected $filters;

    /** @var array Should contain a description if available */
    protected $aggregates;

    /** @var array Should contain a description if available */
    protected $data;
    
    /**
     * This method sets a description.
    *
    * @param array $description A text with a maximum of 80 characters.
    * @param stdClass $description A text with a maximum of 80 characters.
    * @param FilterDictionary  $description A text with a maximum of 80 characters.
    * @param AggregateDictionary $description A text with a maximum of 80 characters.
    *
    * @constructor
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
    * @throws Exception
    * @return string
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
    * @param array $description A text with a maximum of 80 characters.
    *
    * @return Point
    */
    public function filtering(array &$parameters) //$context  ->get callable
    {    //to Ireator
        foreach ($this->filters as $fMap){
            $filter = $this->filterDictionary->get($fMap->class);
            if ($this->isToFiltering($filter, $fMap->rowname)) {  //zamist warunk dołoyć filtr do foreach callable
                foreach ($this->aggregates  as $gMap) {  //chain of renspobility i chain 
                    if ($this->isCorrectAggTypeInFilter($gMap, $fMap) ) {
                        $type = $fMap->type;
                    } else {
                        continue;
                    }
                    //$process
                    $this->aggPrametersValues($parameters, $type, $gMap->rowname, $gMap->class);
                }
            }
        }

       return $this;
    }
    /**
     * This method sets a description.
    *
    * @param IParameterFilter $description A text with a maximum of 80 characters.
    * @param string $description A text with a maximum of 80 characters.
    *
    * @return bool
    */
    private function isToFiltering(IParameterFilter $filter, string $rowname)
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
    private function isCorrectAggTypeInFilter(stdClass $gMap, stdClass $fMap) 
    {
       return $gMap->type == $fMap->type;
    } 
    /**
     * This method sets a description.
    *
    * @param array $description A text with a maximum of 80 characters.
    * @param string
    * @param string
    * @param string
    *
    * @return void
    */
    public function aggPrametersValues(array &$parameters, string $type, string $rowname, string $clazz)
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
    * @param array $description A text with a maximum of 80 characters.
    * @param string
    * @param string
    * @param string
    *
    * @return void
    */               
    public function chainParametersOnEnd(array &$parameters) //process
    {
        // if (isset($parameters[$type][$clazz])) {
        //     $agg = $parameters[$type][$clazz];
        // } else {
        //     $agg = $this->aggDictionary->get($clazz);  
        //     $parameters[$type][$clazz] = $agg;
        // }
        foreach ($this->aggregates as $agg)
        {
            if ($agg->type && $agg->lastaware) {
                $p = &$parameters['end'][$agg->class];
               // $p->setSuccesor($this->aggregates[$agg['chain']])  //recursive for parent->children
               // $p->handle(['value' => $this->data[$rowname], 'index' => 1]);   
                $p->calculate(['value' => $this->data['end_date']]); //const in map
                return true;
            }
        }
        return false;
    
    }
    /**
     * This method sets a description.
    *
    * @param array $description A text with a maximum of 80 characters.
    * @param string
    * @param string
    * @param string
    *
    * @return void
    */               
    public function chainParametersOnProcess(array &$parameters, $type, $rowname, $class) //process
    {
        // if (isset($parameters[$type][$clazz])) {
        //     $agg = $parameters[$type][$clazz];
        // } else {
        //     $agg = $this->aggDictionary->get($clazz);  
        //     $parameters[$type][$clazz] = $agg;
        // }
        foreach ($this->aggregates as $agg)
        {
            if ($agg->type && $agg->lastaware) {
                $p = &$parameters['end'][$agg->class];
               // $p->setSuccesor($this->aggregates[$agg['chain']])  //recursive for parent->children
               // $p->handle(['value' => $this->data[$rowname], 'index' => 1]);   
                $p->calculate(['value' => $this->data['end_date']]); //const in map
                return true;
            }
        }
        return false;
    
    }


    /**
     * This method sets a description.
    *
    * @param array $description A text with a maximum of 80 characters.
    *
    * @return bool
    */
    public function getDateAggData(array &$parameters) //TO TrackGenerator ?? unikniecie polaczenie z track ?
    {
        foreach ($this->aggregates as $agg)
        {
            if ($agg->type && $agg->lastaware) {
                $p = &$parameters['end'][$agg->class];
                $p->calculate(['value' => $this->data['end_date']]); //const in map
                return true;
            }
        }
        return false;
    }
}