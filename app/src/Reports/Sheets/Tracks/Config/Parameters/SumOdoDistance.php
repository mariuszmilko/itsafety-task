<?php

namespace App\Reports\Sheets\Tracks\Config\Parameters;

use App\Reports\Library\Parameters\Generic\
{
    IParameterAgg, IParameterChain, Parameter as AbstractParameter
};
use App\Reports\Sheets\Tracks\Config\Parameters\Values\Generic\Value;
use App\Reports\Sheets\Tracks\Config\Parameters\Values\ValueInt;


/**
 * Class SumOdoDistance
 * @package App\Reports\Sheets\Tracks\Config\Parameters
 */
class SumOdoDistance extends AbstractParameter implements IParameterAgg, IParameterChain
{
    /**
     * @var int
     */
    protected $start = 0;
    /**
     * @var int
     */
    protected $end   = 0;
    /**
     * @var bool
     */
    protected $first = false;

    /**
     * @param array $parameters
     */
    public function calculate(array $parameters): void
    {

        if($this->first == false)
        {
            $this->start = $parameters['value'];
            $this->first = true;
        }
        else
        {
            $this->end = $parameters['value'];
        }
    }

    /**
     * @return Value
     */
    public function getCalculatedValue(): Value
    {
        return new ValueInt($this->end - $this->start);
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
    public function setSuccessor($nextParam): void
    {
        print_r('sum_distance');
        exit('chainOnEnd');
    }

}