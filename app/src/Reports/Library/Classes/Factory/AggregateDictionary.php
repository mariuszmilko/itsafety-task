<?php

namespace App\Reports\Library\Classes\Factory;

use App\Reports\Library\Classes\Factory\Generic\IDictionary;
use stdClass;


/**
 * Class AggregateDictionary
 * @package App\Reports\Library\Classes\Factory
 */
class AggregateDictionary implements IDictionary
{
    /**
     * @var array
     */
    protected $aggregatesDictionary = [];

    /**
     * AggregateDictionary constructor.
     * @param stdClass $aggs
     */
    public function __construct(stdClass $aggs)
    {
        $this->fillDictionary($aggs);
    }

    /**
     * @param stdClass $data
     */
    public function fillDictionary(stdClass $data)
    {
        foreach($data as $key => $agg)
        {
            $this->aggregatesDictionary[$agg->class] = $agg->class;
        }
    }

    /**
     * @param string $key
     * @return stdClass
     */
    public function get(string $key): \stdClass
    {
        return new $this->aggregatesDictionary[$key];
    }
}