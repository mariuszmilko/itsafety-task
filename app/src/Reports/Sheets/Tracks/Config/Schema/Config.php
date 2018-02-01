<?php

namespace App\Reposrts\Sheets\Tracks\Config\Schema;


class Config implements ISchema
{
    protected $map;
    protected $container;

    public function __construct($map)
    {
        $this->map = $map;
    }


    public function generate($row, $parameters) //or $genertor
    {
        $map = $this->map['parameters'];
        $parameters[$map['name'][$row[RECORD]]] =  $map['name'][$row[RECORD]]; //inject form container
    }

    // function filter(Traversable $filter, Callable $callback = null, $flag = 0) {
    //     if ($callback === null) {
    //         $callback = 'notEmpty';
    //     }
    
    //     foreach ($filter as $key => $value) {
    //         switch($flag) {
    //             case ARRAY_FILTER_USE_KEY:
    //                 if ($callback($key)) {
    //                     yield $key => $value;
    //                 }
    //                 break;
    //             case ARRAY_FILTER_USE_BOTH:
    //                 if ($callback($value, $key)) {
    //                     yield $key => $value;
    //                 }
    //                 break;
    //             default:
    //                 if ($callback($value)) {
    //                     yield $key => $value;
    //                 }
    //                 break;
    //         }
    //     }
    // }
}





 
