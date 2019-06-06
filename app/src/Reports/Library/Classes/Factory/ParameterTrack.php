<?php

namespace App\Reports\Library\Classes\Factory;


use App\Reports\Library\Classes\Domain\Model\
{
    Generic\Parameter\IProcessAndUpdate, ParameterTrack as ParameterTrackModel
};
use App\Reports\Library\Classes\Factory\Generic\
{
    IFactoryData, IDictionary
};


/**
 * Class ParameterTrack
 * @package App\Reports\Library\Classes\Factory
 */
final class ParameterTrack implements IFactoryData
{
    /**
     * @param array $parameters
     * @return ParameterTrackModel
     */
    public function factory(array $parameters): IProcessAndUpdate
    {
        return new ParameterTrackModel($parameters);
    }
}