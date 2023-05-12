<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sertifikat>
 */
class SertifikatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'no_sertifikat' => $this->faker->randomNumber(2, false),
            'nama' => $this->faker->words(2, true),
            'tanggal_terbit' => $this->faker->date(),
            'kadaluarsa_penyelenggara' => $this->faker->date(),
            'keterangan' => $this->faker->paragraph(),
            "user_id" => $this->faker->numberBetween(3, 12)
        ];
    }
}
