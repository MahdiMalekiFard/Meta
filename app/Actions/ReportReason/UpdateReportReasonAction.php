<?php

namespace App\Actions\ReportReason;

use App\Actions\Translation\SyncTranslationAction;
use App\Enums\PermissionEnum;
use App\Models\ReportReason;
use App\Repositories\ReportReason\ReportReasonRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateReportReasonAction
{
    use AsAction;

    public function __construct(private readonly ReportReasonRepositoryInterface $repository)
    {
    }


    /**
     * @param ReportReason                                          $reportReason
     * @param array{name:string,mobile:string,email:string} $payload
     * @return ReportReason
     */
    public function handle(ReportReason $reportReason, array $payload): ReportReason
    {
        return DB::transaction(function () use ($reportReason, $payload) {
            $reportReason->update($payload);
            SyncTranslationAction::run($reportReason);
            return $reportReason;
        });
    }
}
