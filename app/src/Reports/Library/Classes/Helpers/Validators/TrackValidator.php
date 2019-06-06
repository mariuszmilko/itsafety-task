<?php

namespace App\Reports\Library\Classes\Helpers\Validators;

use App\Reports\Library\Classes\Domain\Model\Generic\Point\
{
    IPoint, IPointProcess
};
use App\Reports\Library\Classes\Helpers\Generic\IValidLength;


/**
 * Class TrackValidator
 * @package App\Reports\Library\Classes\Helpers\Validators
 */
class TrackValidator implements IValidLength
{
    /**
     *
     */
    const NOTRACK = 1;

    /**
     * @param bool $end
     * @param IPoint $current
     * @param IPoint|null $previous
     * @return bool
     */
    public function isCompleteTrack(bool $end, IPoint $current, IPoint $previous = null): bool
    {
        return ($end && $this->isValidLength() || $this->isEndTrack($previous, $current) && $this->isValidLength());
    }


    /**
     * @param IPointProcess $current
     * @param IPointProcess|null $previous
     * @return bool
     */
    public function isEndTrack(IPointProcess $current, IPointProcess $previous = null): bool
    {
        return (isset($previous) && $current->delimiter() != $previous->delimiter());
    }


    /**
     * @param IPoint|null $previous
     * @return bool
     */
    public function isFirstTrack(IPoint $previous = null): bool
    {
        return (!isset($previous));
    }


    /**
     * @param int $length
     * @return bool
     */
    public function isValidLength(int $length = 0): bool
    {
        return !($length == self::NOTRACK);
    }
}