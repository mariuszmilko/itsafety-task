<?php

namespace App\Reports\Library\Classes\Factory;

use App\Reports\Library\Classes\Domain\Model\{Device as DeviceModel};
use App\Reports\Library\Classes\Factory\Generic\{IFactoryData, IFactoryAggregator, IFactoryDevice};




final class Device implements IFactoryDevice
{


    private $factoryTrackGenerator;




    public function __construct(IFactoryAggregator $ftd)
    {
         $this->factoryTrackGenerator = $ftd;
    }
 
 


    public function factory(int $deviceId, \Generator $gen)
    {
   
         return new DeviceModel($deviceId, $gen, $this->factoryTrackGenerator->factory());
    }
 }