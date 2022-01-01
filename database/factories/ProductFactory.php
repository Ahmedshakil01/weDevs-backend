<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName,
            'quantity' => $this->faker->numberBetween(1,2000),
            'price' => $this->faker->numberBetween(500,4000),
            'description' => $this->faker->text(200),
            'image' => $this->faker->imageUrl(500, 500, true),
        ];
    }
}
