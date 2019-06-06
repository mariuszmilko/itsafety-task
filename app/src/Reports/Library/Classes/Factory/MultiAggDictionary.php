<?php

namespace App\Reports\Library\Classes\Factory;

use App\Reports\Library\Classes\Factory\Generic\IDictionary;

use App\Reports\Library\Parameters\Generic\IParameter;
use stdClass;


/**
 * Class MultiAggDictionary
 * @package App\Reports\Library\Classes\Factory
 */
class MultiAggDictionary implements IDictionary
{
    /**
     * @var array
     */
    protected $multiAggDictionary = [];

    /**
     * MultiAggDictionary constructor.
     * @param stdClass $aggs
     */
    public function __construct(stdClass $aggs)
    {
        $this->fillDictionary($aggs);
    }

    /**
     * @param stdClass $data
     */
    public function fillDictionary(stdClass $data): void
    {
        foreach($data as $key => $agg)
        {
            if(isset($agg->summary))
            {
                $this->multiAggDictionary[$agg->name] = $agg->summary;
            }
        }
    }

    /**
     * @param string $key
     * @return null|IParameter
     */
    public function get(string $key): ?IParameter
    {
        return isset($this->multiAggDictionary[$key]) ? new $this->multiAggDictionary[$key] : null;
    }
}