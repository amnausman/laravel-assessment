<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClientProduct>
 */
class ClientProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // 'user_id' => $this->faker->unique()->numberBetween(1, 9),
            'product_id' => rand(1,20),
            'special_price' => rand(50,100)
        ];
    }
}
