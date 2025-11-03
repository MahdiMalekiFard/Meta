<?php

namespace Database\Factories;

use App\Helpers\StringHelper;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    use GeneralFactoryFunctionsTrait;
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence;
        return [
            'slug'            => StringHelper::slug($title),
            'user_id'         => User::factory(),
            'published'       => true,
            'seo_title'       => StringHelper::slug($title),
            'seo_description' => fake()->sentence,
            'languages'       => [app()->getLocale()],
            'extra_attributes'       => [
                'reading_time'=>rand(5,10)
            ],
            'created_at' => now()->subDays(rand(1, 30)),
        ];
    }
    
    public function configure(): static
    {
        return $this->afterMaking(function (Blog $blog) {
            // ...
        })->afterCreating(function (Blog $blog) {
            $blog->translations()->createMany([
                [
                    'locale' => app()->getLocale(),
                    'key'    => 'title',
                    'value'  => $this->slugToText($blog->slug),
                ],
                [
                    'locale' => app()->getLocale(),
                    'key'    => 'description',
                    'value'  => fake()->sentence,
                ],
                [
                    'locale' => app()->getLocale(),
                    'key'    => 'body',
                    'value'  => fake()->realText(2000),
                ],
            ]);
        });
    }
    
}
