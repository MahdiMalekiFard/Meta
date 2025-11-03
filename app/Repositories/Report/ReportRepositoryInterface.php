<?php

namespace App\Repositories\Report;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Report;

interface ReportRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Report;
}
