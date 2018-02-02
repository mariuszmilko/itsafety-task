<?php

namespace App\Reports\Library\Classes\Repository;

use App\Reports\Library\Classes\Repository\Track\ITrackRepository;

class Device extends IDeviceRepository
{
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }
    
    public function xFindDeviceTracksByDate($dateFrom, $dateTo, $type) 
    {
        $device = 1;
        $timesatmp = '2017';
        $stmt = $this->db->prepare('//select device_id, record_timestamp,record_device_state, record_can_speed  from record WHERE device_id =   40285; AND record_device_state = 3 
            FROM fruit
            WHERE device < :device AND timestamp = :timestamp');
        $stmt->bindParam(':device', $device, PDO::PARAM_INT);
        $stmt->bindParam(':timestamp', $timestamp, PDO::PARAM_STR, 12);
        $stmt->execute();
         
            while($record = $stmt->fetch(PDO::FETCH_ASSOC)) {
         
                yield $record;//$this->mapToObject($record);
         
            }
    }

    public function xFindDeviceByDay($date, $type) 
    {
        $device = 1;
        $timestamp = '2017';
        $stmt = $this->db->prepare('//select device_id, record_timestamp,record_device_state, record_can_speed  from record WHERE device_id =   40285; AND record_device_state = 3 
            FROM fruit
            WHERE device < :device AND timestamp = :timestamp');
        $stmt->bindParam(':device', $device, PDO::PARAM_INT);
        $stmt->bindParam(':timestamp', $timestamp, PDO::PARAM_STR, 12);
        $stmt->execute();
         
            while($record = $stmt->fetch(PDO::FETCH_ASSOC)) {
         
                yield $record;//$this->mapToObject($record);
         
            }
    }
}