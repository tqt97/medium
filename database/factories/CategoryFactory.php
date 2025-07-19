<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $name = $this->faker->name(),
            'slug' => str($name)->slug(),
            'description' => $this->faker->sentence(),
            'is_active' => $this->faker->boolean(),
            'parent_id' => null,
            'created_by' => null,
            'updated_by' => null,
        ];
    }
}
