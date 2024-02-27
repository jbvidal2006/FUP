<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Provider>
 */
class ProviderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "prov_ranking" => $this->faker->numberBetween(1,10),
            "prov_imageRanking" =>$this->faker->image,
            "prov_email"=> $this->faker->email,
            "prov_group"=> $this->faker->randomElement(["Rosas", "Timbio", "Popayan", "El tambo"]),
            "people_peo_id"=> $this->faker->numberBetween(1,10),
        ];
    }
}
