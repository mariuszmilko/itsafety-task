<?php
namespace App\Reports\Library\Classes\Helpers\Validators;

use App\Reports\Library\Classes\Domain\Model\Generic\Point\{IPoint, IPointProcess};




class TrackValidator
{

    const NOTRACK = 1;


    public function isCompleteTrack(bool $end, IPoint $current, IPoint $previous = null)
    { 
 
        return ($end && $this->isMinLength() || $this->isEndTrack($previous, $current) && $this->isMinLength());
    }
 
 
 
 
    public function isEndTrack(IPointProcess $current, IPointProcess $previous = null)
    { 
 
        return (isset($previous) && $current->delimiter() != $previous->delimiter());
    }
 
 
 
 
    public function isFirstTrack(IPoint $previous = null)
    {
 
        return (!isset($previous));
    }
 
 
 
 
    public function isMinLength($length = 0)
    {
        return !($length == self::NOTRACK);
    }
}