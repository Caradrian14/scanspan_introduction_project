<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order;

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
    public function definition()
    {
        return [
            'customer_name' => $this->faker->name,
            'product' => $this->faker->word,
            'quantity' => $this->faker->numberBetween(1, 10),
            'total_price' => $this->faker->randomFloat(2, 10, 1000),
            'order_date' => $this->faker->date(),
            'status' => $this->faker->randomElement(['pendiente', 'completado', 'cancelado']),
        ];
    }
}
