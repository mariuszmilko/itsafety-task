<?php
namespace App\Reports\Library\Classes\Domain\Model\Generic\Point;

use App\Reports\Library\Classes\Domain\Model\Generic\Point\{IPointUpate};



interface IPointChainOnUpdate extends IPointUpdate
{
    public function chainParametersOnUpdate(array &$parameters);
}
