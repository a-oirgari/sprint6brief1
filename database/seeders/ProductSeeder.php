<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        Product::factory()
            ->count(30)
            ->create();

        
        Product::factory()
            ->count(5)
            ->outOfStock()
            ->create();

        
        Product::factory()
            ->count(10)
            ->inStock()
            ->create();

        
        Product::factory()
            ->count(5)
            ->premium()
            ->create();

        $this->command->info('✅ 50 produits créés avec succès !');
        $this->command->info('   - 30 produits normaux');
        $this->command->info('   - 5 produits en rupture');
        $this->command->info('   - 10 produits en stock');
        $this->command->info('   - 5 produits premium');
    }
}