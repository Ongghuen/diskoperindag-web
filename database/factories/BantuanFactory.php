<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bantuan>
 */
class BantuanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_bantuan' => $this->faker->words(2, true),
            'koordinator' => fake()->name(),
            'tahun_pemberian' => $this->faker->date(),
            "user_id" => $this->faker->numberBetween(3, 12)
        ];
    }
}
