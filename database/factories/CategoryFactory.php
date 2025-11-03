<?php

namespace Database\Factories;

use App\Enums\CategoryTypeEnum;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
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
        $this->addTitleToRequest($title);
        
        return [
            'type'            => CategoryTypeEnum::BLOG->value,
            'slug'            => $this->faker->slug,
            'published'       => true,
            'seo_title'       => $title,
            'seo_description' => $this->faker->sentence,
            'seo_keywords'    => $this->faker->words(3, true),
        ];
    }
    
    public function configure(): static
    {
        return $this->afterCreating(function (Category $category) {
            $category->translations()->createMany([
                [
                    'locale' => app()->getLocale(),
                    'key'    => 'title',
                    'value'  => $this->slugToText($category->slug),
                ],
                [
                    'locale' => app()->getLocale(),
                    'key'    => 'body',
                    'value'  => $this->faker->realText,
                ],
            ]);
        });
    }
}
