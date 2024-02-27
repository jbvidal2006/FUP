<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'con_shippingDate' =>$this->faker->date,
            'providers_prov_id' =>$this->faker->numberBetween(1,10),
            'products_pro_id' =>$this->faker->numberBetween(1,10)
        ];
    }
}
