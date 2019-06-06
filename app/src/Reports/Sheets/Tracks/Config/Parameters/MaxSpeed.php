<?php

namespace App\Reports\Sheets\Tracks\Config\Parameters;

use App\Reports\Library\Parameters\Generic\
{
    IParameterAgg, Parameter as AbstractParameter
};
use App\Reports\Sheets\Tracks\Config\Parameters\Values\Generic\Value;
use App\Reports\Sheets\Tracks\Config\Parameters\Values\ValueInt;


/**
 * Class MaxSpeed
 * @package App\Reports\Sheets\Tracks\Config\Parameters
 */
class MaxSpeed extends AbstractParameter implements IParameterAgg
{
    /**
     * @var int
     */
    protected $max = 0;

    /**
     * @param array $parameters
     */
    public function calculate(array $parameters): void
    {
        $this->max = $this->max < $parameters['value'] ? $parameters['value'] : $this->max;
    }

    /**
     * @return Value
     */
    public function getCalculatedValue(): Value
    {
        return new ValueInt($this->max);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return "Parametr: " . $this->getName() . "\r\nWartość: " . $this->getCalculatedValue();
    }
}