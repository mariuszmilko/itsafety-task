<?php

namespace App\Reports\Library\Classes\Factory;

use App\Reports\Library\Classes\Domain\Model\Track as TrackModel;
use App\Reports\Library\Classes\Domain\Model\Generic\Point\IPoint;
use App\Reports\Library\Classes\Factory\{Mapper as FactoryMapper};
use App\Reports\Library\Classes\Factory\Generic\IFactoryPoint;




final class Track implements IFactoryPoint
{
    private $factoryMapper;

    public function __construct(FactoryMapper $fm)
    {
        $this->factoryMapper = $fm;
    }

    public function factory(IPoint $point) 
    {
        $parameters = $this->factoryMapper->factory($point->getData())
            ->delimiter()
            ->extractParameters()
            ->getParameters();

        return new TrackModel($parameters);
    }
}