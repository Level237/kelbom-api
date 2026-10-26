<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Stand;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StandSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->catalog() as $index => $data) {
            $category = Category::query()->where('slug', $data['category'])->first();

            if (! $category) {
                $this->command?->warn("Catégorie introuvable ({$data['category']}) pour {$data['name']}");

                continue;
            }

            $email = 'seller'.($index + 1).'@kelbom.com';
            $phone = '+2376'.str_pad((string) (70000000 + $index), 8, '0', STR_PAD_LEFT);

            $user = User::query()->updateOrCreate(
                ['email' => $email],
                [
                    'name' => $data['seller'],
                    'password' => bcrypt('password'),
                    'phone_number' => $phone,
                ]
            );

            if (! $user->hasRole('seller')) {
                $user->assignRole('seller');
            }

            $stand = Stand::withTrashed()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'stand_name' => $data['name'],
                    'kind' => $data['kind'],
                    'slug' => Str::slug($data['name']),
                    'description' => $data['description'],
                    'logo_url' => $data['logo'],
                    'cover_url' => $data['cover'],
                    'city' => $data['city'],
                    'country' => 'Cameroun',
                    'is_verified' => true,
                    'rating_avg' => $data['rating'],
                    'total_reviews' => $data['reviews'],
                    'contact_email' => 'contact@'.Str::slug($data['name']).'.com',
                    'contact_phone' => $phone,
                    'whatsapp_number' => $phone,
                ]
            );

            if ($stand->trashed()) {
                $stand->restore();
            }

            Product::withTrashed()->where('stand_id', $stand->id)->forceDelete();
            $stand->categories()->sync([$category->id]);
        }
    }

    /**
     * @return list<array<string, mixed>>
     */
    private function catalog(): array
    {
        return [
            [
                'name' => 'Étoffes du Mfoundi',
                'kind' => 'product',
                'seller' => 'Aline Ngo',
                'category' => 'mode-vetements',
                'city' => 'Yaoundé',
                'description' => 'Pagnes, boubous et prêts-à-porter cousus à Yaoundé.',
                'rating' => 4.8,
                'reviews' => 86,
                'logo' => 'https://images.unsplash.com/photo-1523381210434-271e8be1f52b?q=80&w=300&auto=format&fit=crop',
                'cover' => 'https://images.unsplash.com/photo-1483985988355-763728e1935b?q=80&w=1600&auto=format&fit=crop',
            ],
            [
                'name' => 'Saveurs du Noun',
                'kind' => 'product',
                'seller' => 'Paul Tchoumi',
                'category' => 'produits-alimentaires',
                'city' => 'Bafoussam',
                'description' => 'Épices, miel et produits du terroir de l’Ouest.',
                'rating' => 4.9,
                'reviews' => 64,
                'logo' => 'https://images.unsplash.com/photo-1596040033229-a9821ebd058d?q=80&w=300&auto=format&fit=crop',
                'cover' => 'https://images.unsplash.com/photo-1542838132-92c53300491e?q=80&w=1600&auto=format&fit=crop',
            ],
            [
                'name' => 'Beauté du Wouri',
                'kind' => 'product',
                'seller' => 'Mireille Essomba',
                'category' => 'parfums-cosmetiques',
                'city' => 'Douala',
                'description' => 'Beurre de karité, huiles et savons pour la peau.',
                'rating' => 4.7,
                'reviews' => 41,
                'logo' => 'https://images.unsplash.com/photo-1596462502278-27bfdc403348?q=80&w=300&auto=format&fit=crop',
                'cover' => 'https://images.unsplash.com/photo-1556228578-0d85b1a4d571?q=80&w=1600&auto=format&fit=crop',
            ],
            [
                'name' => 'Sneakers Bonanjo',
                'kind' => 'product',
                'seller' => 'Kevin Manga',
                'category' => 'mode-vetements',
                'city' => 'Douala',
                'description' => 'Baskets et sneakers pour la ville, à Bonanjo.',
                'rating' => 4.6,
                'reviews' => 53,
                'logo' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=300&auto=format&fit=crop',
                'cover' => 'https://images.unsplash.com/photo-1552346154-21d32810baa3?q=80&w=1600&auto=format&fit=crop',
            ],
            [
                'name' => 'Atelier Bois Nlongkak',
                'kind' => 'product',
                'seller' => 'Jean Mbarga',
                'category' => 'meubles',
                'city' => 'Yaoundé',
                'description' => 'Meubles en bois et pièces déco faits à Nlongkak.',
                'rating' => 4.8,
                'reviews' => 29,
                'logo' => 'https://images.unsplash.com/photo-1567538096630-e0c55bd6374c?q=80&w=300&auto=format&fit=crop',
                'cover' => 'https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?q=80&w=1600&auto=format&fit=crop',
            ],
            [
                'name' => 'Quincaillerie Akwa',
                'kind' => 'product',
                'seller' => 'Serge Owona',
                'category' => 'fournitures-professionnelles',
                'city' => 'Douala',
                'description' => 'Outils et fournitures pour artisans, à Akwa.',
                'rating' => 4.5,
                'reviews' => 37,
                'logo' => 'https://images.unsplash.com/photo-1504148455328-c376907d081c?q=80&w=300&auto=format&fit=crop',
                'cover' => 'https://images.unsplash.com/photo-1530124566582-a618bc2615dc?q=80&w=1600&auto=format&fit=crop',
            ],
            [
                'name' => 'Couture Maman Elise',
                'kind' => 'service',
                'seller' => 'Elise Ngo Bell',
                'category' => 'services-a-domicile',
                'city' => 'Douala',
                'description' => 'Retouches, robes et tenues sur mesure, à domicile ou en atelier.',
                'rating' => 4.9,
                'reviews' => 72,
                'logo' => 'https://images.unsplash.com/photo-1556905055-8f358a7a47b2?q=80&w=300&auto=format&fit=crop',
                'cover' => 'https://images.unsplash.com/photo-1489987707025-afc232f7ea0f?q=80&w=1600&auto=format&fit=crop',
            ],
            [
                'name' => 'Coiffure Chez Aïcha',
                'kind' => 'service',
                'seller' => 'Aïcha Bello',
                'category' => 'sante-et-bien-etre',
                'city' => 'Yaoundé',
                'description' => 'Tresses, soins et coiffure à domicile à Bastos.',
                'rating' => 4.8,
                'reviews' => 58,
                'logo' => 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?q=80&w=300&auto=format&fit=crop',
                'cover' => 'https://images.unsplash.com/photo-1560066984-138dadb4c035?q=80&w=1600&auto=format&fit=crop',
            ],
            [
                'name' => 'Cours Bonapriso',
                'kind' => 'service',
                'seller' => 'Nadia Fofou',
                'category' => 'education-et-formation',
                'city' => 'Douala',
                'description' => 'Cours particuliers de maths et de français, collège et lycée.',
                'rating' => 4.9,
                'reviews' => 33,
                'logo' => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?q=80&w=300&auto=format&fit=crop',
                'cover' => 'https://images.unsplash.com/photo-1427504494785-3a9ca7044f45?q=80&w=1600&auto=format&fit=crop',
            ],
            [
                'name' => 'Photo Bastos',
                'kind' => 'service',
                'seller' => 'Landry Ewane',
                'category' => 'photo-et-video',
                'city' => 'Yaoundé',
                'description' => 'Photos de mariage, portraits et reportages à Yaoundé.',
                'rating' => 4.7,
                'reviews' => 44,
                'logo' => 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?q=80&w=300&auto=format&fit=crop',
                'cover' => 'https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=1600&auto=format&fit=crop',
            ],
        ];
    }
}
