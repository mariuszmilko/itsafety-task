<?php

namespace App\Reports\Library\Classes\Domain\Model;

use Generator;
use App\Reports\Library\Classes\Domain\Model\Generic\Device\IDevice;


/**
 * Class Device
 * @package App\Reports\Library\Classes\Domain\Model
 */
class Device implements IDevice, \IteratorAggregate
{
    /**
     * @var int
     */
    protected $deviceId;
    /**
     * @var array
     */
    protected $tracks;
    /**
     * @var \Generator
     */
    protected $xData;
    /**
     * @var TrackGenerator
     */
    protected $trackGen;
    /**
     * @var
     */
    protected $summaryTracks;


    /**
     * Device constructor.
     * @param int $deviceId
     * @param Generator $xData
     * @param TrackGenerator $trackGen
     */
    public function __construct(int $deviceId, Generator $xData, TrackGenerator $trackGen)
    {
        $this->deviceId = $deviceId;
        $this->xData    = $xData;
        $this->trackGen = $trackGen;
    }


    /**
     *
     */
    public function processTracks(): void
    {
        while($this->xData->valid())
        {
            $this->trackGen->stream($this->xData)
                ->beginProcess()
                ->beginTrack()
                ->processing()
                ->setPreviousPoint()
                ->next()
                ->isEndStream()
                ->aggregate();
        }
    }


    /**
     * @return array
     */
    public function getSummary(): array
    {
        $this->trackGen->multiAggregator(function($mAgg) {
            $this->summaryTracks = $mAgg;
        });

        return $this->summaryTracks;
    }


    /**
     * @return \IteratorAggregate
     */
    public function getIterator(): \IteratorAggregate
    {
        return $this->trackGen->getIterator();
    }
}