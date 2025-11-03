<?php

namespace App\Actions\Report;

use App\Models\Report;
use App\Repositories\Report\ReportRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreReportAction
{
    use AsAction;

    public function __construct(private readonly ReportRepositoryInterface $repository)
    {
    }

    public function handle(array $payload): Report
    {
        return DB::transaction(function () use ($payload) {
            return $this->repository->store($payload);
        });
    }
}
