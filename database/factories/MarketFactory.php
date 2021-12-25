<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MarketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => mt_rand(1, 10),
            'city_id' => mt_rand(1, 300),
            'name'    => $this->faker->unique->word(),
            'slug' => $this->faker->slug(),
            'bank' => 'BCA',
            'no_rekening' => $this->faker->unique()->numberBetween(100000, 999999)
        ];
    }
}
