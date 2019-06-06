<?php

namespace App\Reports\Sheets\Tracks\Config\Parameters\Aggregators;

use App\Reports\Library\Parameters\Generic\
{
    IMultiAggregator, IParameterAgg
};
use App\Reports\Sheets\Tracks\Config\Parameters\Values\Generic\Value;
use App\Reports\Sheets\Tracks\Config\Parameters\Values\ValueDate;


/**
 * Class StartDate
 * @package App\Reports\Sheets\Tracks\Config\Parameters\Aggregators
 */
class StartDate implements IMultiAggregator
{
    /**
     * @var ValueDate
     */
    protected $startDate;
    /**
     * @var bool
     */
    protected $first = false;


    /**
     * @param IParameterAgg $parameter
     */
    public function calculate(IParameterAgg $parameter): void
    {
        if($this->first == false)
        {
            $this->startDate = $parameter->getCalculatedValue();
            $this->first     = true;
        }
    }


    /**
     * @return mixed
     */
    public function getCalculatedValue(): Value
    {
        return new ValueDate($this->startDate);
    }


    /**
     * @return string
     */
    public function __toString(): string
    {
        return 'Data Początkowa: ' . $this->getCalculatedValue();
    }
}