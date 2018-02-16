<?php
namespace App\Reports\Library\Classes\Helpers\Validators;

use App\Reports\Library\Classes\Domain\Model\Generic\Point\{IPoint, IPointProcess};
use App\Reports\Library\Classes\Helpers\Generic\IValidLength;




class TrackValidator implements IValidLength
{


    const NOTRACK = 1;


    

    public function isCompleteTrack(bool $end, IPoint $current, IPoint $previous = null)
    { 
 
        return ($end && $this->isValidLength() || $this->isEndTrack($previous, $current) && $this->isValidLength());
    }
 
 
 
 
    public function isEndTrack(IPointProcess $current, IPointProcess $previous = null)
    { 
 
        return (isset($previous) && $current->delimiter() != $previous->delimiter());
    }
 
 
 
 
    public function isFirstTrack(IPoint $previous = null)
    {
 
        return (!isset($previous));
    }
 
 
 
 
    public function isValidLength($length = 0)
    {
        return !($length == self::NOTRACK);
    }
}