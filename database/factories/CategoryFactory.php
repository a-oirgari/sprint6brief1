<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        
        $categories = [
            'Électronique',
            'Mode et Vêtements',
            'Maison et Décoration',
            'Sports et Loisirs',
            'Livres et Médias',
            'Beauté et Santé',
            'Jouets et Enfants',
            'Automobile',
            'Alimentation',
            'Bijoux et Accessoires',
            'Informatique',
            'Téléphonie',
            'Mobilier',
            'Jardinage',
            'Électroménager'
        ];

        $nom = $this->faker->unique()->randomElement($categories);

        return [
            'nom' => $nom,
            'slug' => Str::slug($nom),
            'description' => $this->faker->sentence(12), 
        ];
    }
}