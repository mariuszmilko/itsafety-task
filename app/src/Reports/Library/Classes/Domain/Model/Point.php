<?php

namespace App\Reports\Library\Classes\Domain\Model;

use stdClass;
use App\Reports\Library\Parameters\Generic\
{
    IParameterAgg, IParameterFilter
};
use App\Reports\Library\Classes\Domain\Model\Generic\Point\
{
    IPointProcess, IPointData
};

/**
 *  Elementary part of track
 */
class Point implements IPointProcess, IPointData
{
    /** @var int Should contain a description if available */
    protected $delimiter;

    /** @var array Should contain a description if available */
    protected $data;


    /**
     * This method sets a description.
     *
     * @param array $description A text with a maximum of 80 characters.
     * @param int $description A text with a maximum of 80 characters.
     *
     * @constructor
     */
    public function __construct(array $data, int $delimiter)
    {
        $this->data      = $data;
        $this->delimiter = $delimiter;
    }


    /**
     * This method sets a description.
     *
     * @param string $description A text with a maximum of 80 characters.
     *
     * @throws Exception
     * @return string
     */
    public function delimiter(): string
    {
        if(!isset($this->delimiter))
        {
            throw new Exception('Brak delimitera Point'); //dla ułatwienia później słownik
        }

        return $this->delimiter;
    }


    /**
     * This method sets a description.
     *
     * @param string $description A text with a maximum of 80 characters.
     *
     * @return string
     */
    public function getField(string $field): string
    {
        return $this->data[$field];
    }


    /**
     * This method sets a description.
     *
     * @param string $description A text with a maximum of 80 characters.
     *
     * @return string
     */
    public function getData(): string
    {
        return $this->data;
    }
}