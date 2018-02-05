<?php

namespace App\Reports\Library\Classes\Helpers\Mappers;


class Mapper 
{



    
    public function __construct($map, $aggIterator, $filterIterator)
    {

    }
     /**
     * Returns an iterator over the elements in the buffer.
     *
     * The order is the order of insertion (FIFO)
     *
     * @return MapperIterator Iterator over the buffer elements
     */
    public function getIterator()
    {
        return new \ArrayIterator(
            $this->buffer,
            $this->getLeastRecentPosition(),
            $this->size
        );
    }
}