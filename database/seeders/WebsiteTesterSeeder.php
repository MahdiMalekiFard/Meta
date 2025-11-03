<?php

namespace Database\Seeders;

use App\Enums\CategoryTypeEnum;
use App\Models\Category;
use Illuminate\Database\Seeder;

class WebsiteTesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //add service category seeder
        $images = ['commercial', 'industrial', 'investment', 'land', 'residential'];
        Category::factory(count($images))->create([
            'type' => CategoryTypeEnum::SERVICE,
        ])->each(function (Category $category, int $index) use ($images) {
            $imageUrl = "/images/property/" . $images[$index] . ".jpg";
            $category->addMediaFromUrl(loadPlaceHolder(100))->toMediaCollection('image');
            $category->translations()->updateOrCreate([
                'locale' => app()->getLocale(),
                'key'    => 'title',
            ], [
                'value' => $images[$index],
            ]);
            $category->slug = $images[$index];
            $category->save();
        });
        
    }
}
