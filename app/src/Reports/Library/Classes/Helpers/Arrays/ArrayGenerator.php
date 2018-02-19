<?php

namespace App\Reports\Library\Classes\Helpers\Arrays;


class ArrayGenerator implements \IteratorAggregate {


    protected $array;




    public function __construct(array $array) {
        $this->array = $array;
    }




    public function getIterator() {
        foreach ($this->array as $key => $value) {
            yield $key => $value;
        }
    }
}