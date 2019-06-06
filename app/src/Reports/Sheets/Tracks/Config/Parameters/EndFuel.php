<?php

namespace App\Reports\Sheets\Tracks\Config\Parameters;

use App\Reports\Library\Parameters\Generic\
{
    IParameterAgg, Parameter as AbstractParameter
};
use App\Reports\Sheets\Tracks\Config\Parameters\Values\Generic\Value;
use App\Reports\Sheets\Tracks\Config\Parameters\Values\ValueFloat;

/**
 * Class EndFuel
 * @package App\Reports\Sheets\Tracks\Config\Parameters
 */
class EndFuel extends AbstractParameter implements IParameterAgg
{
    /**
     * @var int
     */
    protected $sum      = 0;
    /**
     * @var int
     */
    protected $maxCount = 0;

    /**
     * @param array $parameters
     */
    public function calculate(array $parameters): void
    {
        $this->sum   += $parameters['value'];
        $this->index += $parameters['index'];
    }

    /**
     * @return Value
     */
    public function getCalculatedValue(): Value
    {
        return new ValueFloat($this->sum / $this->index);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return "Parametr: " . $this->getName() . "\r\nWartość: " . $this->getCalculatedValue();
    }

}