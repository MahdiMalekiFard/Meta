<?php

namespace App\Actions\Translation;

use App\Repositories\Translation\TranslationRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class GetTranslationAction
{
    use AsAction;
    
    public function __construct(private readonly TranslationRepositoryInterface $repository)
    {
    }
    
    public function handle($model, array $payload)
    {
        return DB::transaction(function () use ($model, $payload) {
            foreach (request()?->input('translation', []) as $locale => $values) {
                foreach ($values as $item) {
                    $model->translations()->create([
                        'key'    => $item['key'],
                        'value'  => $item['value'],
                        'locale' => $locale,
                    ]);
                }
            }
        });
    }
}
