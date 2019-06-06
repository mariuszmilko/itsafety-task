<?php

namespace App\Reports\Library\Classes\Domain\Model;

use App\Reports\Library\Classes\Domain\Model\Generic\Track\
{
    IType
};
use App\Reports\Library\Classes\Factory\Generic\
{
    IDictionary
};
use App\Reports\Library\Classes\Helpers\Arrays\ArrayGenerator;


/**
 * Class ParametrAggregator
 * @package App\Reports\Library\Classes\Domain\Model
 */
class ParametrAggregator implements \IteratorAggregate
{
    /**
     * @var array
     */
    protected $parameters = [];
    /**
     * @var IDictionary
     */
    protected $multiAggDictionary;


    /**
     * ParametrAggregator constructor.
     * @param IDictionary $multiAggDictionary
     */
    public function __construct(IDictionary $multiAggDictionary)
    {
        $this->multiAggDictionary = $multiAggDictionary;
    }


    /**
     * @param \IteratorAggregate $track
     */
    public function extractParameters(\IteratorAggregate $track): void
    {
        foreach($track as $index)
        {
            foreach($index as $parameter)
            {
                $mag = $this->multiAggDictionary->get($parameter->getName());
                if(isset($this->parameters[$parameter->getName()]))
                {
                    $mag = $this->parameters[$parameter->getName()];
                }
                else
                {
                    !(isset($mag)) ?: $this->parameters[$parameter->getName()] = $mag;
                }
                !(isset($mag)) ?: $mag->calculate($parameter);
            }
        }
    }


    /**
     * @return \IteratorAggregate
     */
    public function getIterator(): \IteratorAggregate
    {
        return new ArrayGenerator($this->parameters);
    }
}