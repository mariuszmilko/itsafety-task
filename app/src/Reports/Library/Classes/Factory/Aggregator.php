<?php

namespace App\Reports\Library\Classes\Factory;

use App\Reports\Library\Classes\Domain\Model\
{
    ParametrAggregator
};
use App\Reports\Library\Classes\Factory\Generic\
{
    IFactoryAggregator, IFactoryData, IDictionary
};


/**
 * Class Aggregator
 * @package App\Reports\Library\Classes\Factory
 */
final class Aggregator implements IFactoryAggregator
{
    /**
     * @var IFactoryData
     */
    private $factoryMapper;
    /**
     * @var IDictionary
     */
    private $multiAggDictionary;

    /**
     * Aggregator constructor.
     * @param IFactoryData $factoryMapper
     * @param IDictionary $multiAggDictionary
     */
    public function __construct(IFactoryData $factoryMapper, IDictionary $multiAggDictionary)
    {
        $this->factoryMapper      = $factoryMapper;
        $this->multiAggDictionary = $multiAggDictionary;
    }

    /**
     * @return ParametrAggregator
     */
    public function factory(): ParametrAggregator
    {
        return new ParametrAggregator($this->multiAggDictionary);
    }
}