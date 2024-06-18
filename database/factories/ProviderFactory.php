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
            "prov_ranking" => 0,
            "prov_group"=> 'FUP',
            "prov_description"=> 'Universidad privada en Popayán',
            "prov_status"=> 1,
            "people_peo_id"=> 1,
        ];
    }
}
