<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $blog=Blog::factory()->create();
        return [
            'user_id'=>User::factory()->create(),
            'commentable_id'=>$blog->id,
            'commentable_type'=>Blog::class,
            'parent_id'=>null
        ];
    }
    public function configure(): static
    {
        return $this->afterMaking(function (Comment $comment) {
            // ...
        })->afterCreating(function (Comment $comment) {
            $comment->translations()->createMany([
                [
                    'locale' => app()->getLocale(),
                    'key'    => 'title',
                    'value'  => fake()->word,
                ],
                [
                    'locale' => app()->getLocale(),
                    'key'    => 'description',
                    'value'  => fake()->text,
                ],
            ]);
        });
    }
}
