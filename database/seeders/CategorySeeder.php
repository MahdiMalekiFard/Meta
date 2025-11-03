<?php

namespace Database\Seeders;

use App\Enums\CategoryTypeEnum;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (CategoryTypeEnum::cases() as $categoryType) {
            Category::factory(10)->create([
                'type' => $categoryType,
            ])->each(function (Category $category) {
                if ($category->type === CategoryTypeEnum::SERVICE) {
                    $images = ['commercial', 'industrial', 'investment', 'land', 'residential'];
                    $imageUrl = "/images/property/" . fake()->randomElement($images) . ".jpg";
                    $category->addMediaFromUrl(loadPlaceHolder(100))->toMediaCollection('image');
                }
            });
        }
    }
}
