<?php

namespace App\Reports\Library\Classes\Domain\Model;

use App\Reports\Library\Classes\Domain\Model\Generic\Point\IPoint;
use App\Reports\Library\Classes\Factory\Generic\
{
    IFactoryTrack, IFactoryData, IFactoryAggregator
};
use App\Reports\Library\Classes\Helpers\Validators\TrackValidator;
use App\Reports\Library\Classes\Helpers\Arrays\ArrayGenerator;
use Generator;


/**
 * Class TrackGenerator
 * @package App\Reports\Library\Classes\Domain\Model
 */
final class TrackGenerator implements \IteratorAggregate
{
    /**
     * @var IPoint
     */
    private $current;
    /**
     * @var IPoint
     */
    private $previous;
    /**
     * @var Track
     */
    private $track;
    /**
     * @var array
     */
    private $tracks = [];
    /**
     * @var \Generator
     */
    private $stream;
    /**
     * @var IFactoryData
     */
    private $factoryPoint;
    /**
     * @var IFactoryTrack
     */
    private $factoryTrack;
    /**
     * @var TrackValidator
     */
    private $trackValidator;
    /**
     * @var
     */
    private $parameterAggregator;


    /**
     * TrackGenerator constructor.
     * @param IFactoryData $factoryPoint
     * @param IFactoryTrack $factoryTrack
     * @param IFactoryAggregator $factoryAggregator
     * @param TrackValidator $trackValidator
     */
    public function __construct(
        IFactoryData $factoryPoint, IFactoryTrack $factoryTrack, IFactoryAggregator $factoryAggregator, TrackValidator $trackValidator
    )
    {
        $this->factoryPoint        = $factoryPoint;
        $this->factoryTrack        = $factoryTrack;
        $this->parameterAggregator = $factoryAggregator->factory();
        $this->trackValidator      = $trackValidator;
    }


    /**
     * @param bool $end
     * @param callable|null $response
     * @return TrackGenerator
     */
    public function completeTrack(bool $end, callable $response = null): TrackGenerator
    {
        if($this->trackValidator->isCompleteTrack($end, $this->current, $this->previous))
        {
            !($this->track->updateOnEnd($this->current)->isValidLength($this->trackValidator)) ?: $this->addTrack();
            $this->track = $this->factoryTrack->factory($this->current);
            $this->track->processPoint($this->current);
        }

        return $this;
    }


    /**
     * @param callable|null $response
     * @return TrackGenerator
     */
    public function aggregate(callable $response = null): TrackGenerator
    {
        if(count($this->tracks) > 0)
        {
            $last = $this->tracks[count($this->tracks) - 1];
            $this->parameterAggregator->extractParameters($last);
            !is_callable($response) ?: $response($last);
        }

        return $this;
    }


    /**
     * @param callable|null $response
     * @return TrackGenerator
     */
    public function multiAggregator(callable $response = null): TrackGenerator
    {
        !is_callable($response) ?: $response($this->parameterAggregator);

        return $this;
    }


    /**
     * @param callable|null $response
     * @return TrackGenerator
     */
    public function addTrack(callable $response = null): TrackGenerator
    {
        $this->tracks[] = $this->track;

        return $this;
    }


    /**
     * @param callable|null $response
     * @return TrackGenerator
     */
    public function beginTrack(callable $response = null): TrackGenerator
    {
        if($this->trackValidator->isFirstTrack($this->previous))
        {
            $this->track = $this->factoryTrack->factory($this->current);
        }

        return $this;
    }


    /**
     * @param IPoint $point
     * @param callable|null $response
     * @return TrackGenerator
     */
    public function setCurrentPoint(IPoint $point, callable $response = null): TrackGenerator
    {
        $this->current = $point;

        return $this;
    }


    /**
     * @param callable|null $response
     * @return TrackGenerator
     */
    public function setPreviousPoint(callable $response = null): TrackGenerator
    {
        $this->previous = $this->current;

        return $this;
    }


    /**
     * @param Generator $xData
     * @param callable|null $response
     * @return TrackGenerator
     */
    public function stream(\Generator $xData, callable $response = null): TrackGenerator
    {
        $this->stream = $xData;

        return $this;
    }


    /**
     * @param callable|null $response
     * @return TrackGenerator
     */
    public function isEndStream(callable $response = null): TrackGenerator
    {
        if(!$this->stream->valid())
        {
            $this->completeTrack(true);
        }

        return $this;
    }


    /**
     * @param callable|null $response
     * @return TrackGenerator
     */
    public function beginProcess(callable $response = null): TrackGenerator
    {
        $data = $this->stream->current();
        $this->setCurrentPoint($this->factoryPoint->factory($data));

        return $this;
    }


    /**
     * @param callable|null $response
     * @return TrackGenerator
     */
    public function processing(callable $response = null): TrackGenerator
    {
        (!$this->trackValidator->isEndTrack($this->current, $this->previous)) ?
            $this->track->processPoint($this->current) :
            $this->completeTrack(false);

        return $this;
    }


    /**
     * @param callable|null $response
     * @return TrackGenerator
     */
    public function next(callable $response = null): TrackGenerator
    {
        $this->stream->next();

        return $this;
    }


    /**
     * @param callable|null $response
     * @return TrackGenerator
     */
    private function rewind(callable $response = null): TrackGenerator
    {
        $this->current = $this->previous;

        return $this;
    }


    /**
     * @return \IteratorAggregate
     */
    public function getIterator(): \IteratorAggregate
    {
        return new ArrayGenerator($this->tracks);
    }
}