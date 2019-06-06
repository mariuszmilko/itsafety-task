<?php

namespace App\Reports\Library\Classes\Factory;

use App\Reports\Library\Classes\Domain\Model\
{
    Device as DeviceModel
};
use App\Reports\Library\Classes\Factory\Generic\
{
    IFactoryData, IFactoryAggregator, IFactoryDevice
};


/**
 * Class Device
 * @package App\Reports\Library\Classes\Factory
 */
final class Device implements IFactoryDevice
{
    /**
     * @var IFactoryAggregator
     */
    private $factoryTrackGenerator;


    /**
     * Device constructor.
     * @param IFactoryAggregator $ftd
     */
    public function __construct(IFactoryAggregator $ftd)
    {
        $this->factoryTrackGenerator = $ftd;
    }

    /**
     * @param int $deviceId
     * @param \Generator $gen
     * @return DeviceModel
     */
    public function factory(int $deviceId, \Generator $gen): DeviceModel
    {
        return new DeviceModel($deviceId, $gen, $this->factoryTrackGenerator->factory());
    }
}