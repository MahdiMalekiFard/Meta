<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /** Seed the application's database. */
    public function run(): void
    {
        $this->call([
//            SettingSeeder::class,
//            BannerSeeder::class,
//            TagSeeder::class,
//            CategorySeeder::class,
RolePermissionSeeder::class,
//            CountrySeeder::class,
//            ProvinceSeeder::class,
//            CitySeeder::class,
//            FaqSeeder::class,
UserSeeder::class,
//            BlogSeeder::class,
//            ReportReasonSeeder::class,

//            OpinionSeeder::class,
ModuleSeeder::class,
ServiceSeeder::class,
PlanSeeder::class,
//            ReportSeeder::class,
        ]);
        
        \Artisan::call('optimize:clear');
    }
}
