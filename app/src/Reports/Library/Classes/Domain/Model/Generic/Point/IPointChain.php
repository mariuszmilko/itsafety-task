<?php
namespace App\Reports\Library\Classes\Domain\Model\Generic\Point;

use App\Reports\Library\Classes\Domain\Model\Generic\Point\{IPointProcess, IPointUpate};



interface IPointChain extends IPointUpdate, IPointProcess
{
    public function chainParametersOnEnd(array &$parameters);
    public function chainParametersOnProcess(array &$parameters, $type, $rowname, $class);
}
