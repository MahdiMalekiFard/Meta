<?php

namespace Database\Seeders;

use App\Enums\PlanTypeEnum;
use App\Models\Module;
use App\Models\Plan;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('plans')->delete();
        DB::table('orders')->delete();
        DB::table('services')->delete();
        
        $services = [
            [
                'key'         => 'CRM',
                'title'       => 'مدیریت مشتریان',
                'description' => 'مدیریت مشتریان',
            ],
            [
                'key'         => 'HRM',
                'title'       => 'مدیریت منابع انسانی',
                'description' => 'مدیریت منابع انسانی',
            ],
            [
                'key'         => 'SHOP',
                'title'       => 'فروشگاه اینترنتی',
                'description' => 'فروشگاه اینترنتی',
            ],
            [
                'key'         => 'ACCOUNTING',
                'title'       => 'حسابداری',
                'description' => 'حسابداری',
            ],
        ];
        
        foreach ($services as $row) {
            Service::factory(1)->create(Arr::only($row,'key'))->each(function (Service $service) use ($row) {
                $service->translations()->updateOrCreate([
                    'locale' => app()->getLocale(),
                    'key'    => 'title',
                ],['value'  => $row['title'],]);
                $service->translations()->updateOrCreate([
                    'locale' => app()->getLocale(),
                    'key'    => 'description',
                ],['value'  => $row['description'],]);
                
                $imageUrl = config('app.url')."images/services/".$row['key'] .".png";
                $service->addMediaFromUrl($imageUrl)->toMediaCollection('image');
                
                
                foreach (Module::inRandomOrder()->limit(3)->pluck('id') as $item) {
                    foreach (PlanTypeEnum::values() as $value) {
                        $service->modules()->attach($item, [
                            'plan_type' => $value,
                            'order'     => 1,
                            'limit'     => 1,
                        ]);
                    }
                }
            });
        }
    }
}
