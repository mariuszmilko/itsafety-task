<?php

namespace App\Reports\Library\Classes\Helpers\Mappers;

use App\Reports\Library\Classes\Helpers\Generic\Mappers\IMapper;


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

    public function __construct(IPoint $data, stdClass $oMap, FilterDictionary $filterDictionary, AggregateDictionary $aggDictionary)
    {
        $this->oMap = $oMap;
        $this->filterDictionary = $filterDictionary;
        $this->aggDictionary = $aggDictionary;
        $this->filters = $this->oMap->filters;
        $this->aggregates = $this->oMap->aggregates;
        $this->data = $data->getData();
        $this->delimiter = $delimiter;
    }


    public function delimiter()
    {
        list($filters, $filterDictionary, $data) = $this->listDataToFilter();
        //array_map
        foreach (
            array_filter($filters, 
                function($v, $k) use ($filterDictionary, $data) { 
                    $filter = $filterDictionary->get($v->type);

                    return $this->isDelimiter($filter, $v->rowname, $v->delimiter);
                },
                ARRAY_FILTER_USE_BOTH) as $key => $fMap
        ) {
            return $this;
        }

        throw new \Exception('Brak delimitera w mapie');
    }



    public function isDelimiter($filter, $rowname, $delimiter)
    {
        return (isset($this->data[$rowname]) && 
                        isset($filter) && 
                        $filter->filter(['value' => $this->data[$rowname]]) &&
                        isset($delimiter));

    }



    public function isCorrectTrackType($aggType, $filters)
    {
        return isset($filters[$aggType]);
    }



    public function isCorrectFilter($filter, $rowname)
    {
        return (isset($filter) && $filter->filter(['value' => $data[$v->rowname]])); 
    }



    public function  listDataToFilter()
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
        list($filters, $filterDictionary, $data, $aggregates, $parameters) = $this->listDataToFilter();

        $f = $this->extractFilters();
        $p = $this->extractAggregates($f);


        $this->parameters = $p;

        return $this;
    }



    public function extractFilters()
    {  
        $filtersToAgg = [];
        array_map(function($fMap) use ($aggregates) {
            
            $filtersToAgg[$fMap->class] = $fmap;

        }, array_filter($filters, 
                function($v, $k) use ($parameters,  $filterDictionary, $data) { 
                    $filter = $filterDictionary->get($v->class);

                    return $this->isCorrectFilter($filter, $data[$v->rowname]);
        }, ARRAY_FILTER_USE_BOTH));

        return $filtersToAgg;
  
    }



    public function extractAggregates($filters)
    {
        $parameters = [];
        array_map(function($gMap) use ($aggregates, $filters) { 
                              

                $agg = $this->aggDictionary->get($clazz);  
                $parameters[$type][$clazz] = $agg;


        }, array_filter($aggregates,
                function($v, $k) use ($filters) {

                  return  $this->isCorrectTrackType($v->type, $v->class, $filters);
                }, ARRAY_FILTER_USE_BOTH));

        return $parameters;
    }



    public function inject()
    {
       $point->injectDelimiter($this->delimiter);

       return $this;
    }

    public function getParameters()
    {
        return $this->parameters;
    }
}




//     public function __construct($map, $aggIterator, $filterIterator)
//     {

//     }
//      /**
//      * Returns an iterator over the elements in the buffer.
//      *
//      * The order is the order of insertion (FIFO)
//      *
//      * @return MapperIterator Iterator over the buffer elements
//      */
//     public function getIterator()
//     {
//         return new \ArrayIterator(
//             $this->map,
//             $this->getLeastRecentPosition(),
//             $this->size
//         );
//     }
// }