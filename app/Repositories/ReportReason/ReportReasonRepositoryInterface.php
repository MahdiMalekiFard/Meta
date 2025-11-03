<?php

namespace App\Repositories\ReportReason;

use App\Repositories\BaseRepositoryInterface;
use App\Models\ReportReason;

interface ReportReasonRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): ReportReason;
}
