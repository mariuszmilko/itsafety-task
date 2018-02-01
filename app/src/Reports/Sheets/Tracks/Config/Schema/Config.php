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


    public function generate($row, $parameters)
    {
        $map = $this->map['parameters'];
        $parameters[$map['name'][$row[RECORD]]] =  $map['name'][$row[RECORD]]; //inject form container
    }
}





 
