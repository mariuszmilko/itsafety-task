<?php

namespace App\Reports\Sheets\Tracks\Config\Parameters;

use App\Reports\Library\Parameters\Generic\
{
    IParameterAgg, Parameter as AbstractParameter
};
use App\Reports\Sheets\Tracks\Config\Parameters\Values\Generic\Value;
use App\Reports\Sheets\Tracks\Config\Parameters\Values\ValueInt;


/**
 * Class DiffFuel
 * @package App\Reports\Sheets\Tracks\Config\Parameters
 */
class DiffFuel extends AbstractParameter implements IParameterAgg
{
    /**
     * @var int
     */
    protected $first     = 0;
    /**
     * @var int
     */
    protected $lastValue = 0;
    /**
     * @var int
     */
    protected $firstValue;

    /**
     * @param array $parameters
     */
    public function calculate(array $parameters): void
    {
        if($this->first == false)
        {
            $this->firstValue = $parameters['value'];
            $this->first      = true;
        }
        else
        {
            $this->lastValue = $parameters['value'];;
        }
    }

    /**
     * @return Value
     */
    public function getCalculatedValue(): Value
    {
        return new ValueInt($this->firstValue - $this->lastValue);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return "Parametr: " . $this->getName() . "\r\nWartość: " . $this->getCalculatedValue();
    }
}