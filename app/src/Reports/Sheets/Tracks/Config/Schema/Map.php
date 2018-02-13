<?php

namespace App\Reports\Sheets\Tracks\Config\Parameters;

use App\Reports\Sheets\Tracks\Config\Parameters\Aggregators\{
    AvgSpeed as AvgSpeedMulti,
    StartDate as StartDateMulti,
    EndDate as EndDateMulti
};

return ['filters' =>
            ['TrackFilter' => [
                'name' => 'TrackFilterType', 
                'rowName' => 'record_device_state', 
                'values' => [ ], 
                'expression' => '{$a > 2}',
                'class' => TypeFilterTrack::class,
                'lastAware' => false,
                'type' => 'track',
                'delimiter' => -2,
                'chainOnUpdate' => '',
                'chainOnProcess' => ''],
            'StopFilter' => [
                'name' => 'StopFilterType', 
                'rowName' => 'record_device_state', 
                'values' => [ ], 
                'expression' => '{$a <= 2}',
                'class' => TypeFilterStop::class,
                'lastAware' => false,
                'type' => 'stop',
                'delimiter' => -1,
                'chainOnUpdate' => '',
                'chainOnProcess' => ''],
            'EndFilter' => [
                'name' => 'StopFilterDate', 
                'rowName' => 'end_date', 
                'values' => [ ], 
                'expression' => '',
                'class' => TypeFilterDate::class,
                'lastAware' => true,
                'type' => 'end',
                'chainOnUpdate' => '',
                'chainOnProcess' => ''],
            'StartFilter' => [
                'name' => 'StartFilterDate', 
                'rowName' => 'start_date', 
                'values' => [ ], 
                'expression' => '',
                'class' => TypeFilterDate::class,
                'lastAware' => false,
                'type' => 'start',
                'chainOnUpdate' => '',
                'chainOnProcess' => ''],
            ], 
         'aggregates' => 
             ['start_date' => [
                'name' => 'StartDate', 
                'rowName' => 'start_date', 
                'values' => [ ], 
                'type' => 'start',
                'class' => StartDate::class,    
                'lastAware' => false,
                'chainOnUpdate' => '',
                'chainOnProcess' => '',
                'summary' => StartDateMulti::class],
             'end_date' => [
                'name' => 'EndDate', 
                'rowName' => 'end_date', 
                'values' => [ ], 
                'type' => 'end',
                'class' => EndDate::class,    
                'lastAware' => true,
                'chainOnUpdate' => '',
                'chainOnProcess' => '',
                'summary' => EndDateMulti::class],
             'record_calc_distance' => [
                'name' => 'sumDistance', 
                'rowName' => 'record_calc_distance', 
                'values' => [ ], 
                'type' => 'track',
                'class' => SumDistance::class,    
                'lastAware' => false,
                'chainOnUpdate' => '',//'record_fuel_stop',
                'chainOnProcess' => ''],
             'record_fuel_track' => [
                'name' => 'record_fuel_track_analog', 
                'rowName' => 'record_analog_fuel_recalc', 
                'values' => [ ], 
                'type' => 'track',
                'class' => DiffFuel::class,    
                'lastAware' => false,
                'chainOnEnd' => '',
                'chainOnProcess' => ''], 
            'begin_fuel_typetrack' => [
                'name' => 'record_fuel_track_begin_ontrack', 
                'rowName' => 'record_analog_fuel_recalc', 
                'values' => [ ], 
                'type' => 'track',
                'class' => StartFuel::class,    
                'lastAware' => false,
                'chainOnEnd' => '',
                'chainOnProcess' => ''], 
            'end_fuel_typetrack' => [
                'name' => 'record_fuel_track_end_ontrack', 
                'rowName' => 'record_analog_fuel_recalc', 
                'values' => [ ], 
                'type' => 'track',
                'class' => StopFuel::class,    
                'lastAware' => false,
                'chainOnEnd' => '',
                'chainOnProcess' => ''], 
            'begin_fuel_typestop' => [
                'name' => 'record_fuel_track_begin_onstop', 
                'rowName' => 'record_analog_fuel_recalc', 
                'values' => [ ], 
                'type' => 'stop',
                'class' => StartFuel::class,    
                'lastAware' => false,
                'chainOnEnd' => '',
                'chainOnProcess' => ''], 
            'end_fuel_typestop' => [
                'name' => 'record_fuel_track_end_onstop', 
                'rowName' => 'record_analog_fuel_recalc', 
                'values' => [ ], 
                'type' => 'stop',
                'class' => StopFuel::class,    
                'lastAware' => false,
                'chainOnEnd' => '',
                'chainOnProcess' => ''], 
              'record_calc_odo_distance' => [
                'name' => 'sumOdoDistance', 
                'rowName' => 'record_calc_odo', 
                'values' => [ ], 
                'type' => 'track',
                'class' => SumOdoDistance::class,    
                'lastAware' => false,
                'chainOnUpdate' => '',//'record_fuel_stop',
                'chainOnProcess' => ''],  
              'MaxSpeed' => [
                'name' => 'maxspeed', 
                'rowName' => 'record_gps_speed', 
                'values' => [ ], 
                'type' => 'track',
                'class' => MaxSpeed::class,    
                'lastAware' => false,
                'chainOnUpdate' => '',
                'chainOnProcess' => ''],  
              'MinSpeed' => [
                'name' => 'minspeed', 
                'rowName' => 'record_gps_speed', 
                'values' => [ ], 
                'type' => 'track',
                'class' => MinSpeed::class,    
                'lastAware' => false,
                'chainOnUpdate' => '',
                'chainOnProcess' => ''],
              'AvgSpeed' => [
                'name' => 'avgspeed', 
                'rowName' => 'record_gps_speed', 
                'values' => [ ], 
                'type' => 'track',
                'class' => AvgSpeed::class,    
                'lastAware' => false,
                'chainOnUpdate' => '',
                'chainOnProcess' => '',
                'summary' => AvgSpeedMulti::class]            
              ]
];