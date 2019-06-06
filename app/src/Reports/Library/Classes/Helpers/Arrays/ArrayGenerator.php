<?php

namespace App\Reports\Library\Classes\Helpers\Arrays;


/**
 * Class ArrayGenerator
 * @package App\Reports\Library\Classes\Helpers\Arrays
 */
class ArrayGenerator implements \IteratorAggregate
{

    /**
     * @var array
     */
    protected $array;


    /**
     * ArrayGenerator constructor.
     * @param array $array
     */
    public function __construct(array $array)
    {
        $this->array = $array;
    }

    /**
     * @return \Generator
     */
    public function getIterator(): \Generator
    {
        foreach($this->array as $key => $value)
        {
            yield $key => $value;
        }
    }
}