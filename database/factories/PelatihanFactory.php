<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pelatihan>
 */
class PelatihanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->words(2, true),
            'penyelenggara' => $this->faker->words(2, true),
            'tanggal_pelaksanaan' => $this->faker->date(),
            'tempat' => $this->faker->words(2, true),
            "user_id" => $this->faker->numberBetween(2, 11)
        ];
    }
}
