<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SertifikatItem>
 */
class BantuanSertifikatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "bantuan_id" => $this->faker->numberBetween(1, 10),
            "sertifikat_id" => $this->faker->numberBetween(1, 20),
        ];
    }
}
