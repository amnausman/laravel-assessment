<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'handle' => $this->faker->word(5,true),
            'title'  => $this->faker->word(10,true),
            'body'  => $this->faker->paragraph(2),
            'vendor' => $this->faker->name,
            'type'   => $this->faker->word(1,true),
            'tags'   => $this->faker->word(2,true),
            'price'  => rand(100,1000),
            'published' => rand(0,1),
         ];
    }
}
