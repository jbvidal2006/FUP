<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\People>
 */
class PeopleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "peo_name" => $this->faker->firstName,
            "peo_lastName" => $this->faker->lastName,
            "peo_adress" => $this->faker->streetAddress,
            "peo_phone" => $this->faker->phoneNumber,
            "peo_dateBirth" => $this->faker->date,
            "peo_image" => $this->faker->image,
        ];
    }
}
