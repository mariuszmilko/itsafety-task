<?php
namespace App\Reports\Library\Classes\Domain\Model\Generic\Point;

use App\Reports\Library\Classes\Domain\Model\Generic\Point\{IPointProcess};



interface IPointChainOnProcess extends IPointProcess
{
    public function chainParametersOnProcess(array &$parameters, $type, $rowname, $class);
}