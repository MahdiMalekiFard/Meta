<?php

namespace App\Actions\Report;

use App\Models\Report;
use App\Repositories\Report\ReportRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteReportAction
{
    use AsAction;

    public function __construct(public readonly ReportRepositoryInterface $repository)
    {
    }

    public function handle(Report $report): bool
    {
        return DB::transaction(function () use ($report) {
            return $this->repository->delete($report);
        });
    }
}
