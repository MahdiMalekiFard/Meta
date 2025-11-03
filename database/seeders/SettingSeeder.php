<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Enums\SettingEnum;
use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (SettingEnum::cases() as $case) {
            $setting = Setting::where('key', $case->value)->first();
            if ($setting) {
                $setting->help = $case->help();
                $setting->roles = [RoleEnum::ADMIN->value];
                foreach ($case->extra() as $key => $value) {
                    if (!isset($setting->extra_attributes[$key])) {
                        $setting->extra_attributes[$key] = $value;
                    }
                }
                $setting->save();
            } else {
                Setting::create([
                    'key'              => $case->value,
                    'value'            => $case->defaultValue(),
                    'help'             => $case->help(),
                    'roles'            => [RoleEnum::ADMIN->value],
                    'extra_attributes' => $case->extra(),
                ]);
            }
        }
    }
}
