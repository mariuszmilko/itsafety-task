<?php

namespace App\Reports\Sheets\Tracks\Config\Parameters;

use App\Reports\Library\Parameters\Generic\
{
    IParameterAgg, Parameter as AbstractParameter
};
use App\Reports\Sheets\Tracks\Config\Parameters\Values\Generic\Value;
use App\Reports\Sheets\Tracks\Config\Parameters\Values\ValueInt;


/**
 * Class StartFuel
 * @package App\Reports\Sheets\Tracks\Config\Parameters
 */
class StartFuel extends AbstractParameter implements IParameterAgg
{
    /**
     * @var bool
     */
    protected $first = false;
    /**
     * @var
     */
    protected $next;
    /**
     * @var int
     */
    protected $value = 0;

    /**
     * @param array $parameters
     */
    public function calculate(array $parameters): void
    {
        if($this->first == false)
        {
            $this->value = $parameters['value'];
            $this->first = true;
        }
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
}