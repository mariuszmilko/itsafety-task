<?php

namespace App\Reports\Library\Classes\Domain\Model;

use stdClass;
use App\Reports\Library\Classes\Domain\Model\Generic\Mapper\IMapper;
use App\Reports\Library\Classes\Domain\Model\Generic\Point\IPoint;
use App\Reports\Library\Classes\Factory\Generic\
{
    IDictionary
};


/**
 * Class Mapper
 * @package App\Reports\Library\Classes\Domain\Model
 */
class Mapper implements IMapper
{
    /**
     * @var stdClass
     */
    protected $oMap;
    /**
     * @var IDictionary
     */
    protected $filterDictionary;
    /**
     * @var IDictionary
     */
    protected $aggDictionary;
    /**
     * @var
     */
    protected $filters;
    /**
     * @var
     */
    protected $aggregates;
    /**
     * @var array
     */
    protected $data;
    /**
     * @var
     */
    protected $delimiter;
    /**
     * @var array
     */
    protected $parameters = [];


    /**
     * Mapper constructor.
     * @param array $data
     * @param stdClass $oMap
     * @param IDictionary $filterDictionary
     * @param IDictionary $aggDictionary
     */
    public function __construct(array $data, stdClass $oMap, IDictionary $filterDictionary, IDictionary $aggDictionary)
    {
        $this->oMap             = $oMap;
        $this->filterDictionary = $filterDictionary;
        $this->aggDictionary    = $aggDictionary;
        $this->filters          = $this->oMap->filters;
        $this->aggregates       = $this->oMap->aggregates;
        $this->data             = $data;
    }


    /**
     * @param callable|null $response
     * @return Mapper
     * @throws \Exception
     */
    public function delimiter(callable $response = null): Mapper
    {
        list($filters, $filterDictionary, $data) = $this->listDataToFilter();

        foreach(array_filter($filters, function($v, $k) use ($filterDictionary, $data) {
            $filter = $filterDictionary->get($v->class);

            return $this->isValidDelimiter($filter, $v);
        }, ARRAY_FILTER_USE_BOTH) as $key => $fMap)
        {
            $this->delimiter = $fMap->delimiter;
            !is_callable($response) ?: $response($this->delimiter);

            return $this;
        }

        throw new \Exception('Brak delimitera w mapie');
    }


    /**
     * @param $filter
     * @param $v
     * @return bool
     */
    public function isValidDelimiter($filter, $v): bool
    {
        return (isset($this->data[$v->rowname]) && isset($filter) && $filter->filter(['value' => $this->data[$v->rowname]]) && isset($v->delimiter));
    }


    /**
     * @param $aggType
     * @param $filters
     * @return bool
     */
    public function isCorrectTrackType($aggType, $filters): bool
    {
        return isset($filters[$aggType]);
    }


    /**
     * @param $filter
     * @param $rowname
     * @return bool
     */
    public function isCorrectFilter($filter, $rowname): bool
    {
        return (isset($filter) && $filter->filter(['value' => $this->data[$rowname]]));
    }


    /**
     * @return array
     */
    public function listDataToFilter(): array
    {
        $filters          = get_object_vars($this->filters);
        $filterDictionary = $this->filterDictionary;
        $aggregates       = get_object_vars($this->aggregates);
        $data             = $this->data;
        $parameters       = [];

        return [
            $filters,
            $filterDictionary,
            $data,
            $aggregates,
            $parameters
        ];
    }


    /**
     * @param callable|null $response
     * @return Mapper
     */
    public function extractParameters(callable $response = null): Mapper
    {
        list($filters, $filterDictionary, $data, $aggregates, $parameters)
            = $this->listDataToFilter();

        $f = $this->extractFilters();
        $p = $this->extractAggregates($f);

        $this->parameters = $p;
        !is_callable($response) ?: $response($p);

        return $this;
    }


    /**
     * @return array
     */
    public function extractFilters(): array
    {
        list($filters) = $this->listDataToFilter();
        $filtersToAgg = [];
        foreach(array_filter($filters, function($v, $k) {
            $filter = $this->filterDictionary->get($v->class);

            return $this->isCorrectFilter($filter, $v->rowname);
        }, ARRAY_FILTER_USE_BOTH) as $key => $fMap)
        {
            $filtersToAgg[$fMap->type] = $fMap;
        }

        return $filtersToAgg;
    }


    /**
     * @param $filters
     * @return array
     */
    public function extractAggregates($filters): array
    {
        $parameters = [];
        $aggregates = get_object_vars($this->aggregates);

        foreach(array_filter($aggregates, function($v, $k) use ($filters) {

            return $this->isCorrectTrackType($v->type, $filters);
        }, ARRAY_FILTER_USE_BOTH) as $key => $gMap)
        {
            $agg = $this->aggDictionary->get($gMap->class);
            $agg->setRowname($gMap->rowname);
            $agg->setName($gMap->name);
            $parameters[$gMap->type][] = $agg;
        }

        return $parameters;
    }


    /**
     * @return array
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }
}