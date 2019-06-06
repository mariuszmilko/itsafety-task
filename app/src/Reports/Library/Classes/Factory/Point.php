<?php

namespace App\Reports\Library\Classes\Factory;

use App\Reports\Library\Classes\Domain\Model\Generic\Point\IPoint;
use App\Reports\Library\Classes\Domain\Model\Point as PointModel;
use App\Reports\Library\Classes\Factory\Generic\
{
    IDictionary, IFactoryData
};
use App\Reports\Library\Classes\Factory\
{
    Mapper as FactoryMapper
};
use stdClass;


/**
 * Class Point
 * @package App\Reports\Library\Classes\Factory
 */
final class Point implements IFactoryData
{
    /**
     * @var IFactoryData
     */
    private $factoryMapper;

    /**
     * Point constructor.
     * @param IFactoryData $fm
     */
    public function __construct(IFactoryData $fm)
    {
        $this->factoryMapper = $fm;
    }

    /**
     * @param array $data
     * @return IPoint
     */
    public function factory(array $data): IPoint
    {
        $this->factoryMapper->factory($data)->delimiter(function($d) use (&$delimiter) {
            $delimiter = $d;
        });

        return new PointModel($data, $delimiter);
    }
}