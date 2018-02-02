<?php


return  ['filters' =>
             [

             ],
         'aggregates' => 
             ['name' => 'StartDate', 
              'rowName' => 'record_timestamp', 
              'values' => [ ], 
              'class' => StartDate::Class
             ],
             ['name' => 'EndDate', 
              'rowName' => 'record_timestamp', 
              'values' => [ ], 
              'class' => EndDate::Class],
             ['name' => 'AvgSpeed', 
              'rowName' => 
              'record_can_speed', 
              'values' => [ ], 
              'class' => AvgSpeed::Class
             ]
]; 