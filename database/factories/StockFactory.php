<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
           'name' => $this->faker->unique()->company(),
           'accentColor' =>$this->faker->hexcolor(),
           'bgColor' => $this->faker->hexcolor(),
           'price' => $this->faker->numberBetween(10,100),
        ];
    }
}