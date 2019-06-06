<?php

namespace App\Reports\Library\Parameters\Generic;


/**
 * Class Parameter
 * @package App\Reports\Library\Parameters\Generic
 */
abstract class Parameter
{
    /**
     * @var
     */
    protected $rowname;
    /**
     * @var
     */
    protected $name;


    /**
     * @param string $rowname
     * @return Parameter
     */
    public function setRowname(string $rowname): Parameter
    {
        $this->rowname = $rowname;

        return $this;
    }

    /**
     * @return string
     */
    public function getRowname(): string
    {
        return $this->rowname;
    }

    /**
     * @param string $name
     * @return Parameter
     */
    public function setName(string $name):  Parameter
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

}