<?php

namespace NW\WebService\Operations\Notifications\MessageHandlers\Reports;

class Reports implements ReportInterface
{
    /**
     * @var Report[]
     */
    public array $reports = [];

    /**
     * @return array
     */
    public function toArray(): array
    {
        $output = [];
        foreach ($this->reports as $report) {
            $output[] = $report->toArray();
        }

        return $output;
    }

    /**
     * @return Report[]
     */
    public function getReports(): array
    {
        return $this->reports;
    }

    public function addReport(Report $report): void
    {
        $this->reports[] = $report;
    }

}
