<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Stand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->catalog() as $standName => $products) {
            $stand = Stand::query()->where('stand_name', $standName)->first();

            if (! $stand) {
                $this->command?->warn("Stand introuvable, produits ignorés : {$standName}");

                continue;
            }

            foreach ($products as $product) {
                $category = Category::query()->where('slug', $product['category'])->first();

                if (! $category) {
                    $this->command?->warn("Catégorie introuvable ({$product['category']}) pour {$product['name']}");

                    continue;
                }

                $saved = Product::query()->updateOrCreate(
                    [
                        'stand_id' => $stand->id,
                        'slug' => Str::slug($product['name']),
                    ],
                    [
                        'category_id' => $category->id,
                        'name' => $product['name'],
                        'description' => $product['description'],
                        'price' => $product['price'],
                        'compare_at_price' => $product['compare_at_price'] ?? null,
                        'min_order_quantity' => $product['min_order_quantity'] ?? 1,
                        'unit' => $product['unit'],
                        'specifications' => $product['specifications'],
                        'main_image_url' => $product['image'],
                        'status' => 'active',
                    ]
                );

                ProductImage::query()->updateOrCreate(
                    [
                        'product_id' => $saved->id,
                        'sort_order' => 0,
                    ],
                    ['image_url' => $product['image']]
                );
            }
        }
    }

    /**
     * Produits affichés sur la fiche de quelques stands.
     * Les caractéristiques suivent le format du formulaire vendeur : clé / valeur.
     *
     * @return array<string, list<array<string, mixed>>>
     */
    private function catalog(): array
    {
        return [
            'Étoffes du Mfoundi' => [
                [
                    'name' => 'Boubou wax soleil',
                    'category' => 'mode-vetements',
                    'description' => 'Boubou en wax coton, coupe ample, cousu à Yaoundé.',
                    'price' => 45000,
                    'compare_at_price' => 52000,
                    'unit' => 'pièce',
                    'image' => 'https://images.unsplash.com/photo-1523381210434-271e8be1f52b?q=80&w=1200&auto=format&fit=crop',
                    'specifications' => [
                        ['key' => 'Matière', 'value' => 'Coton wax'],
                        ['key' => 'Coupe', 'value' => 'Ample'],
                        ['key' => 'Origine', 'value' => 'Yaoundé'],
                    ],
                ],
                [
                    'name' => 'Robe pagne soirée',
                    'category' => 'mode-vetements',
                    'description' => 'Robe longue en pagne, doublure coton, pour cérémonies.',
                    'price' => 38000,
                    'unit' => 'pièce',
                    'image' => 'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?q=80&w=1200&auto=format&fit=crop',
                    'specifications' => [
                        ['key' => 'Matière', 'value' => 'Pagne et coton'],
                        ['key' => 'Longueur', 'value' => 'Cheville'],
                        ['key' => 'Entretien', 'value' => 'Lavage à la main'],
                    ],
                ],
                [
                    'name' => 'Chemise lin col officier',
                    'category' => 'mode-vetements',
                    'description' => 'Chemise légère en lin, col officier, portée ville.',
                    'price' => 22000,
                    'unit' => 'pièce',
                    'image' => 'https://images.unsplash.com/photo-1596755094514-f87e34085b2c?q=80&w=1200&auto=format&fit=crop',
                    'specifications' => [
                        ['key' => 'Matière', 'value' => 'Lin'],
                        ['key' => 'Col', 'value' => 'Officier'],
                        ['key' => 'Tailles', 'value' => 'S à XL'],
                    ],
                ],
            ],
            'Sneakers Bonanjo' => [
                [
                    'name' => 'Baskets urbaines blanches',
                    'category' => 'mode-vetements',
                    'description' => 'Baskets toile blanche, semelle gomme, port quotidien.',
                    'price' => 28000,
                    'unit' => 'paire',
                    'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=1200&auto=format&fit=crop',
                    'specifications' => [
                        ['key' => 'Tige', 'value' => 'Toile'],
                        ['key' => 'Semelle', 'value' => 'Gomme'],
                        ['key' => 'Pointures', 'value' => '38 à 45'],
                    ],
                ],
                [
                    'name' => 'Sneakers toile limitée',
                    'category' => 'mode-vetements',
                    'description' => 'Série courte, toile colorée, lacets plats.',
                    'price' => 35000,
                    'compare_at_price' => 42000,
                    'unit' => 'paire',
                    'image' => 'https://images.unsplash.com/photo-1460353581641-37baddab0fa2?q=80&w=1200&auto=format&fit=crop',
                    'specifications' => [
                        ['key' => 'Série', 'value' => 'Limitée'],
                        ['key' => 'Lacets', 'value' => 'Plats'],
                        ['key' => 'Pointures', 'value' => '39 à 44'],
                    ],
                ],
                [
                    'name' => 'Claquettes marché',
                    'category' => 'mode-vetements',
                    'description' => 'Claquettes légères, brides réglables, usage ville.',
                    'price' => 8000,
                    'unit' => 'paire',
                    'image' => 'https://images.unsplash.com/photo-1603487742131-4160ec999306?q=80&w=1200&auto=format&fit=crop',
                    'specifications' => [
                        ['key' => 'Matière', 'value' => 'Synthétique'],
                        ['key' => 'Semelle', 'value' => 'Antidérapante'],
                        ['key' => 'Pointures', 'value' => '37 à 44'],
                    ],
                ],
            ],
            'Saveurs du Noun' => [
                [
                    'name' => 'Piment sec de Kpalimé',
                    'category' => 'produits-alimentaires',
                    'description' => 'Piment rouge séché au soleil, sachet de 250 g.',
                    'price' => 2500,
                    'min_order_quantity' => 2,
                    'unit' => 'sachet',
                    'image' => 'https://images.unsplash.com/photo-1596040033229-a9821ebd058d?q=80&w=1200&auto=format&fit=crop',
                    'specifications' => [
                        ['key' => 'Poids', 'value' => '250 g'],
                        ['key' => 'Origine', 'value' => 'Kpalimé'],
                        ['key' => 'Conservation', 'value' => 'Au sec'],
                    ],
                ],
                [
                    'name' => 'Miel de savane',
                    'category' => 'produits-alimentaires',
                    'description' => 'Miel brut, pot en verre de 500 g.',
                    'price' => 6500,
                    'unit' => 'pot',
                    'image' => 'https://images.unsplash.com/photo-1587049352846-4a222e784d38?q=80&w=1200&auto=format&fit=crop',
                    'specifications' => [
                        ['key' => 'Poids', 'value' => '500 g'],
                        ['key' => 'Type', 'value' => 'Miel brut'],
                        ['key' => 'Conditionnement', 'value' => 'Pot verre'],
                    ],
                ],
                [
                    'name' => 'Mélange d’épices grillées',
                    'category' => 'produits-alimentaires',
                    'description' => 'Mélange maison pour sauces et grillades, 200 g.',
                    'price' => 1800,
                    'unit' => 'sachet',
                    'image' => 'https://images.unsplash.com/photo-1516594798947-e65505dbb29d?q=80&w=1200&auto=format&fit=crop',
                    'specifications' => [
                        ['key' => 'Poids', 'value' => '200 g'],
                        ['key' => 'Usage', 'value' => 'Sauces et grillades'],
                        ['key' => 'Préparation', 'value' => 'Grillé'],
                    ],
                ],
            ],
            'Beauté du Wouri' => [
                [
                    'name' => 'Beurre de karité pur',
                    'category' => 'parfums-cosmetiques',
                    'description' => 'Beurre de karité non raffiné, pot de 250 g.',
                    'price' => 4500,
                    'unit' => 'pot',
                    'image' => 'https://images.unsplash.com/photo-1608571423902-eed4a5ad8108?q=80&w=1200&auto=format&fit=crop',
                    'specifications' => [
                        ['key' => 'Poids', 'value' => '250 g'],
                        ['key' => 'Type', 'value' => 'Non raffiné'],
                        ['key' => 'Usage', 'value' => 'Peau et cheveux'],
                    ],
                ],
                [
                    'name' => 'Huile de baobab',
                    'category' => 'parfums-cosmetiques',
                    'description' => 'Huile végétale pressée à froid, flacon de 100 ml.',
                    'price' => 9000,
                    'unit' => 'flacon',
                    'image' => 'https://images.unsplash.com/photo-1474979266404-7eaacbcd87c5?q=80&w=1200&auto=format&fit=crop',
                    'specifications' => [
                        ['key' => 'Volume', 'value' => '100 ml'],
                        ['key' => 'Extraction', 'value' => 'Pressée à froid'],
                        ['key' => 'Usage', 'value' => 'Visage et corps'],
                    ],
                ],
                [
                    'name' => 'Savon noir artisanal',
                    'category' => 'parfums-cosmetiques',
                    'description' => 'Savon noir traditionnel, pain de 180 g.',
                    'price' => 2000,
                    'unit' => 'pain',
                    'image' => 'https://images.unsplash.com/photo-1600857544200-b2f666a9a2ec?q=80&w=1200&auto=format&fit=crop',
                    'specifications' => [
                        ['key' => 'Poids', 'value' => '180 g'],
                        ['key' => 'Type', 'value' => 'Savon noir'],
                        ['key' => 'Parfum', 'value' => 'Naturel'],
                    ],
                ],
            ],
            'Quincaillerie Akwa' => [
                [
                    'name' => 'Perceuse visseuse 18V',
                    'category' => 'fournitures-professionnelles',
                    'description' => 'Perceuse sans fil, deux batteries, mallette.',
                    'price' => 65000,
                    'unit' => 'kit',
                    'image' => 'https://images.unsplash.com/photo-1504148455328-c376907d081c?q=80&w=1200&auto=format&fit=crop',
                    'specifications' => [
                        ['key' => 'Tension', 'value' => '18 V'],
                        ['key' => 'Batteries', 'value' => '2'],
                        ['key' => 'Mandrin', 'value' => '13 mm'],
                    ],
                ],
                [
                    'name' => 'Marteau de charpentier',
                    'category' => 'fournitures-professionnelles',
                    'description' => 'Marteau 500 g, manche fibre, arrache-clou.',
                    'price' => 7500,
                    'unit' => 'pièce',
                    'image' => 'https://images.unsplash.com/photo-1586864387967-d02ef85d93e8?q=80&w=1200&auto=format&fit=crop',
                    'specifications' => [
                        ['key' => 'Poids', 'value' => '500 g'],
                        ['key' => 'Manche', 'value' => 'Fibre'],
                        ['key' => 'Usage', 'value' => 'Charpente'],
                    ],
                ],
                [
                    'name' => 'Niveau à bulle 60 cm',
                    'category' => 'fournitures-professionnelles',
                    'description' => 'Niveau aluminium, trois fioles, 60 cm.',
                    'price' => 5500,
                    'unit' => 'pièce',
                    'image' => 'https://images.unsplash.com/photo-1530124566582-a618bc2615dc?q=80&w=1200&auto=format&fit=crop',
                    'specifications' => [
                        ['key' => 'Longueur', 'value' => '60 cm'],
                        ['key' => 'Matière', 'value' => 'Aluminium'],
                        ['key' => 'Fioles', 'value' => '3'],
                    ],
                ],
            ],
            'Atelier Bois Nlongkak' => [
                [
                    'name' => 'Fauteuil bois et tissu',
                    'category' => 'meubles',
                    'description' => 'Fauteuil assise tissu, structure bois local.',
                    'price' => 85000,
                    'unit' => 'pièce',
                    'image' => 'https://images.unsplash.com/photo-1567538096630-e0c55bd6374c?q=80&w=1200&auto=format&fit=crop',
                    'specifications' => [
                        ['key' => 'Structure', 'value' => 'Bois'],
                        ['key' => 'Assise', 'value' => 'Tissu'],
                        ['key' => 'Usage', 'value' => 'Salon'],
                    ],
                ],
                [
                    'name' => 'Lampe de table tressée',
                    'category' => 'decoration-arts',
                    'description' => 'Lampe abat-jour fibres tressées, douille E27.',
                    'price' => 18000,
                    'unit' => 'pièce',
                    'image' => 'https://images.unsplash.com/photo-1507473885765-e6ed057f782c?q=80&w=1200&auto=format&fit=crop',
                    'specifications' => [
                        ['key' => 'Abat-jour', 'value' => 'Fibres tressées'],
                        ['key' => 'Douille', 'value' => 'E27'],
                        ['key' => 'Alimentation', 'value' => 'Secteur'],
                    ],
                ],
                [
                    'name' => 'Panier rangement artisanal',
                    'category' => 'decoration-arts',
                    'description' => 'Panier tressé, grand format, rangement salon.',
                    'price' => 12000,
                    'unit' => 'pièce',
                    'image' => 'https://images.unsplash.com/photo-1519710164239-da123dc03ef4?q=80&w=1200&auto=format&fit=crop',
                    'specifications' => [
                        ['key' => 'Matière', 'value' => 'Fibres naturelles'],
                        ['key' => 'Format', 'value' => 'Grand'],
                        ['key' => 'Usage', 'value' => 'Rangement'],
                    ],
                ],
            ],
        ];
    }
}
