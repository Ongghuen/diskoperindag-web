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
            'jenis_usaha' => $this->faker->words(2, true),
            'tahun_pemberian' => '2023',
            "user_id" => $this->faker->numberBetween(1, 10)
        ];
    }
}
