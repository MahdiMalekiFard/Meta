<?php

namespace App\Actions\Translation;

use App\Repositories\Translation\TranslationRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class MergeTranslationAction
{
    use AsAction;
    
    public function __construct(private readonly TranslationRepositoryInterface $repository)
    {
    }
    
    public function handle($model, array $payload)
    {
        $locale = Arr::get($payload,'locale',app()->getLocale());
        
        request()?->merge([
            'translation'=>[
                $locale=>[
                    [
                        'key'=>'title',
                        'value'=>$payload['title']
                    ],
                    [
                        'key'=>'description',
                        'value'=>$payload['description']
                    ],
                    [
                        'key'=>'body',
                        'value'=>$payload['body']
                    ],
                ]
            ]
        ]);
    }
}
