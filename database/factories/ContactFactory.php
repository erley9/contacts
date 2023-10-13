<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
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
            'telephone' => fake()->phoneNumber(),
            'postcode' => fake()->postcode(),
            'address' => fake()->streetName(),
            'number' => fake()->numberBetween(1, 100),
            'neighbourhood' => "neighbourhood",
            'city' =>fake()->city(),
            'state' => fake()->state(),
            'country' => fake()->country()
        ];
    }
}
