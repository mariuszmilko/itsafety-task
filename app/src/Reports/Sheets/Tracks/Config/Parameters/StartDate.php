<?php

namespace App\Reports\Sheets\Tracks\Config\Parameters;

use App\Reports\Library\Parameters\Generic\
{
    IParameterAgg, Parameter as AbstractParameter
};
use App\Reports\Sheets\Tracks\Config\Parameters\Values\Generic\Value;
use App\Reports\Sheets\Tracks\Config\Parameters\Values\ValueDate;


/**
 * Class StartDate
 * @package App\Reports\Sheets\Tracks\Config\Parameters
 */
class StartDate extends AbstractParameter implements IParameterAgg
{
    /**
     * @var string
     */
    protected $startDate;
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
            $this->startDate = $parameters['value'];
            $this->first     = true;
        }
    }

    /**
     * @return Value
     */
    public function getCalculatedValue(): Value
    {
        return new ValueDate($this->startDate);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return "Parametr: " . (string)$this->getName() . "\r\nWartość: " . $this->getCalculatedValue();
    }

}