<?php

namespace Database\Seeders;

use App\Enums\PlanMonthEnum;
use App\Enums\PlanTypeEnum;
use App\Models\Plan;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Service::get() as $service) {
            Plan::factory()->create([
                'planable_id'   => $service->id,
                'planable_type' => Service::class,
            ])->each(function (Plan $plan) {
                foreach (PlanMonthEnum::values() as $month) {
                    foreach (PlanTypeEnum::values() as $type) {
                        $plan->pricings()->create([
                            'price'    => 1000000,
                            'price_special' => 1000000,
                            'month'    => $month,
                            'type'     => $type,
                        ]);
                    }
                }
            });
        }
    }
}
