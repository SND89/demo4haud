<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make(Str::random(6)),
            'username' => $this->faker->userName(),
            'email_verified_at' => now(),
            'blocked' =>  rand(0, 1),
            'remember_token' => Str::random(10)
        ];
    }
}
