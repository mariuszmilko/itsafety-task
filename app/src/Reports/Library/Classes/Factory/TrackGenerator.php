<?php

namespace App\Reports\Library\Classes\Factory;


use App\Reports\Library\Classes\Domain\Model\TrackGenerator as TrackGeneratorModel;
use App\Reports\Library\Classes\Factory\Generic\
{
    IFactoryAggregator, IFactoryData, IFactoryPoint, IFactoryTrack
};
use App\Reports\Library\Classes\Helpers\Validators\TrackValidator;


/**
 * Class TrackGenerator
 * @package App\Reports\Library\Classes\Factory
 */
final class TrackGenerator implements IFactoryAggregator
{
    /**
     * @var IFactoryData
     */
    private $factoryPoint;
    /**
     * @var IFactoryPoint
     */
    private $factoryTrack;
    /**
     * @var IFactoryAggregator
     */
    private $factoryAggregator;
    /**
     * @var TrackValidator
     */
    private $trackValidator;


    /**
     * TrackGenerator constructor.
     * @param IFactoryData $factoryPoint
     * @param IFactoryTrack $factoryTrack
     * @param IFactoryAggregator $factoryAggregator
     * @param TrackValidator $trackValidator
     */
    public function __construct(IFactoryData $factoryPoint, IFactoryTrack $factoryTrack, IFactoryAggregator $factoryAggregator, TrackValidator $trackValidator)
    {
        $this->factoryPoint      = $factoryPoint;
        $this->factoryTrack      = $factoryTrack;
        $this->factoryAggregator = $factoryAggregator;
        $this->trackValidator    = $trackValidator;
    }

    /**
     * @return TrackGeneratorModel
     */
    public function factory(): TrackGeneratorModel
    {
        return new TrackGeneratorModel($this->factoryPoint, $this->factoryTrack, $this->factoryAggregator, $this->trackValidator);
    }
}