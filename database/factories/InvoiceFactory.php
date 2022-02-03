<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $paid = $this->getPaidInfo();
        $date = $this->faker->dateTimeBetween('-5 years');

        //Don't make it paid before creating invoice :)
        if (!empty($paid['payment_date'])) {
            $date = $this->faker->dateTimeBetween($paid['payment_date']);
        }

        return $paid + [
            'number' => random_int(5000, 10000),
            'date' => $date,
        ];
    }

    /**
     * Create random paid or not information
     */
    public function getPaidInfo()
    {
        $result = [
            'paid' => false,
            'payment_id' => null,
            'payment_date' => null
        ];
        $paid = rand(0, 1);

        if ($paid > 0) {
            $result['paid'] = true;
            $result['payment_id'] = Str::random(10);
            $result['payment_date'] = $this->faker->dateTimeBetween('-5 years');
        }

        return $result;
    }
}
