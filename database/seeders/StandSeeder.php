<?php

namespace Database\Seeders;

use App\Models\Stand;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $premiumStands = [
            [
                'name' => 'Tech Universe Store',
                'desc' => 'La référence en matière de gadgets électroniques, smartphones de dernière génération et accessoires informatiques.',
                'city' => 'Lomé',
                'category' => 'Électronique',
                'logo' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=300&auto=format&fit=crop',
                'cover' => 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?q=80&w=1600&auto=format&fit=crop'
            ],
            [
                'name' => 'African Beauty & Care',
                'desc' => 'Produits cosmétiques naturels et soins de la peau adaptés aux spécificités africaines. Beauté authentique.',
                'city' => 'Dakar',
                'category' => 'Beauté & Santé',
                'logo' => 'https://images.unsplash.com/photo-1596462502278-27bfdc403348?q=80&w=300&auto=format&fit=crop',
                'cover' => 'https://images.unsplash.com/photo-1556228578-0d85b1a4d571?q=80&w=1600&auto=format&fit=crop'
            ],
            [
                'name' => 'Mode Ébène',
                'desc' => 'Créations de mode contemporaines inspirées des traditions africaines. Vêtements sur mesure et prêt-à-porter.',
                'city' => 'Abidjan',
                'category' => 'Mode & Vêtements',
                'logo' => 'https://images.unsplash.com/photo-1550614000-4b95d4ed7ed0?q=80&w=300&auto=format&fit=crop',
                'cover' => 'https://images.unsplash.com/photo-1483985988355-763728e1935b?q=80&w=1600&auto=format&fit=crop'
            ],
            [
                'name' => 'Saveurs du Terroir',
                'desc' => 'Épicerie fine proposant les meilleurs produits agricoles locaux, épices rares et délices artisanaux.',
                'city' => 'Lomé',
                'category' => 'Alimentation',
                'logo' => 'https://images.unsplash.com/photo-1596646270591-62ba32115e5a?q=80&w=300&auto=format&fit=crop',
                'cover' => 'https://images.unsplash.com/photo-1542838132-92c53300491e?q=80&w=1600&auto=format&fit=crop'
            ],
            [
                'name' => 'Auto Elite Motors',
                'desc' => 'Importation et vente de véhicules d\'occasion certifiés et neufs. Service après-vente garanti.',
                'city' => 'Cotonou',
                'category' => 'Automobile',
                'logo' => 'https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?q=80&w=300&auto=format&fit=crop',
                'cover' => 'https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?q=80&w=1600&auto=format&fit=crop'
            ],
            [
                'name' => 'Maison Déco & Design',
                'desc' => 'Meubles élégants, décoration d\'intérieur et artisanat local de luxe pour sublimer votre espace.',
                'city' => 'Lomé',
                'category' => 'Maison & Décoration',
                'logo' => 'https://images.unsplash.com/photo-1513694203232-719a280e022f?q=80&w=300&auto=format&fit=crop',
                'cover' => 'https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?q=80&w=1600&auto=format&fit=crop'
            ],
            [
                'name' => 'Sneakers Hub',
                'desc' => 'La destination ultime pour les passionnés de sneakers. Éditions limitées et modèles exclusifs.',
                'city' => 'Lomé',
                'category' => 'Chaussures',
                'logo' => 'https://images.unsplash.com/photo-1514989940723-e8e51635b782?q=80&w=300&auto=format&fit=crop',
                'cover' => 'https://images.unsplash.com/photo-1552346154-21d32810baa3?q=80&w=1600&auto=format&fit=crop'
            ],
            [
                'name' => 'Fitness Pro Équipement',
                'desc' => 'Tout le matériel professionnel et amateur pour le sport, la musculation et le fitness à domicile.',
                'city' => 'Dakar',
                'category' => 'Sport & Fitness',
                'logo' => 'https://images.unsplash.com/photo-1517836357463-d25dfeac3438?q=80&w=300&auto=format&fit=crop',
                'cover' => 'https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=1600&auto=format&fit=crop'
            ],
            [
                'name' => 'Librairie du Savoir',
                'desc' => 'Un vaste choix de livres académiques, littérature africaine, romans et fournitures scolaires.',
                'city' => 'Abidjan',
                'category' => 'Livres & Papeterie',
                'logo' => 'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?q=80&w=300&auto=format&fit=crop',
                'cover' => 'https://images.unsplash.com/photo-1507842217343-583bb7270b66?q=80&w=1600&auto=format&fit=crop'
            ],
            [
                'name' => 'Komi Bricolage & Outils',
                'desc' => 'L\'outillage professionnel pour les artisans et passionnés du bâtiment. Quincaillerie générale.',
                'city' => 'Lomé',
                'category' => 'Bricolage',
                'logo' => 'https://images.unsplash.com/photo-1540103711724-ebf833bde8d0?q=80&w=300&auto=format&fit=crop',
                'cover' => 'https://images.unsplash.com/photo-1530124566582-a618bc2615dc?q=80&w=1600&auto=format&fit=crop'
            ]
        ];

        foreach ($premiumStands as $index => $data) {
            // Créer un utilisateur pour chaque stand
            $user = User::factory()->create([
                'name' => 'Seller ' . ($index + 1),
                'email' => 'seller' . ($index + 1) . '@kelbom.com',
                'password' => bcrypt('password'),
                'phone_number' => '+228 90 ' . rand(10, 99) . ' ' . rand(10, 99) . ' ' . rand(10, 99),
            ]);

            // Assigner le rôle seller
            $user->assignRole('seller');

            // Créer le stand
            Stand::create([
                'user_id' => $user->id,
                'stand_name' => $data['name'],
                'slug' => Str::slug($data['name']),
                'description' => $data['desc'],
                'logo_url' => $data['logo'],
                'cover_url' => $data['cover'],
                'city' => $data['city'],
                'country' => in_array($data['city'], ['Dakar']) ? 'Sénégal' : (in_array($data['city'], ['Abidjan']) ? 'Côte d\'Ivoire' : (in_array($data['city'], ['Cotonou']) ? 'Bénin' : 'Togo')),
                'is_verified' => true,
                'rating_avg' => rand(45, 50) / 10, // Note entre 4.5 et 5.0
                'total_reviews' => rand(10, 150),
                'contact_email' => 'contact@' . Str::slug($data['name']) . '.com',
                'contact_phone' => '+228 90 ' . rand(10, 99) . ' ' . rand(10, 99) . ' ' . rand(10, 99),
                'whatsapp_number' => '+228 90 ' . rand(10, 99) . ' ' . rand(10, 99) . ' ' . rand(10, 99),
            ]);
        }
    }
}
