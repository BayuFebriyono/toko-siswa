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
        $price = [12000, 20000, 25000, 34000, 99000];
        $key = array_rand($price);
        return [
            'name'        => $this->faker->unique()->word(),
            'slug'        => $this->faker->unique()->slug(),
            'berat' => mt_rand(1, 5),
            'description' => $this->faker->paragraph(),
            'stock' => mt_rand(1,100),
            'price'       => $price[$key],
            'market_id'   => mt_rand(1, 5),
            'category_id' => mt_rand(1, 3)
        ];
    }
}
