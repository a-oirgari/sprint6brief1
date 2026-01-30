<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Listes de noms de produits par type
        $produits = [
            // Électronique
            'iPhone 15 Pro Max',
            'Samsung Galaxy S24 Ultra',
            'MacBook Pro M3',
            'iPad Air',
            'Apple Watch Series 9',
            'AirPods Pro 2',
            'Sony PlayStation 5',
            'Nintendo Switch OLED',
            'Dell XPS 15',
            'HP Pavilion',
            
            // Mode
            'Jean Slim Homme',
            'Robe d\'été Femme',
            'Basket Nike Air Max',
            'Chemise en Lin',
            'Pull en Laine',
            'Manteau d\'hiver',
            'Sac à Main Cuir',
            'Ceinture Homme',
            
            // Maison
            'Canapé 3 Places',
            'Table Basse en Bois',
            'Lampe LED Design',
            'Tapis Berbère',
            'Coussin Décoratif',
            'Miroir Mural',
            'Étagère Murale',
            
            // Sports
            'Vélo VTT 26"',
            'Ballon de Football',
            'Tapis de Yoga',
            'Haltères 10kg',
            'Raquette de Tennis',
            'Skateboard Pro',
            
            // Divers
            'Parfum Homme',
            'Crème Hydratante',
            'LEGO City',
            'Peluche Teddy',
            'GPS Voiture',
            'Chargeur Sans Fil',
            'Casque Audio Bluetooth',
            'Montre Connectée'
        ];

        $nom = $this->faker->randomElement($produits);
        
        
        $reference = strtoupper(substr($nom, 0, 3)) . '-' . $this->faker->unique()->numberBetween(1000, 9999);

        return [
            'nom' => $nom,
            'reference' => $reference,
            'description_courte' => $this->faker->text(150), 
            'prix' => $this->faker->randomFloat(2, 50, 15000), 
            'stock' => $this->faker->numberBetween(0, 100), 
            'category_id' => Category::inRandomOrder()->first()->id, 
            'image' => null, 
        ];
    }

    
    public function outOfStock(): static
    {
        return $this->state(fn (array $attributes) => [
            'stock' => 0,
        ]);
    }

    
    public function inStock(): static
    {
        return $this->state(fn (array $attributes) => [
            'stock' => $this->faker->numberBetween(50, 200),
        ]);
    }

    
    public function premium(): static
    {
        return $this->state(fn (array $attributes) => [
            'prix' => $this->faker->randomFloat(2, 5000, 30000),
        ]);
    }
}