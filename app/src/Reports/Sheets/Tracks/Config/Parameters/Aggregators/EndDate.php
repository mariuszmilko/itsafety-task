<?php

namespace App\Reports\Sheets\Tracks\Config\Parameters\Aggregators;

use App\Reports\Library\Parameters\Generic\
{
    IMultiAggregator, IParameterAgg
};
use App\Reports\Sheets\Tracks\Config\Parameters\Values\Generic\Value;
use App\Reports\Sheets\Tracks\Config\Parameters\Values\ValueDate;


/**
 * Class EndDate
 * @package App\Reports\Sheets\Tracks\Config\Parameters\Aggregators
 */
class EndDate implements IMultiAggregator
{
    /**
     * @var ValueDate
     */
    protected $endDate;
    /**
     * @var bool
     */
    protected $last = false;


    /**
     * @param IParameterAgg $parameter
     */
    public function calculate(IParameterAgg $parameter): void
    {
        if($this->last == false)
        {
            $this->endDate = $parameter->getCalculatedValue();
        }
    }


    /**
     * @return mixed
     */
    public function getCalculatedValue(): Value
    {
        return new ValueDate($this->endDate);
    }


    /**
     * @return string
     */
    public function __toString(): string
    {
        return 'Data Końcowa: ' . $this->getCalculatedValue();
    }
}