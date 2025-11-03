<?php

namespace App\Actions\ReportReason;

use App\Actions\Translation\SyncTranslationAction;
use App\Models\ReportReason;
use App\Repositories\ReportReason\ReportReasonRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreReportReasonAction
{
    use AsAction;

    public function __construct(private readonly ReportReasonRepositoryInterface $repository)
    {
    }

    public function handle(array $payload): ReportReason
    {
        return DB::transaction(function () use ($payload) {
            $model = $this->repository->store($payload);
            SyncTranslationAction::run($model);
            return $model;
        });
    }
}
