<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $parentData = [
            'name' => 'Produits',
            'slug' => 'produits',
            'icon' => 'fa-box',
            'sort_order' => 10,
            'is_active' => true,
        ];

        // En une seule ligne : cherche par le slug, ou crée automatiquement si ça n'existe pas
        $parentProduct = Category::firstOrCreate(
            ['slug' => $parentData['slug']], // 1. La condition de recherche
            $parentData                      // 2. Les données à insérer si non trouvé
        );

        // L'ID est disponible immédiatement et de manière 100% sécurisée
        $parentProductId = $parentProduct->id;

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
            ['name' => 'Construction & Matériaux', 'slug' => 'construction-materiaux', 'icon' => 'fa-hammer', 'sort_order' => 61],

            // Fournitures
            ['name' => 'Fournitures Professionnelles', 'slug' => 'fournitures-professionnelles', 'icon' => 'fa-toolbox', 'sort_order' => 70],
        ];

        foreach ($subcategories as $sub) {
            DB::table('categories')->insert([
                'name' => $sub['name'],
                'slug' => $sub['slug'],
                'icon' => $sub['icon'],
                'parent_id' => $parentProductId,
                'sort_order' => $sub['sort_order'],
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }


        $parentDataServices = [
            'name' => 'Services',
            'slug' => 'services',
            'icon' => 'fa-box',
            'is_active' => true,
        ];

        // En une seule ligne : cherche par le slug, ou crée automatiquement si ça n'existe pas
        $parentServices = Category::firstOrCreate(
            ['slug' => $parentDataServices['slug']], // 1. La condition de recherche
            $parentDataServices                    // 2. Les données à insérer si non trouvé
        );

        // L'ID est disponible immédiatement et de manière 100% sécurisée
        $parentServiceId = $parentServices->id;

        $subcategoriesServices = [
            // Services
            ['name' => 'Services à domicile', 'slug' => 'services-a-domicile'],
            ['name' => 'Reparation & Maintenance', 'slug' => 'reparation-et-maintenance'],
            ['name' => 'Transport & Logistique', 'slug' => 'transport-et-logistique'],
            ['name' => 'Services IT & Numériques', 'slug' => 'services-it-et-numeriques'],
            ['name' => 'Marketing & Communication', 'slug' => 'marketing-et-communication'],
            ['name' => 'Education & Formation', 'slug' => 'education-et-formation'],
            ['name' => 'Santé & Bien-être', 'slug' => 'sante-et-bien-etre'],
            ['name' => 'Finance & Conseil', 'slug' => 'finance-et-conseil']
        ];

        foreach ($subcategoriesServices as $sub) {
            DB::table('categories')->insert([
                'name' => $sub['name'],
                'slug' => $sub['slug'],
                'parent_id' => $parentServiceId,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $parentDataAlimentation = [
            'name' => 'Alimentation & Hotellerie',
            'slug' => 'alimentation-et-hotellerie',
            'is_active' => true,
        ];

        // En une seule ligne : cherche par le slug, ou crée automatiquement si ça n'existe pas
        $parentAlimentation = Category::firstOrCreate(
            ['slug' => $parentDataAlimentation['slug']], // 1. La condition de recherche
            $parentDataAlimentation                   // 2. Les données à insérer si non trouvé
        );

        // L'ID est disponible immédiatement et de manière 100% sécurisée
        $parentAlimentationId = $parentAlimentation->id;

        $subcategoriesAlimentation = [
            // Services
            ['name' => 'Restaurant & Traiteurs', 'slug' => 'restaurant-et-traiteurs'],
            ['name' => 'Street Food & Cuisine locale', 'slug' => 'street-food-et-cuisine-locale'],
            ['name' => 'Hotel & Hebergements', 'slug' => 'hotel-et-hebergements'],
            ['name' => 'Bars & Lounges', 'slug' => 'bars-et-lounges'],
            ['name' => 'Traiteurs Evenementiels', 'slug' => 'traiteurs-evenementiels']
        ];

        foreach ($subcategoriesAlimentation as $sub) {
            DB::table('categories')->insert([
                'name' => $sub['name'],
                'slug' => $sub['slug'],
                'parent_id' => $parentAlimentationId,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $parentDataImmobilier = [
            'name' => 'Immobilier',
            'slug' => 'immobilier',
            'is_active' => true,
        ];

        // En une seule ligne : cherche par le slug, ou crée automatiquement si ça n'existe pas
        $parentImmobilier = Category::firstOrCreate(
            ['slug' => $parentDataImmobilier['slug']], // 1. La condition de recherche
            $parentDataImmobilier                   // 2. Les données à insérer si non trouvé
        );

        // L'ID est disponible immédiatement et de manière 100% sécurisée
        $parentImmobilierId = $parentImmobilier->id;

        $subcategoriesImmobilier = [
            // Services
            ['name' => 'Bien à Vendre', 'slug' => 'bien-a-vendre'],
            ['name' => 'Bien à Louer', 'slug' => 'bien-a-louer'],
            ['name' => 'Terrain', 'slug' => 'terrain'],
            ['name' => 'Bien Commercial', 'slug' => 'bien-commercial'],
            ['name' => 'Services-immobiliers', 'slug' => 'services-immobiliers']
        ];

        foreach ($subcategoriesImmobilier as $sub) {
            DB::table('categories')->insert([
                'name' => $sub['name'],
                'slug' => $sub['slug'],
                'parent_id' => $parentImmobilierId,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $parentDataEvenements = [
            'name' => 'Evenements',
            'slug' => 'evenements',
            'is_active' => true,
        ];

        // En une seule ligne : cherche par le slug, ou crée automatiquement si ça n'existe pas
        $parentEvenements = Category::firstOrCreate(
            ['slug' => $parentDataEvenements['slug']], // 1. La condition de recherche
            $parentDataEvenements                   // 2. Les données à insérer si non trouvé
        );

        // L'ID est disponible immédiatement et de manière 100% sécurisée
        $parentEvenementsId = $parentEvenements->id;

        $subcategoriesEvenements = [
            // Services
            ['name' => "Organisation d'évenements", 'slug' => 'organisation-d-evenements'],
            ['name' => 'Décoration', 'slug' => 'décoration'],
            ['name' => 'Traiteur Evenementiel', 'slug' => 'traiteur-evenementiel'],
            ['name' => 'DJ & Animation', 'slug' => 'dj-et-animation'],
            ['name' => 'Photo & Video', 'slug' => 'photo-et-video'],
            ['name' => "Salles d'evenements", 'slug' => 'salles-d-evenements'],
            ['name' => 'Location de matériel', 'slug' => 'location-de-materiel'],
            ['name' => 'Sécurité', 'slug' => 'sécurité'],
            ['name' => 'Services de mariage', 'slug' => 'services-de-mariage'],
            ['name' => "Evenements d'entreprise", 'slug' => 'evenements-d-entreprise'],
        ];

        foreach ($subcategoriesEvenements as $sub) {
            DB::table('categories')->insert([
                'name' => $sub['name'],
                'slug' => $sub['slug'],
                'parent_id' => $parentEvenementsId,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $parentDataSante = [
            'name' => 'Santé & Médical',
            'slug' => 'sante-et-medical',
            'is_active' => true,
        ];

        // En une seule ligne : cherche par le slug, ou crée automatiquement si ça n'existe pas
        $parentSante = Category::firstOrCreate(
            ['slug' => $parentDataSante['slug']], // 1. La condition de recherche
            $parentDataSante                   // 2. Les données à insérer si non trouvé
        );

        // L'ID est disponible immédiatement et de manière 100% sécurisée
        $parentSanteId = $parentSante->id;

        $subcategoriesSante = [
            // Services
            ['name' => "Pharmacies", 'slug' => 'pharmacies'],
            ['name' => 'Pro-pharmacies', 'slug' => 'pro-pharmacies'],
            ['name' => "Cliniques & centres de Santé", 'slug' => 'cliniques-et-centres-de-sante'],
            ['name' => "Equipements Médicaux", 'slug' => 'equipements-medicaux'],
            ['name' => "Produits Bien etre", 'slug' => 'produits-bien-etre'],
            ['name' => "Medecine Traditionnelle", 'slug' => 'medecine-traditionnelle']
        ];

        foreach ($subcategoriesSante as $sub) {
            DB::table('categories')->insert([
                'name' => $sub['name'],
                'slug' => $sub['slug'],
                'parent_id' => $parentSanteId,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }


        $parentIntrantsAgricoles = [
            'name' => 'Intrants Agricoles',
            'slug' => 'intrants-agricoles',
            'is_active' => true,
        ];

        // En une seule ligne : cherche par le slug, ou crée automatiquement si ça n'existe pas
        $parentDataIntrantsAgricoles = Category::firstOrCreate(
            ['slug' => $parentIntrantsAgricoles['slug']], // 1. La condition de recherche
            $parentIntrantsAgricoles                   // 2. Les données à insérer si non trouvé
        );

        // L'ID est disponible immédiatement et de manière 100% sécurisée
        $parentIntraAgricoleId = $parentDataIntrantsAgricoles->id;

        $subcategoriesIntraAgricole = [
            // Services
            ['name' => "Semences & Plants", 'slug' => 'semences-et-plants'],
            ['name' => 'Produits phytosanitaires', 'slug' => 'produits-phytosanitaires'],
            ['name' => "Engrais", 'slug' => 'engrais'],
            ['name' => "Equipements Agricole", 'slug' => 'equipements-agricole'],
            ['name' => "Aliments & Vétérinaire", 'slug' => 'aliments-et-veterinaire'],

        ];

        foreach ($subcategoriesIntraAgricole as $sub) {
            DB::table('categories')->insert([
                'name' => $sub['name'],
                'slug' => $sub['slug'],
                'parent_id' => $parentIntraAgricoleId,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $parentConstruction = [
            'name' => 'Construction',
            'slug' => 'construction',
            'is_active' => true,
        ];

        // En une seule ligne : cherche par le slug, ou crée automatiquement si ça n'existe pas
        $parentDataConstruction = Category::firstOrCreate(
            ['slug' => $parentConstruction['slug']], // 1. La condition de recherche
            $parentConstruction                   // 2. Les données à insérer si non trouvé
        );

        // L'ID est disponible immédiatement et de manière 100% sécurisée
        $parentConstructionId = $parentDataConstruction->id;

        $subcategoriesConstruction = [
            // Services
            ['name' => "Materiaux de construction", 'slug' => 'materiaux-de-construction'],
            ['name' => "Services de construction", 'slug' => 'services-de-construction'],
            ['name' => "Architecture et design", 'slug' => 'architecture-et-design'],
            ['name' => "Services d'ingénierie", 'slug' => 'services-d-ingenierie'],
            ['name' => "Renovation et finition", 'slug' => 'renovation-et-finition'],
            ['name' => "Outils et Equipements", 'slug' => 'outils-et-equipements'],
            ['name' => "Promotion immobiliere", 'slug' => 'promotion-immobiliere'],
            ['name' => "Projets d'infrastructures", 'slug' => 'projets-d-infrastructures'],
        ];

        foreach ($subcategoriesConstruction as $sub) {
            DB::table('categories')->insert([
                'name' => $sub['name'],
                'slug' => $sub['slug'],
                'parent_id' => $parentConstructionId,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}