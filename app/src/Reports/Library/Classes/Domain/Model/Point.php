<?php

namespace App\Reports\Library\Classes\Domain\Model;

use stdClass;
use App\Reports\Library\Classes\Factory\{FilterDictionary, AggregateDictionary};
use App\Reports\Library\Parameters\Generic\{IParameterAgg, IParameterFilter};
use App\Reports\Library\Classes\Domain\Model\Generic\Point\{IPointChainOnProcess, IPointChainOnUpdate};

/**
*  Elementary part of track
*/
class Point implements IPointChainOnProcess, IPointChainOnUpdate
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
    {
        $filters = get_object_vars($this->filters); 
        $data = $this->data; 
        $filterDictionary = $this->filterDictionary;
        foreach (
            array_filter($filters, 
                function($v, $k) use ($filterDictionary, $data) { 
                    $filter = $filterDictionary->get($v->class);

                    return (isset($this->data[$v->rowname]) && 
                        isset($filter) && 
                        $filter->filter(['value' => $this->data[$v->rowname]]) &&
                        isset($v->delimiter));
                },
                ARRAY_FILTER_USE_BOTH) as $key => $fMap
        ) {
            return $fMap->delimiter; 
        }

        throw new \Exception('Brak delimitera w mapie');
    }
    /**
     * Array_Map instead foreach example
    *
    * @param array $description A text with a maximum of 80 characters.
    *
    * @return Point
    */
    public function filtering(array &$parameters) //$context  ->get callable
    {  
        $filters = get_object_vars($this->filters);
        $filterDictionary = $this->filterDictionary;
        $aggregates = get_object_vars($this->aggregates);
        $data = $this->data;

        array_map(function($fMap) use ($aggregates, &$parameters) {
            array_map(function($gMap) use ($aggregates, &$parameters, $fMap) {           
                $this->aggPrametersValues($parameters, $gMap->type, $gMap->rowname, $gMap->class);
            }, array_filter($aggregates,
                    function($v, $k) use ($fMap) {

                       return  $v->type == $fMap->type;
                    }, ARRAY_FILTER_USE_BOTH));
        }, array_filter($filters, 
                function($v, $k) use ($parameters,  $filterDictionary, $data) { 
                    $filter = $filterDictionary->get($v->class);

                    return (isset($filter) && $filter->filter(['value' => $data[$v->rowname]])); 
        }, ARRAY_FILTER_USE_BOTH));

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
    public function chainParametersOnUpdate(array &$parameters) //process
    {
        $aggregates = get_object_vars($this->aggregates);
        foreach (
            array_filter($aggregates, 
                function($v, $k) use ($parameters, $aggregates) { 

                    return !empty($v->chainonupdate) && 
                        isset($parameters[$aggregates[$v->chainonupdate]->type]);
                },
            ARRAY_FILTER_USE_BOTH) as $key => $agg
        ) {
          $this->chainParametersOnUpdateCalc($agg, $parameters, $aggregates);
        }
        return true;
    }

    private function chainParametersOnUpdateCalc($agg, &$parameters, $aggregates)
    {
        print_r($agg);
        $pNext = $parameters[$aggregates[$agg->chainonupdate]->type];
        print_r($parameters);
        $p = $parameters[$agg->type][$agg->class];

        $p->setSuccesor($pNext);
        $p->handle([]);
        $p->calculate();
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
        // foreach ($this->aggregates as $agg)
        // {
        //     if ($agg->type && !empty($agg->chainonprocess)) {
        //         $p = &$parameters['end'][$agg->class];
        //         $p->setSuccesor($this->aggregates[$agg['chainonprocess']]);  //recursive for parent->children
        //         $p->handle(['value' => $this->data[$rowname], 'index' => 1]);   
        //         $p->calculate(['value' => $this->data['end_date']]); //const in map
        //         return true;
        //     }
        // }
        // return false;

        // $aggregates = get_object_vars($this->aggregates);
        foreach (
            array_filter($parameters, 
                 function($v, $k) use ($type, $rowname, $class) { 
    
        
                    return false;
                },
            ARRAY_FILTER_USE_BOTH) as $key => $agg
        ) {
            $pNextData = $this->data[$aggregates[$agg->chainonupdate]->rowname];
            $pNext = $this->aggDictionary[$aggregates[$agg->chainonupdate]->class];
        //$p = &print_r($parameters[$agg->type][$agg->class]);
        }
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
        $aggregates = get_object_vars($this->aggregates);
        foreach (
            array_filter($aggregates, function($v, $k) {
                    return $v->type && $v->lastaware;
            }, ARRAY_FILTER_USE_BOTH)  as $key => $agg
        ) {
            $p = &$parameters['end'][$agg->class];
            $p->calculate(['value' => $this->data['end_date']]); //const in map
            return true;
        }
        return false;
    }
}