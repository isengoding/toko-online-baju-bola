<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'label' => fake()->word(),
            'recipient_name' => fake()->name(),
            'street_address' => fake()->streetAddress(),
            'phone_number' => fake()->phoneNumber(),
            'notes' => fake()->text(),
            'is_default' => fake()->boolean(),
            'user_id' => User::factory(),
        ];
    }
}
