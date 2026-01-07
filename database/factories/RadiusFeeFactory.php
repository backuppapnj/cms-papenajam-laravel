<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RadiusFee>
 */
class RadiusFeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'region' => $this->faker->city(),
            'radius' => $this->faker->randomElement(['Radius I', 'Radius II', 'Radius III', 'Radius IV']),
            'fee' => $this->faker->numberBetween(50000, 500000),
            'description' => $this->faker->sentence(),
        ];
    }
}
