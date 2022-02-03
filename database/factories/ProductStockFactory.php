<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductStockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'qty' => $this->faker->numberBetween(0, 20),
            'location' => strtoupper(Str::random(3))
        ];
    }
}
