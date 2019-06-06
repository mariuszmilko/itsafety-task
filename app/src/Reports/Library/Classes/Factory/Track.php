<?php

namespace App\Reports\Library\Classes\Factory;

use App\Reports\Library\Classes\Domain\Model\Generic\Track\IType;
use App\Reports\Library\Classes\Domain\Model\Track as TrackModel;
use App\Reports\Library\Classes\Domain\Model\Generic\Point\IPoint;
use App\Reports\Library\Classes\Factory\
{
    Generic\IFactoryTrack, Mapper as FactoryMapper, ParameterTrack as FactoryParameterTrack
};

/**
 * Class Track
 * @package App\Reports\Library\Classes\Factory
 */
final class Track implements IFactoryTrack
{
    /**
     * @var Mapper
     */
    private $factoryMapper;
    /**
     * @var ParameterTrack
     */
    private $factoryParameterTrack;

    /**
     * Track constructor.
     * @param Mapper $fm
     * @param ParameterTrack $fpt
     */
    public function __construct(FactoryMapper $fm, FactoryParameterTrack $fpt)
    {
        $this->factoryMapper         = $fm;
        $this->factoryParameterTrack = $fpt;
    }

    /**
     * @param IPoint $point
     * @return IType
     * @throws \Exception
     */
    public function factory(IPoint $point): IType
    {
        $this->factoryMapper->factory($point->getData())->delimiter()->extractParameters(function($params) use (&$trackModel) {
            $trackModel = new TrackModel($this->factoryParameterTrack->factory($params));
        });
        //monads maybe
        return $trackModel;
    }
}