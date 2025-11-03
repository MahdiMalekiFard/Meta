<?php

namespace App\Actions\Translation;

use App\Repositories\Translation\TranslationRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class SyncTranslationAction
{
    use AsAction;
    
    public function __construct(private readonly TranslationRepositoryInterface $repository)
    {
    }
    
    /**
     * @param                                                                  $model
     * @param array{locale:string,title:string,description:string,body:string} $payload
     *
     * @return mixed|void
     */
    public function handle($model, array $payload = [])
    {
        return DB::transaction(function () use ($model, $payload) {
            $locale = Arr::get($payload, 'locale', app()->getLocale());
            foreach ($model->translatable as $column) {
                $value = Arr::get($payload, $column, request()?->input($column));
                if (!empty($value)) {
                    $model->translations()->updateOrCreate([
                        'key'    => $column,
                        'locale' => $locale,
                    ], [
                        'value' => $value,
                    ]);
                    $translatedLanguages = $model->languages ?? [];
                    if (!in_array($locale, $translatedLanguages, true)) {
                        $translatedLanguages[] = $locale;
                        $model->update([
                            'languages' => $translatedLanguages,
                        ]);
                    }
                    $cacheName = generateCacheKey($model::class, $model->id, $column, $locale);
                    cache()->forget($cacheName);
                    cache()->rememberForever($cacheName, function () use ($column, $value) {
                        return $value;
                    });
                }
            }
        });
    }
}
