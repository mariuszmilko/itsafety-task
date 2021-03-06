<?php

namespace App\Reports\Library\Classes\Iterators;

use Iterator;
use SplFixedArray;
use SeekableIterator;

class AggregateIterator implements SeekableIterator
{
    /**
     * The iterator's position
     *
     * @var int
     */
    private $position = 0;
    /**
     * The offset in the SplFixedArray of position in relation to the real start index
     *
     * @var int
     */
    private $offset;
    /**
     * The number of elements in the buffer
     *
     * All $position values < $maxPosition are valid
     *
     * @var int
     */
    private $maxPosition;
    /**
     * The actual array of elements (internal representation of the buffer)
     *
     * @var SplFixedArray
     */
    private $buffer;
    /**
     * The size of the fixed array
     *
     * It's saved in a private property to reduce calls to SplFixedArray::getSize
     *
     * @var int
     */
    private $bufferSize;

    /**
     * Creates the iterator with the buffers current internal state
     *
     * @param SplFixedArray $buffer The internal state of the buffer
     * @param int $startPosition is position of the first value in $buffer
     * @param int $size is the number of elements in the buffer
     */
    public function __construct($aggregates, $startPosition, $size)
    {
        $this->offset      = $startPosition;
        $this->aggregates  = $aggregates;
        $this->maxPosition = $size;
        //   $this->bufferSize = $buffer->getSize();
    }

    /**
     * Iterator::next implementation
     */
    public function next()
    {
        $this->position++;
    }

    /**
     * Iterator::current implementation
     *
     * offset + position needs to be modulo'd with bufferSize to wrap around the FixedArray end
     *
     * @return mixed
     */
    public function current()
    {
        $realPosition = ($this->offset + $this->position) % $this->bufferSize;
        return $this->buffer[$realPosition];
    }

    /**
     * Iterator::key implementation
     *
     * The raw position is returned to not hint on buffer's internal implementation details
     *
     * @return int
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * Iterator::valid implementation
     *
     * @return bool
     */
    public function valid()
    {
        return $this->position < $this->maxPosition;
    }

    /**
     * Iterator::rewind implementation
     */
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * SeekableIterator::seek implementation
     * @param int  seek exist position
     */
    public function seek($position)
    {
        if(!isset($this->array[$position]))
        {
            throw new OutOfBoundsException("Błędna pozycja ($position)");
        }

        $this->position = $position;
    }
}