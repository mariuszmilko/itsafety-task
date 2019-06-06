<?php

namespace App\Reports\Sheets\Tracks\Config\Parameters\Aggregators;

use App\Reports\Library\Parameters\Generic\
{
    IMultiAggregator, IParameterAgg
};
use App\Reports\Sheets\Tracks\Config\Parameters\Values\Generic\Value;
use App\Reports\Sheets\Tracks\Config\Parameters\Values\ValueFloat;


/**
 * Class AvgSpeed
 * @package App\Reports\Sheets\Tracks\Config\Parameters\Aggregators
 */
class AvgSpeed implements IMultiAggregator
{
    /**
     * @var int
     */
    protected $sum = 0;
    /**
     * @var int
     */
    protected $maxCount = 0;
    /**
     * @var int
     */
    protected $index;


    /**
     * @param IParameterAgg $parameter
     */
    public function calculate(IParameterAgg $parameter): void
    {
        $this->sum   += ($parameter->getCalculatedValue())();
        $this->index += 1;
    }


    /**
     * @return float
     */
    public function getCalculatedValue(): Value
    {
        return !($this->index > 0 && $this->sum > 0) ?: new ValueFloat($this->sum / $this->index);
    }


    /**
     * @return string
     */
    public function __toString(): string
    {
        return 'Średnia prędkość: ' . $this->getCalculatedValue();
    }
}