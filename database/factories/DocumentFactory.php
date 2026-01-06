<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Document>
 */
class DocumentFactory extends Factory
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
            'category' => $this->faker->word(),
            'description' => $this->faker->paragraph(),
            'is_published' => $this->faker->boolean(),
            'published_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'download_count' => $this->faker->numberBetween(0, 1000),
        ];
    }
}
