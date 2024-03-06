<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'no_order' => 'INV' . Str::random(10),
            'user_id' => User::factory(),
            'total' => '10000',
            'checkout_url' => 'https://www.example.com',
            'invoice_id' => Str::random(10),
            'status_payment' => 'PENDING',
            'payment_method' => 'CASH',

        ];
    }
}
