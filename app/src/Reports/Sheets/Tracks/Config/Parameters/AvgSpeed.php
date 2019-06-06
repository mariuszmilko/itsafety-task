<?php

namespace App\Reports\Sheets\Tracks\Config\Parameters;

use App\Reports\Library\Parameters\Generic\
{
    IParameterAgg, Parameter as AbstractParameter
};
use App\Reports\Sheets\Tracks\Config\Parameters\Values\Generic\Value;
use App\Reports\Sheets\Tracks\Config\Parameters\Values\ValueFloat;


/**
 * Class AvgSpeed
 * @package App\Reports\Sheets\Tracks\Config\Parameters
 */
class AvgSpeed extends AbstractParameter implements IParameterAgg
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
     * @var int
     */
    protected $index;

    /**
     * @param $parameters
     */
    public function calculate(array $parameters): void
    {
        $this->sum   += $parameters['value'];
        $this->index += 1;
    }

    /**
     * @return Value
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
        return "Parametr: " . $this->getName() . "\r\nWartość: " . $this->getCalculatedValue();
    }
}