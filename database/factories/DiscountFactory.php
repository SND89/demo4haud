<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class DiscountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => "PROMO " . Str::random(5),
            'type' => rand(0, 1),
            'value' => rand(10, 90),
            'amount' => rand(50, 100)
        ];
    }
}
