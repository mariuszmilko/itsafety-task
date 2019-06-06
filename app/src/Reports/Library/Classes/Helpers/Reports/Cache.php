<?php

namespace App\Reports\Library\Classes\Helpers\Reports;

use App\Reports\Library\Classes\Report\IReport;

/**
 * Class Cache
 * @package App\Reports\Library\Classes\Helpers\Reports
 */
class Cache implements IReport
{
    /**
     * @var IReport
     */
    protected $report;
    /**
     * @var
     */
    protected $result;
    /**
     * @var bool
     */
    protected $debug;


    /**
     * Cache constructor.
     * @param IReport $report
     * @param bool $debug
     */
    public function __construct(IReport $report, $debug = false)
    {
        $this->report = $report;
        $this->debug  = $debug;
    }

    /**
     * @return string
     */
    public function generate(): string
    {
        $this->result = $this->result ?: $this->report->generate();

        return $this->result;
    }
}