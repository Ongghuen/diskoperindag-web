<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => bcrypt('1234567890123456'),
            'remember_token' => Str::random(10),
            'NIK' => $this->faker->randomNumber(9, true),
            'alamat' => $this->faker->address(),
            'phone' => $this->faker->e164PhoneNumber(),
            'gender' => $this->faker->randomElement(['L', 'P']),
            'kepala_keluarga' => $this->faker->randomElement([0, 1]),
            'tempat_lahir' => $this->faker->words(2, true),
            'tanggal_lahir' => $this->faker->date(),
            'umur' => $this->faker->randomNumber(2, true),
            'jenis_usaha' => $this->faker->words(2, true),
            'role_id' => '3'
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
