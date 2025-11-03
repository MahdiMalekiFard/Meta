<?php

namespace Database\Seeders;

use App\Actions\Translation\SyncTranslationAction;
use App\Enums\ModuleEnum;
use App\Models\Module;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (ModuleEnum::cases() as $case) {
            $module = Module::firstOrCreate([
                'key'   => $case->value,
            ]);
            
            SyncTranslationAction::run($module, [
                'locale' => 'fa',
                'title'  => $case->title(),
            ]);
        }
    }
}
