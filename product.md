# Kelbom — Product Overview

Document de synthèse produit dérivé de l’analyse du dépôt `kelbom-api`. Il décrit ce que la plateforme vise à être, qui elle sert, et comment le code est structuré aujourd’hui.

---

## Vision

**Kelbom** est une place de marché en ligne qui reprend l’idée du **jour de marché** (« on se voit à Kelbom ») : un lieu de rencontre entre **acheteurs** et **vendeurs** (appelés **stands** dans le code), avec catalogue produits, profils de stands, avis, et **demandes d’achat** (type RFQ) lorsque l’acheteur ne trouve pas ce qu’il cherche.

Le positionnement narratif (page « Notre histoire ») est **Afrique / francophone**, avec une montée vers un « marché mondial ». Les prix produits sont affichés en **FCFA** ; les abonnements vendeur utilisent la devise **XOF** en base.

### Identité visuelle (produit)

Kelbom doit **se voir et se sentir africain** : jour de marché, étals, matière (terre, indigo, or du commerce), pas une marketplace générique importée. La charte détaillée (couleurs, typo, composants « étal / canopée », anti-clichés) est dans **[design.md](design.md)**. L’UI en code migre progressivement vers ces tokens (`indigo`, `shea`, `kola`, `laterite`, etc. dans `resources/css/app.css`).

---

## Acteurs

| Acteur | Rôle dans le produit |
|--------|----------------------|
| **Visiteur / acheteur** | Parcourt marketplace, produits, catégories, fiches stand ; publie une demande ; contacte Kelbom ; laisse des avis sur un stand. |
| **Vendeur (seller)** | S’inscrit, crée un **stand** (parcours multi-étapes), gère produits et vitrine ; accès dashboard web + API Sanctum. |
| **Administrateur** | Modère stands, produits, avis ; gère utilisateurs et catégories ; consulte demandes clients et messages contact. |
| **Acheteur (rôle `buyer`)** | Prévu dans les rôles Spatie ; usage front limité pour l’instant (pas de compte acheteur complet visible côté routes client). |
| **Livreur (`delivery_person`)** | Rôle seedé ; pas de parcours dédié visible dans les routes actuelles. |

---

## Surfaces applicatives

Architecture **multi-domaine** (`config/app.php`) :

| Domaine (défaut) | Contenu |
|------------------|---------|
| `APP_CLIENT_DOMAIN` → `kelbom.com` | Site public client + admin sous `/admin` |
| `APP_SELLER_DOMAIN` → `seller.kelbom.com` | Landing vendeur, auth, dashboard, CRUD stand/produits |
| `APP_API_DOMAIN` → `api.kelbom.com` | API JSON vendeur (préfixe `/seller`, Sanctum + rôle `seller`) |

### Site client (Blade + Alpine.js + Tailwind)

Routes principales (`routes/web.php`) :

- **Accueil** — stories, hero, stands premium, bannière promo, catégories, CTA demande.
- **Marketplace** — liste des stands vérifiés (filtres recherche, catégories, note).
- **Produits** — catalogue produits actifs (filtres prix, catégories, recherche).
- **Stand** `/stand/{slug}` — vitrine vendeur, onglets produits / avis, formulaire d’avis.
- **Catégorie** `/categorie/{slug}`.
- **Demande** `/demande` — publication d’une demande d’achat (catégorie, quantité, budget, urgence, contact…).
- **Contact** — formulaire contact.
- **Notre histoire** — storytelling de marque.

### Espace vendeur

- Inscription / connexion session web.
- **Création de stand** par étapes (`/stand/create`).
- **Dashboard** : statistiques, gestion produits (CRUD Blade), édition / aperçu stand.
- **Création stand** : routes publiques `/create` et `/stand/create` (sans connexion ; mot de passe demandé si visiteur). Dashboard / produits : `auth` + `seller.role` + `seller.stand`.
- Route intelligente `/access-route` pour orienter le CTA hero (login, register ou dashboard).

### Admin

Sous le domaine client, préfixe `/admin` (auth session séparée `admin-login`) :

- Dashboard, CRUD **utilisateurs**, **stands** (toggle statut), **produits** (liste / suppression / toggle), **catégories**, **demandes**, **contacts**, **avis** (modération).

> **Note :** `filament/filament` est présent dans `composer.json`, mais l’admin actuel est une **interface Blade custom** (`resources/views/admin/`, layout `layouts/admin.blade.php`). Filament n’est pas encore branché dans l’arborescence du projet.

### API vendeur

`routes/api.php` — endpoints REST pour dashboard stats, stand, produits (CRUD, statut, images). Prévu pour une app vendeur ou un front SPA consommant Sanctum.

---

## Modèle métier (domaine)

Entités centrales dans `app/Models/` :

