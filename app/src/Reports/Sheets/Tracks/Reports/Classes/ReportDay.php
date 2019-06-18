<?php

namespace App\Reports\Sheets\Tracks\Reports\Classes;

use App\Reports\Library\Classes\Domain\Service\DeviceTrackService;
use App\Reports\Library\Classes\Service\IService;
use App\Reports\Library\Classes\Report\IReport;


/**
 * Class ReportDay
 * @package App\Reports\Sheets\Tracks\Reports\Classes
 */
class ReportDay implements IReport
{
    /**
     * @var IService
     */
    protected $service;
    /**
     * @var \Twig_Environment
     */
    protected $template;
    /**
     * @var array
     */
    protected $parameters = [];


    /**
     * ReportDay constructor.
     * @param IService $service
     * @param \Twig_Environment $template
     * @param array $parameters
     */
    public function __construct(IService $service, \Twig_Environment $template, array $parameters = [])
    {
        $this->service    = $service;
        $this->parameters = $parameters;
        $this->template   = $template;
    }


    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function generate(): string
    {
        $device   = $this->service->getDataByDay($this->parameters['deviceId'], $this->parameters['day']);
        $deviceId = $this->parameters['deviceId'];
        $day      = $this->parameters['day'];
        $summary  = $device->getSummary();

        return $this->template->render(
            'day.report',
            [
                'deviceId' => $deviceId,
                'day'      => $day,
                'device'   => $device,
                'summary'  => $summary
            ]
        );
    }
}