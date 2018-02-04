<?php

namespace App\Reports\Sheets\Tracks\Config\Parameters;

return ['filters' =>
            ['TrackFilter' => [
                'name' => 'TrackFilter', 
                'rowName' => 'record_device_state', 
                'values' => [ ], 
                'expression' => '{$a > 2}',
                'class' => TypeFilterTrack::class,
                'lastAware' => false,
                'type' => 'track',
                'delimiter' => 999],
            'StopFilter' => [
                'name' => 'StopFilter', 
                'rowName' => 'record_device_state', 
                'values' => [ ], 
                'expression' => '{$a <= 2}',
                'class' => TypeFilterStop::class,
                'lastAware' => false,
                'type' => 'stop',
                'delimiter' => -1],
            'EndFilter' => [
                'name' => 'StopFilter', 
                'rowName' => 'end_date', 
                'values' => [ ], 
                'expression' => '',
                'class' => TypeFilterDate::class,
                'lastAware' => false,
                'type' => 'start'],
            'StartFilter' => [
                'name' => 'StartFilter', 
                'rowName' => 'start_date', 
                'values' => [ ], 
                'expression' => '',
                'class' => TypeFilterDate::class,
                'lastAware' => false,
                'type' => 'end'],
            ], 
         'aggregates' => 
             ['start_date' => [
                'name' => 'StartDate', 
                'rowName' => 'start_date', 
                'values' => [ ], 
                'type' => 'start',
                'class' => StartDate::class,    
                'lastAware' => true],
             'end_date' => [
                'name' => 'EndDate', 
                'rowName' => 'end_date', 
                'values' => [ ], 
                'type' => 'end',
                'class' => EndDate::class,    
                'lastAware' => true],
             'record_calc_distance' => [
                'name' => 'sumDistance', 
                'rowName' => 'record_calc_distance', 
                'values' => [ ], 
                'type' => 'track',
                'class' => SumDistance::class,    
                'lastAware' => true],
             'record_fuel_track' => [
                'name' => 'record_fuel_track', 
                'rowName' => 'record_analog_fuel_recalc', 
                'values' => [ ], 
                'type' => 'track',
                'class' => StartFuel::class,    
                'lastAware' => true],
              'record_fuel_stop' => [
                'name' => 'record_fuel_stop', 
                'rowName' => 'record_analog_fuel_recalc', 
                'values' => [ ], 
                'type' => 'stop',
                'class' => StopFuel::class,    
                'lastAware' => true],                
              ]
];