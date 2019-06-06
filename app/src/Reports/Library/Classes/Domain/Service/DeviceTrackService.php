<?php

namespace App\Reports\Library\Classes\Domain\Service;

use App\Reports\Library\Classes\Domain\Model\Generic\Device\IDevice;
use App\Reports\Library\Classes\Repository\Device\IDeviceRepository;
use App\Reports\Library\Classes\Factory\Generic\IFactoryDevice;
use App\Reports\Library\Classes\Service\IService;
use stdClass;


/**
 * Class DeviceTrackService
 * @package App\Reports\Library\Classes\Domain\Service
 */
class DeviceTrackService implements IService
{
    /**
     * @var IDeviceRepository
     */
    protected $repository;
    /**
     * @var IFactoryDevice
     */
    protected $factoryDevice;
    /**
     * @var \PDO
     */
    protected $conn;


    /**
     * DeviceTrackService constructor.
     * @param IDeviceRepository $repository
     * @param IFactoryDevice $factoryDevice
     * @param \PDO $conn
     */
    public function __construct(IDeviceRepository $repository, IFactoryDevice $factoryDevice, \PDO $conn)
    {
        $this->repository    = $repository;
        $this->factoryDevice = $factoryDevice;
        $this->conn          = $conn;
    }


    /**
     * @param int $deviceId
     * @param string $dateFrom
     * @param string $dateTo
     * @return \App\Reports\Library\Classes\Domain\Model\Generic\Device\IDevice
     */
    public function getDataByDate(int $deviceId, string $dateFrom, string $dateTo): IDevice
    {
        $deviceId = $deviceId;
        $datefrom = $dateFrom;
        $dateTo   = $dateTo;

        $xRecords = $this->repository->xFindDeviceTracksByDate($deviceId, $datefrom, $dateTo);

        $device = $this->factoryDevice->factory($deviceId, $xRecords);
        $device->processTracks();

        return $device;
    }


    /**
     * @param int $device_id
     * @param string $dateDay
     * @return \App\Reports\Library\Classes\Domain\Model\Generic\Device\IDevice
     */
    public function getDataByDay(int $device_id, string $dateDay): IDevice
    {
        $deviceId = $device_id;
        $day      = $dateDay;

        $xRecords = $this->repository->xFindDeviceByDay($deviceId, $day);

        $device = $this->factoryDevice->factory($deviceId, $xRecords);
        $device->processTracks();

        return $device;
    }
}