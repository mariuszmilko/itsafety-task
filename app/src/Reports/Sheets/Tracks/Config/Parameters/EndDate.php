<?php

namespace App\Reports\Sheets\Tracks\Config\Parameters;

use App\Reports\Library\Parameters\Generic\
{
    IParameterAgg, Parameter as AbstractParameter
};
use App\Reports\Sheets\Tracks\Config\Parameters\Values\Generic\Value;
use App\Reports\Sheets\Tracks\Config\Parameters\Values\ValueDate;


/**
 * Class EndDate
 * @package App\Reports\Sheets\Tracks\Config\Parameters
 */
class EndDate extends AbstractParameter implements IParameterAgg
{
    /**
     * @var string
     */
    protected $endDate;
    /**
     * @var bool
     */
    protected $last = false;

    /**
     * @param array $parameters
     */
    public function calculate(array $parameters): void
    {
        if($this->last == false)
        {
            $this->endDate = $parameters['value'];
        }
    }

    /**
     * @return Value
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
        return "Parametr: " . $this->getName() . "\r\nWartość: " . $this->getCalculatedValue();
    }
}