<?php

namespace App\Actions\Report;

use App\Enums\PermissionEnum;
use App\Models\Report;
use App\Repositories\Report\ReportRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateReportAction
{
    use AsAction;

    public function __construct(private readonly ReportRepositoryInterface $repository)
    {
    }


    /**
     * @param Report                                          $report
     * @param array{name:string,mobile:string,email:string} $payload
     * @return Report
     */
    public function handle(Report $report, array $payload): Report
    {
        return DB::transaction(function () use ($report, $payload) {
            $report->update($payload);
            return $report;
        });
    }
}
