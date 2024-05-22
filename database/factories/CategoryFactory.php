<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {




        return [


            // Uso de la función para generar un nombre único
            'cat_name' => 'frutas',
            'cat_description' => 'deciosas, frescas y saludabels',
            'cat_image' => 'frutas.png'
        ];
    }
}
