<?php

namespace App\Reports\Library\Classes\Factory;

use App\Reports\Library\Classes\Domain\Model\Track as TrackModel;
use App\Reports\Library\Classes\Domain\Model\Generic\Point\IPoint;
use App\Reports\Library\Classes\Factory\{Mapper as FactoryMapper, ParameterTrack as FactoryParameterTrack};
use App\Reports\Library\Classes\Factory\Generic\IFactoryPoint;




final class Track implements IFactoryPoint
{
    private $factoryMapper;
    private $factoryParameterTrack;

    public function __construct(FactoryMapper $fm, FactoryParameterTrack $fpt)
    {
        $this->factoryMapper = $fm;
        $this->factoryParameterTrack = $fpt;
    }

    public function factory(IPoint $point) 
    {
        $this->factoryMapper->factory($point->getData())
            ->delimiter()
            ->extractParameters(function ($params) use (&$trackModel) {
                $trackModel = new TrackModel($this->factoryParameterTrack->factory($params));
            });
         //monads maybe
        return $trackModel;
    }
}