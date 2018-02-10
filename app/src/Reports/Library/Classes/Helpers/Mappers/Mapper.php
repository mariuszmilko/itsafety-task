<?php

namespace App\Reports\Library\Classes\Helpers\Mappers;

use stdClass;
use App\Reports\Library\Classes\Helpers\Generic\IMapper;
use App\Reports\Library\Classes\Domain\Model\Generic\Point\IPoint;
use App\Reports\Library\Classes\Factory\{FilterDictionary, AggregateDictionary};


class Mapper  implements IMapper
{
    protected $oMap;
    protected $filterDictionary;
    protected $aggDictionary;
    protected $filters;
    protected $aggregates;
    protected $data;
    protected $delimiter;
    protected $parameters = [];

    public function __construct(array $data, stdClass $oMap, FilterDictionary $filterDictionary, AggregateDictionary $aggDictionary)
    {
        $this->oMap = $oMap;
        $this->filterDictionary = $filterDictionary;
        $this->aggDictionary = $aggDictionary;
        $this->filters = $this->oMap->filters;
        $this->aggregates = $this->oMap->aggregates;
        $this->data = $data;
    }


    public function delimiter(callable $response = null)
    {
        list($filters, $filterDictionary, $data) = $this->listDataToFilter();

        foreach (
            array_filter($filters, 
                function($v, $k) use ($filterDictionary, $data) { 
                    $filter = $filterDictionary->get($v->class);

                    return $this->isValidDelimiter($filter, $v);
                },
                ARRAY_FILTER_USE_BOTH) as $key => $fMap
        ) {
            $this->delimiter = $fMap->delimiter;
            !is_callable($response) ?: $response($this->delimiter);

            return $this;
        }

        throw new \Exception('Brak delimitera w mapie');
    }



    public function isValidDelimiter($filter, $v)
    {
        return (isset($this->data[$v->rowname]) && 
                        isset($filter) && 
                        $filter->filter(['value' => $this->data[$v->rowname]]) &&
                        isset($v->delimiter));
    }



    public function isCorrectTrackType($aggType, $filters)
    {
       return isset($filters[$aggType]);
    }



    public function isCorrectFilter($filter, $rowname)
    {
        return (isset($filter) && $filter->filter(['value' => $this->data[$rowname]])); 
    }



    public function listDataToFilter()
    {
       $filters = get_object_vars($this->filters);
       $filterDictionary = $this->filterDictionary;
       $aggregates = get_object_vars($this->aggregates);
       $data = $this->data;
       $parameters = [];

       return [$filters, $filterDictionary, $data, $aggregates, $parameters];
    }



   public function extractParameters()
   {
        list($filters, $filterDictionary, $data, $aggregates, $parameters) 
            = $this->listDataToFilter();

        $f = $this->extractFilters();
        $p = $this->extractAggregates($f);

        $this->parameters = $p;

        return $this;
    }



    public function extractFilters()
    {  
        $filters = get_object_vars($this->filters);
        $filtersToAgg = [];
        foreach (
            array_filter($filters, 
                function($v, $k) { 
                    $filter = $this->filterDictionary->get($v->class);

                    return $this->isCorrectFilter($filter, $v->rowname);
                },
                ARRAY_FILTER_USE_BOTH) as $key => $fMap
        ) {
            $filtersToAgg[$fMap->type] = $fMap;
        }

        return $filtersToAgg;  
    }



    public function extractAggregates($filters)
    {
        $parameters = [];
        $aggregates = get_object_vars($this->aggregates);

        foreach (
            array_filter($aggregates,
                function($v, $k) use ($filters) {

                  return  $this->isCorrectTrackType($v->type, $filters);
                }, ARRAY_FILTER_USE_BOTH) as $key => $gMap
        ) {
            $agg = $this->aggDictionary->get($gMap->class);   
            $agg->setRowname($gMap->rowname);

            $parameters[$gMap->type][] = $agg;
        }
                        
        return $parameters;
    }



    public function getParameters()
    {
        return $this->parameters;
    }
}