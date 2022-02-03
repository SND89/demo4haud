<?php

namespace Database\Factories;

use Illuminate\Support\Str;
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
        $name = $this->faker->words(5, true);

        return [
            'name' => ucwords($name),
            'slug' => Str::slug($name),
            'sku' => strtoupper(Str::random(6)),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 5, 100),
        ];
    }
}