- **User** — compte ; rôles Spatie (`admin`, `seller`, `buyer`, `delivery_person`).
- **Stand** — identité vendeur : nom, slug, logo, couverture, contacts, géolocalisation, vérification, notes agrégées, stats leads (`total_leads_viewed`, `total_leads_won`).
- **Product** — rattaché à un stand et une catégorie ; prix entiers, MOQ, unité, specs JSON, images, statuts (`active`, brouillon, etc.), compteurs vues / demandes.
- **Category** — hiérarchie possible (`parent_id`) ; liaison many-to-many stands.
- **Service** — services proposés par un stand (migration dédiée).
- **Review** — polymorphique (`reviewable`) sur stand (et produit côté modèle).
- **Request** — demande acheteur (lead entrant côté plateforme).
- **Contact** — messages formulaire contact.
- **Subscription** — abonnement par stand (plan, montant XOF, features JSON, dates, statut).
- **BuyleadCredit** — crédits pour consulter / « gagner » des leads (`available_credits`, achat / consommation).

Le modèle **Stand** expose déjà `hasEnoughCredits`, `consumeCredits`, `recalculateRating` — base d’un futur **marketplace de leads** (buy leads), partiellement câblé côté API (commentaire « Leads disponibles » sans routes finales).

---

## Parcours produit clés

1. **Découverte** → accueil ou marketplace → fiche stand → contact vendeur (WhatsApp, site, etc. champs stand).
2. **Achat guidé** → pas de panier checkout complet visible ; CTA **demande** si produit introuvable.
3. **Onboarding vendeur** → register → création stand → chargement / preview → dashboard produits.
4. **Monétisation (émergente)** → abonnements stand + crédits buylead pour accès aux opportunités commerciales.

---

## Stack technique

| Couche | Choix |
|--------|--------|
| Backend | Laravel 13, PHP 8.3+ |
| Auth API | Laravel Sanctum |
| Auth web | Session Laravel (client admin, vendeur) |
| Autorisations | Spatie Laravel Permission |
| BDD | SQLite par défaut (migrations MySQL-compatibles) |
| Front server-rendered | Blade, Alpine.js 3 (CDN), Tailwind CSS 4 (`@import 'tailwindcss'`, `@theme`) |
| Build | Vite |
| Icônes | `mallardduck/blade-lucide-icons` |
| Qualité | PHPUnit, Laravel Pint |
| Dev | `composer run dev` (serveur, queue, Pail, Vite) |

---

## État d’avancement (observé)

**En place :**

- Parcours client riche (UI), marketplace / produits / stand / demande / contact / about.
- Parcours vendeur (auth, stand multi-step, produits, preview).
- Admin de modération et gestion catalogue.
- API vendeur produits / stand / stats dashboard.
- Seeders rôles, admin, stands ; mails (`product-created`, `stand-created`).

**Partiel ou à venir :**

- Recherche header client (UI sans backend branché sur les listes).
- Panier / checkout (icône panier présente, pas de flux e-commerce complet).
- Routes API « buy leads » commentées / absentes.
- Permissions Spatie commentées dans le seeder (granularité fine non activée).
- Compte acheteur authentifié côté client.
- Filament listé en dépendance mais non utilisé pour l’admin.
- `GEMINI.md` mentionne Filament admin ; le code actuel contredit cette note.

---

## Structure repo (repères)

```
app/Http/Controllers/
  Client/     # Site public
  Seller/     # Espace vendeur web + logique partagée API
  Admin/      # Back-office
  Api/        # Contrôleurs API (ex. Stand\ProductController)
app/Models/   # Domaine métier
app/Http/Resources/  # Sérialisation API
routes/
  web.php, seller.php, admin.php, api.php
resources/views/
  client/, seller/, admin/, components/
database/migrations/  # Schéma stands, products, subscriptions, buylead_credits, etc.
```

---

## Glossaire interne

| Terme UI / code | Signification |
|-----------------|---------------|
| **Stand** | Boutique / vendeur sur la marketplace (modèle `Stand`, parfois `seller` dans les noms de variables). |
| **Demande** | RFQ acheteur (`Request` model). |
| **Buylead** | Crédit pour accéder à des leads commerciaux. |
| **Stand premium** | Mise en avant de stands sur l’accueil client. |

---

## Hypothèses produit (à valider avec l’équipe)

- Kelbom vise le **B2B et le semi-gros** (MOQ, demandes, stands) plutôt qu’un pure B2C one-click.
- La monétisation principale long terme combine **abonnement stand** et **crédits leads**.
- Le nom de dépôt `kelbom-api` reflète une origine **API-first vendeur**, alors que le repo contient désormais **trois fronts Blade** en plus de l’API.

---

*Dernière analyse : octobre 2026 — basée sur le code source du dépôt.*
