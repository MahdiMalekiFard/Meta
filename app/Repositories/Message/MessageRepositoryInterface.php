<?php

namespace App\Repositories\Message;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Message;

interface MessageRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Message;
}
