<?php

namespace App\Reports\Library\Classes\Domain\Model;

use App\Reports\Library\Classes\Domain\Model\Generic\Track\
{
    IType
};
use App\Reports\Library\Classes\Domain\Model\Generic\Point\
{
    IPointData
};
use App\Reports\Library\Classes\Factory\Generic\
{
    IDictionary
};
use App\Reports\Library\Classes\Helpers\Arrays\ArrayGenerator;
use App\Reports\Library\Classes\Domain\Model\Generic\Parameter\
{
    IParameterTrack, IParameterTrackUpdate, IProcessAndUpdate
};


/**
 * Class ParameterTrack
 * @package App\Reports\Library\Classes\Domain\Model
 */
class ParameterTrack implements IProcessAndUpdate, \IteratorAggregate
{
    /**
     * @var array
     */
    protected $parameters = [];


    /**
     * ParameterTrack constructor.
     * @param array $parameters
     */
    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }


    /**
     * @return mixed
     */
    public function getEndLastAware()
    {
        return current($this->parameters['end']);
    }


    /**
     * @param IPointData $point
     */
    public function getDateAggData(IPointData $point)
    {
        $p    = $this->getEndLastAware();
        $data = $point->getField($p->getRowname());
        $p->calculate(['value' => $data]);
    }


    /**
     * @param string $name
     * @return mixed
     */
    public function getParameter(string $name)
    {
        return $this->parameters[$name];
    }


    /**
     * @param IPointData $point
     */
    public function processing(IPointData $point): void
    {
        foreach($this->parameters as &$parameter)
        {
            foreach($parameter as &$p)
            {
                $p->calculate(['value' => $point->getField($p->getRowname())]);
            }
        }
    }


    /**
     * @return \IteratorAggregate
     */
    public function getIterator(): \IteratorAggregate
    {
        return new ArrayGenerator($this->parameters);
    }
}