<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Banner::factory(2)->create()->each(function (Banner $banner,$index) {
            ++$index;
            $imageUrl = "/images/bg/0$index.jpg";
            $banner->addMediaFromUrl(loadPlaceHolder(100))->toMediaCollection('image');
        });
    }
}
