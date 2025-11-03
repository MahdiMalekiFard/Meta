<?php

namespace Database\Seeders;

use App\Enums\OpinionPartEnum;
use App\Models\Faq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (OpinionPartEnum::cases() as $case) {
            Faq::factory(10)->create([
                'part' => $case->value,
            ]);
        }
      
    }
}
