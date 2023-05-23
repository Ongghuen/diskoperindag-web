<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserSertifikat>
 */
class UserSertifikatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "user_id" => $this->faker->numberBetween(3, 12),
            "sertifikat_id" => $this->faker->numberBetween(1, 20),
            'no_sertifikat' => $this->faker->randomNumber(3, false)
        ];
    }
}
