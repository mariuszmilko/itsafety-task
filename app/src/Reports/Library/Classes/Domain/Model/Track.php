<?php

namespace App\Reports\Library\Classes\Domain\Model;

use App\Reports\Library\Classes\Domain\Model\Generic\Point\
{
    IPoint, IPointProcess, IPointUpdate
};
use App\Reports\Library\Classes\Domain\Model\Generic\Parameter\
{
    IProcessAndUpdate
};
use App\Reports\Library\Classes\Domain\Model\Generic\Track\
{
    IType
};
use App\Reports\Library\Classes\Helpers\Generic\IValidLength;
use App\Reports\Library\Classes\Helpers\Arrays\ArrayGenerator;


/**
 * Class Track
 * @package App\Reports\Library\Classes\Domain\Model
 */
class Track implements IType, \IteratorAggregate
{
    /**
     * @var IProcessAndUpdate
     */
    protected $parameterTrack;
    /**
     * @var int
     */
    protected $length = 0;


    /**
     * Track constructor.
     * @param IProcessAndUpdate $parameter
     */
    public function __construct(IProcessAndUpdate $parameter)
    {
        $this->parameterTrack = $parameter;
    }


    /**
     * @param string $name
     * @return mixed
     */
    public function getParameter(string $name)
    {
        if(!isset($this->parameterTrack))
        {
            throw new Exception('Błędna nazwa parametru');
        }

        return $this->parameterTrack->getParameter($name);
    }


    /**
     * @param IPoint $point
     */
    public function processPoint(IPoint $point)
    {
        $this->parameterTrack->processing($point);
        $this->length++;
    }


    /**
     * @param IPoint $point
     * @return Track
     */
    public function updateOnEnd(IPoint $point): Track
    {
        $this->parameterTrack->getDateAggData($point);

        return $this;
    }


    /**
     * @param IValidLength $tValid
     * @return bool
     */
    public function isValidLength(IValidLength $tValid): bool
    {
        return $tValid->isValidLength($this->length);
    }


    /**
     * @return \IteratorAggregate
     */
    public function getIterator(): \IteratorAggregate
    {
        return new ArrayGenerator($this->parameterTrack);
    }
}