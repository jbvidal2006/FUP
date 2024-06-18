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
            "peo_name" => 'FUP',
            "peo_lastName" => 'Agroecologica',
            "peo_adress" => 'Popayán',
            "peo_dateBirth" => '1982/12/14',
            "peo_image" => $this->faker->image,
            "peo_mail" => 'fup@fup.edu.co',
            "peo_phone" => '3333333333',

        ];
    }
}
