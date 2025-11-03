<?php

namespace App\Repositories\Translation;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Translation;

interface TranslationRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Translation;
}
