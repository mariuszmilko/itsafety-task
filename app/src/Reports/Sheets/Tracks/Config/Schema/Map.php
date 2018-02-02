<?php


return  ['filters' =>
            ['name' => 'TrackFilter', 
            'rowName' => 'record_device_state', 
            'values' => [ ], 
            'expression' => '{$a >= 2}',
            'class' => StartDate::Class,
            'lastAware' => false
            ],
         'aggregates' => 
             ['name' => 'StartDate', 
              'rowName' => 'record_timestamp', 
              'values' => [ ], 
              'class' => StartDate::Class,
              'lastAware' => false],
             ['name' => 'EndDate', 
              'rowName' => 'record_timestamp', 
              'values' => [ ], 
              'class' => EndDate::Class,
              'lastAware' => true],
             ['name' => 'AvgSpeed', 
              'rowName' => 
              'record_can_speed', 
              'values' => [ ], 
              'class' => AvgSpeed::Class,
              'lastAware' => false],
];