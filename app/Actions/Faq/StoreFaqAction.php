<?php

namespace App\Actions\Faq;

use App\Actions\Translation\SyncTranslationAction;
use App\Models\Faq;
use App\Repositories\Faq\FaqRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreFaqAction
{
    use AsAction;

    public function __construct(private readonly FaqRepositoryInterface $repository)
    {
    }

    public function handle(array $payload): Faq
    {
        return DB::transaction(function () use ($payload) {
            $model = $this->repository->store($payload);
            SyncTranslationAction::run($model);
            return $model;
        });
    }
}
