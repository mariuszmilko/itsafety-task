<?php

namespace App\Reports\Sheets\Tracks\Config\Parameters;

use App\Reports\Library\Parameters\Generic\
{
    IParameterAgg, Parameter as AbstractParameter
};
use App\Reports\Sheets\Tracks\Config\Parameters\Values\Generic\Value;
use App\Reports\Sheets\Tracks\Config\Parameters\Values\ValueInt;


/**
 * Class MinSpeed
 * @package App\Reports\Sheets\Tracks\Config\Parameters
 */
class MinSpeed extends AbstractParameter implements IParameterAgg
{
    /**
     * @var int
     */
    protected $min = 1000000;

    /**
     * @param array $parameters
     */
    public function calculate(array $parameters): void
    {
        $this->min = $this->min > $parameters['value'] ? $parameters['value'] : $this->min;
    }

    /**
     * @return Value
     */
    public function getCalculatedValue(): Value
    {
        return ($this->min == 1000000) ? new ValueInt(0) : new ValueInt($this->min);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return "Parametr: " . $this->getName() . "\r\nWartość: " . $this->getCalculatedValue();
    }
}