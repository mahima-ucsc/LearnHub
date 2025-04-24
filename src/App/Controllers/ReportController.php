<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\ReportService;
use Framework\TemplateEngine;

class ReportController
{
    public function __construct(
        private TemplateEngine $view,
        private ReportService  $reportService
    ) {}


    public function getTeacherReport(array $params)
    {
        $this->reportService->generateReportForTeacher('2020-01-01', '2027-12-31', (string) $_SESSION['user']);
    }
}
