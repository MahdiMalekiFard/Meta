<?php

namespace App\Actions\Setting;

use App\Enums\PermissionEnum;
use App\Models\Setting;
use App\Repositories\Setting\SettingRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateSettingAction
{
    use AsAction;
    
    public function __construct(private readonly SettingRepositoryInterface $repository)
    {
    }
    
    /**
     * @param Setting                                       $setting
     * @param array{name:string,mobile:string,email:string} $payload
     *
     * @return Setting
     */
    public function handle(Setting $setting, array $payload): Setting
    {
        return DB::transaction(function () use ($setting, $payload) {
            
            if (Arr::has($payload, 'value')) {
                $setting->value = Arr::get($payload, 'value');
            }
            
            if (Arr::has($payload, 'extra_attributes')) {
                foreach (Arr::get($payload, 'extra_attributes') as $item) {
                    $setting->extra_attributes->set($item['name'], $item['value']);
                }
            }
            $setting->save();
            
            $cache_unique_key = 'setting:' . $setting->key;
            cache()->forget($cache_unique_key);
            cache()->forever($cache_unique_key, $setting);
            return $setting;
        });
    }
}
