<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $parent = [
            'id' => 23,
            'name' => 'Produits',
            'slug' => 'produits',
            'icon' => 'fa-box',
            'sort_order' => 10,
            'is_active' => true,
        ];

        $parent = DB::table('categories')->where('slug', 'produits')->first();

        if (!$parent) {
            $parentId = DB::table('categories')->insertGetId([
                'name' => 'Produits',
                'slug' => 'produits',
                'icon' => 'fa-box',
                'sort_order' => 10,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $parentId = $parent->id;

        $subcategories = [
            // Alimentaires
            ['name' => 'Produits Alimentaires', 'slug' => 'produits-alimentaires', 'icon' => 'fa-carrot', 'sort_order' => 1],
            ['name' => 'Ouvrir Produits', 'slug' => 'ouvrir-produits', 'icon' => 'fa-plus-circle', 'sort_order' => 2],

            // Mode & Vêtements
            ['name' => 'Mode & Vêtements', 'slug' => 'mode-vetements', 'icon' => 'fa-shirt', 'sort_order' => 10],
            ['name' => 'Ouvrir Mode & Vêtements', 'slug' => 'ouvrir-mode-vetements', 'icon' => 'fa-plus-circle', 'sort_order' => 11],

            // Électronique
            ['name' => 'Électronique', 'slug' => 'electronique', 'icon' => 'fa-mobile-screen', 'sort_order' => 20],
            ['name' => 'Téléphones & Tablette', 'slug' => 'telephones-tablette', 'icon' => 'fa-mobile-screen', 'sort_order' => 21],

            // Maison
            ['name' => 'Maison & Équipement', 'slug' => 'maison-equipement', 'icon' => 'fa-couch', 'sort_order' => 30],
            ['name' => 'Meubles', 'slug' => 'meubles', 'icon' => 'fa-chair', 'sort_order' => 31],
            ['name' => 'Décoration & Arts', 'slug' => 'decoration-arts', 'icon' => 'fa-palette', 'sort_order' => 32],

            // Beauté
            ['name' => 'Beauté & Bien-être', 'slug' => 'beaute-bien-etre', 'icon' => 'fa-spa', 'sort_order' => 40],
            ['name' => 'Parfums & Cosmétiques', 'slug' => 'parfums-cosmetiques', 'icon' => 'fa-pump-soap', 'sort_order' => 41],

            // Auto/Moto
            ['name' => 'Automobile', 'slug' => 'automobile', 'icon' => 'fa-car', 'sort_order' => 50],

            // Agriculture
            ['name' => 'Agriculture', 'slug' => 'agriculture', 'icon' => 'fa-seedling', 'sort_order' => 60],
            ['name' => 'Produits de Construction & Matériaux', 'slug' => 'produits-construction-materiaux', 'icon' => 'fa-hammer', 'sort_order' => 61],

            // Fournitures
            ['name' => 'Fournitures Professionnelles', 'slug' => 'fournitures-professionnelles', 'icon' => 'fa-toolbox', 'sort_order' => 70],
        ];

        foreach ($subcategories as $sub) {
            DB::table('categories')->insert([
                'name' => $sub['name'],
                'slug' => $sub['slug'],
                'icon' => $sub['icon'],
                'parent_id' => $parentId,
                'sort_order' => $sub['sort_order'],
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}