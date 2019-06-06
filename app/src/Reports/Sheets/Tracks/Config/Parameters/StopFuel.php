<?php

namespace App\Reports\Sheets\Tracks\Config\Parameters;

use App\Reports\Library\Parameters\Generic\
{
    IParameter, IParameterAgg, IParameterChain, Parameter as AbstractParameter
};
use App\Reports\Sheets\Tracks\Config\Parameters\Values\Generic\Value;
use App\Reports\Sheets\Tracks\Config\Parameters\Values\ValueInt;


/**
 * Class StopFuel
 * @package App\Reports\Sheets\Tracks\Config\Parameters
 */
class StopFuel extends AbstractParameter implements IParameterAgg, IParameterChain
{
    /**
     * @var  int
     */
    protected $value;
    /**
     * @var bool
     */
    protected $first = false;

    /**
     * @param array $parameters
     */
    public function calculate(array $parameters): void
    {
        $this->value = $parameters['value'];
    }

    /**
     * @return Value
     */
    public function getCalculatedValue(): Value
    {
        return new ValueInt($this->value);
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
        print_r('stop_fuel');
        exit('chainOnEnd');
    }

    /**
     * @param $nextParam
     */
    public function setSuccessor(IParameter $nextParam): void
    {
        print_r('stop_fuel');
        exit('chainOnEnd');
    }

}