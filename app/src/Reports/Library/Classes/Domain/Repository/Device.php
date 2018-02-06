<?php

namespace App\Reports\Library\Classes\Domain\Repository;

use App\Reports\Library\Classes\Repository\Device\IDeviceRepository;




class Device implements IDeviceRepository
{


    
    protected $db;




    public function __construct($db)
    {
        $this->db = $db;
    }
    



    public function xFindDeviceTracksByDate($deviceId, $dateFrom, $dateTo) 
    {
        $query = 'SELECT device_id, record_timestamp as start_date, record_timestamp as end_date, 
                         record_device_state, record_can_speed, record_calc_distance, 
                         record_analog_fuel_recalc, record_can_fuel_recalc 
                  FROM record 
                  WHERE device_id = :device AND DATE(record_timestamp) BETWEEN :dateFrom AND :dateTo 
                  ORDER BY record_timestamp';

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':device', $deviceId, \PDO::PARAM_INT);
        $stmt->bindParam(':dateFrom', $dateFrom, \PDO::PARAM_STR, 19);
        $stmt->bindParam(':dateTo', $dateTo, \PDO::PARAM_STR, 19);
        $stmt->execute();
         
        while ($record = $stmt->fetch(\PDO::FETCH_ASSOC)){        
            yield $record;//$this->mapToObject($record);  
        }
    }




    public function xFindDeviceByDay($deviceId, $day)
    {
        $query = 'SELECT device_id, record_timestamp as start_date, record_timestamp as end_date, 
                         record_device_state, record_can_speed, record_calc_distance, 
                         record_analog_fuel_recalc, record_can_fuel_recalc    
                  FROM record 
                  WHERE device_id = :device AND DATE(record_timestamp) = :day
                  ORDER BY record_timestamp';

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':device', $deviceId, PDO::PARAM_INT);
        $stmt->bindParam(':timestamp', $day, PDO::PARAM_STR, 12);
        $stmt->execute();
         
        while($record = $stmt->fetch(PDO::FETCH_ASSOC)) {
            yield $record;//$this->mapToObject($record);     
        }
    }
}