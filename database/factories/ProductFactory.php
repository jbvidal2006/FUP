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
    public function definition(): array
    {
        return [
            "pro_name" =>$this->faker->streetName,
            "pro_type" =>$this->faker->randomElement(["de consumo", "comercial", "industrial"]),
            "pro_amount" =>$this->faker->numberBetween(1,50),
            "pro_price" =>$this->faker->numberBetween(500,100000),
            "pro_image" =>$this->faker->image,
            "pro_certs" =>$this->faker->boolean(50),
            'categories_cat_id' =>$this->faker->numberBetween(1,10)
        ];


    }
}
