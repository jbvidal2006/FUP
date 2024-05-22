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
            'cat_name' => $this->faker->unique()(['frutas', 'verduras', 'objetos', 'otra']),
            'cat_description' => $this->faker->unique()(['Deliciosas y frescas', 'Nutrientes y saludables', 'Objeto', 'No espesifica']),
            'cat_image' => $this->faker->imageUrl(640, 480, 'cats'),
        ];
    }
}
