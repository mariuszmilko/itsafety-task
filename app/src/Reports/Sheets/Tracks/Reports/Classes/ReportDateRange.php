<?php

namespace App\Reports\Sheets\Tracks\Reports\Classes;

use App\Reports\Library\Classes\Domain\Service\DeviceTrackService;
use App\Reports\Library\Classes\Service\IService;
use App\Reports\Library\Classes\Report\IReport;


/**
 * Class ReportDateRange
 * @package App\Reports\Sheets\Tracks\Reports\Classes
 */
class ReportDateRange implements IReport
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
     * ReportDateRange constructor.
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
        $device = $this->service->getDataByDate(
            $this->parameters['deviceId'], $this->parameters['dateFrom'], $this->parameters['dateTo']
        );

        $deviceId = $this->parameters['deviceId'];
        $dateFrom = $this->parameters['dateFrom'];
        $dateTo   = $this->parameters['dateTo'];
        $summary  = $device->getSummary();

        return $this->template->render(
            'daterange.report',
            [
                'deviceId' => $deviceId,
                'dateFrom' => $dateFrom,
                'dateTo'   => $dateTo,
                'device'   => $device,
                'summary'  => $summary
            ]
        );
    }
}