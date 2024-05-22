<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\People::factory(1)->create();
        \App\Models\User::factory(1)->create();


        \App\Models\Category::factory()->create([
            'cat_name' => 'frutas',
            'cat_description' => 'deciosas, frescas y saludables',
            'cat_image' => 'frutas.png'
        ]);

        \App\Models\Category::factory()->create([
            'cat_name' => 'verduras',
            'cat_description' => 'deciosas y nutritivas',
            'cat_image' => 'verduras.png'
        ]);


        \App\Models\Category::factory()->create([
            'cat_name' => 'objetos',
            'cat_description' => 'algo material',
            'cat_image' => 'frutas.png'
        ]);


        \App\Models\Category::factory()->create([
            'cat_name' => 'otra',
            'cat_description' => 'no especifica',
            'cat_image' => 'otra.png'
        ]);


        //\App\Models\Provider::factory(10)->create();
        //\App\Models\Category::factory(10)->create();
        // \App\Models\Product::factory(10)->create();
        //\App\Models\Contact::factory(10)->create();


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
