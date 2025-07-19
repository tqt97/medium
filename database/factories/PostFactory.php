<?php

namespace Database\Factories;

use App\Enum\PostStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'slug' => $this->faker->slug(),
            'content' => $this->faker->paragraph(),
            'is_published' => $this->faker->boolean(),
            'category_id' => null,
            'user_id' => null,
            'created_by' => null,
            'updated_by' => null,
            'featured_image' => null,
            'excerpt' => $this->faker->sentence(),
            'is_active' => true,
            'status' => $this->faker->randomElement(PostStatus::cases()),
            'view_count' => 0,
            'comment_count' => 0,
            'meta_title' => $this->faker->sentence(),
            'meta_description' => $this->faker->paragraph(),
            'meta_keywords' => $this->faker->words(3, true),
            'published_at' => null,
        ];
    }
}
