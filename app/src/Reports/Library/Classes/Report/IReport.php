<?php

namespace App\Reports\Library\Classes\Report;


interface IReport
{
    public function generate(): string;
}