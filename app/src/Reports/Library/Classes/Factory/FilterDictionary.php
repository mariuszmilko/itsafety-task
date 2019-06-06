<?php

namespace App\Reports\Library\Classes\Factory;

use App\Reports\Library\Classes\Factory\Generic\IDictionary;

use App\Reports\Library\Parameters\Generic\IParameter;
use stdClass;


/**
 * Class FilterDictionary
 * @package App\Reports\Library\Classes\Factory
 */
class FilterDictionary implements IDictionary
{


    /**
     * @var array
     */
    protected $filtersDictionary = [];


    /**
     * FilterDictionary constructor.
     * @param stdClass $filters
     */
    public function __construct(stdClass $filters)
    {
        $this->fillDictionary($filters);
    }


    /**
     * @param stdClass $data
     */
    public function fillDictionary(stdClass $data): void
    {
        foreach($data as $key => $filter)
        {
            $this->filtersDictionary[$filter->class] = $filter->class;
        }
    }


    /**
     * @param string $key
     * @return IParameter
     */
    public function get(string $key): ?IParameter
    {
        return new $this->filtersDictionary[$key];
    }

}