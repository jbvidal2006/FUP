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
            "peo_lastName" => 'FUP',
            "peo_adress" => 'Calle 5 No. 8 - 58, Popayán, Cauca',
            "peo_dateBirth" => '1999/05/01',
            "peo_image" => $this->faker->image,
            "peo_mail" => 'fup@fup.edu.co',
            "peo_phone" => '3145568894',

        ];
    }
}
