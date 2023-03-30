<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BantuanItem>
 */
class BantuanAlatFactory extends Factory
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
            "alat_id" => $this->faker->numberBetween(1, 20),
            "kuantitas" => $this->faker->randomDigitNotNull()
        ];
    }
}
