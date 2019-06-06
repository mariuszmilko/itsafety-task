<?php
/**
 * Created by PhpStorm.
 * User: mariuszmilko
 * Date: 06.06.2019
 * Time: 19:40
 */

namespace App\Reports\Library\Classes\Factory\Generic;

use App\Reports\Library\Classes\Domain\Model\Generic\Point\IPoint;
use App\Reports\Library\Classes\Domain\Model\Generic\Track\IType;

interface IFactoryTrack
{
    public function factory(IPoint $point): IType;
}