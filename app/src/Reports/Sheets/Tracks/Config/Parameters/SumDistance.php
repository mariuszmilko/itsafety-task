<?php

namespace App\Reports\Sheets\Tracks\Config\Parameters;

use App\Reports\Library\Parameters\Generic\
{
    IParameter, IParameterAgg, IParameterChain, Parameter as AbstractParameter
};
use App\Reports\Sheets\Tracks\Config\Parameters\Values\Generic\Value;


/**
 * Class SumDistance
 * @package App\Reports\Sheets\Tracks\Config\Parameters
 */
class SumDistance extends AbstractParameter implements IParameterAgg, IParameterChain
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
    protected $index    = 0;

    /**
     * @param array $parameters
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
        return new ValueInt($this->sum);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return "Parametr: " . $this->getName() . "\r\nWartość: " . $this->getCalculatedValue();
    }

    /**
     * @param Value $value
     */
    public function handleOperation(Value $value): void
    {
        print_r('sum_distance');
        exit('chainOnEnd');
    }

    /**
     * @param $nextParam
     */
    public function setSuccessor(IParameter $nextParam): void
    {
        print_r('sum_distance');
        exit('chainOnEnd');
    }

}