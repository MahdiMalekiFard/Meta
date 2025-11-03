<?php

namespace App\Actions\ReportReason;

use App\Models\ReportReason;
use App\Repositories\ReportReason\ReportReasonRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteReportReasonAction
{
    use AsAction;

    public function __construct(public readonly ReportReasonRepositoryInterface $repository)
    {
    }

    public function handle(ReportReason $reportReason): bool
    {
        return DB::transaction(function () use ($reportReason) {
            return $this->repository->delete($reportReason);
        });
    }
}
