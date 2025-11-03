<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Blog::factory(1)->create([
            'user_id' => 1,
        ])->each(function (Blog $blog) {
            $imageUrl = "/images/property/single/".fake()->randomElement(range(1,5)).".jpg";
            $blog->addMediaFromUrl(loadPlaceHolder(100))->toMediaCollection('image');
            $blog->tags()->sync([1, 2, 3]);
            $blog->categories()->sync(fake()->randomElements(range(1, 10), 1));
        });
    }
}
