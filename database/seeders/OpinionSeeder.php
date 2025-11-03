<?php

namespace Database\Seeders;

use App\Models\Opinion;
use Illuminate\Database\Seeder;

class OpinionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Opinion::factory(4)->create()->each(function (Opinion $opinion, int $key) {
            ++$key;
            $imageUrl = "/images/client/0$key.jpg";
            $opinion->addMediaFromUrl(loadPlaceHolder(100))->toMediaCollection('image');
        });
    }
}
