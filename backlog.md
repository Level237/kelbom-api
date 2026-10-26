# Kelbom — Backlog produit & technique

Liste priorisée des chantiers. Mettre à jour au fil des livraisons (cocher / dater).

**Légende :** P0 = maintenant · P1 = juste après · P2 = plus tard · ⏸ = en attente explicite

---

## ⏸ En attente

| ID | Sujet | Notes |
|----|--------|--------|
| UI-AFR | Refonte UI « marché africain » | Charte dans [design.md](design.md), tokens partiels dans `app.css`. **Ne pas prioriser** avant le tunnel vendeur simplifié. |
| UI-MIG | Migration composants client/seller vers tokens `indigo` / `shea` / `kola` | Dépend de UI-AFR |

---

## P0 — Simplifier la création de stand (priorité actuelle)

### Contexte (état actuel)

Aujourd’hui un vendeur enchaîne :

1. **Inscription** (`AuthController@register`) : nom, téléphone, mot de passe.
2. **4 étapes** session (`StandController@create` / `storeStep`) :
   - Étape 1 : nom stand, **plusieurs catégories**, **description courte obligatoire**
   - Étape 2 : pays, ville, **zone obligatoire**, adresse optionnelle
   - Étape 3 : **téléphone (doublon)**, WhatsApp, email, **site web**
   - Étape 4 : **logo + bannière**, confirmation

Fichiers concernés : `app/Http/Controllers/Seller/StandController.php`, `resources/views/seller/create-stand.blade.php`, `components/seller/stand-creation-step-*.blade.php`, `seller/auth/register.blade.php`.

**Problèmes :** trop d’étapes, champs redondants (téléphone ×2), friction (zone, site, bannière) avant que le vendeur voie son stand en ligne.

### Vision cible (validée produit)

**Un seul écran (ou deux max)** après connexion / inscription, avec uniquement :

| Champ | Obligatoire | Notes |
|-------|-------------|--------|
| Nom de l’utilisateur | Oui | Déjà connu si inscrit → **pré-rempli**, modifiable |
| Nom du stand | Oui | |
| Logo / photo de profil stand | Recommandé | Peut être optionnel v1 avec avatar par défaut |
| Catégorie du stand | Oui | **Une** catégorie principale (à trancher : une seule vs plusieurs) |
| Pays | Oui | **Pré-rempli par géolocalisation**, modifiable |
| Ville | Oui | Saisie manuelle |
| Téléphone | Oui | **Pré-rempli depuis le compte** si déjà capturé à l’inscription |
| Email | Non | Optionnel |

**Retirer du parcours initial (report profil stand / dashboard) :** description longue, zone/quartier détaillé, adresse complète, WhatsApp, site web, **bannière cover**, étape 4 dédiée aux visuels.

**Géolocalisation :** au chargement du formulaire, proposer le pays (et si possible la ville) via navigateur + reverse geocoding ; l’utilisateur **confirme ou corrige** (ne jamais bloquer si refus GPS ou erreur).

### Avis / recommandations (alignées avec la vision)

- **Oui, simplifier ainsi** : c’est cohérent avec « ouvrir un étal rapidement » et réduit l’abandon.
- **Fusionner inscription + stand** (option forte) : un formulaire « Devenir vendeur » avec mot de passe + champs stand → une seule montée, au lieu register puis 4 steps.
- **Ne pas redemander le téléphone** si déjà sur `users.phone_number` ; afficher en lecture seule avec lien « modifier » si besoin.
- **Catégorie unique** au onboarding ; multi-catégories plus tard dans « Éditer le stand ».
- **Description** : vide ou phrase auto (« Stand {nom} — {catégorie} ») ; édition enrichie après création.
- **Logo optionnel v1** : évite de bloquer les vendeurs sur mobile ; inciter upload avec preview.
- **Géoloc** : prévoir fallback IP (service backend ou API tierce) + pays par défaut manuel ; message clair si permission refusée.
- **Conserver** : création `buyleadCredits`, mail admin, redirect `loading-stand` ou simplifier vers dashboard direct.

### Tâches P0 (ordre suggéré)

- [x] **P0-1** — Flux **1 page** (formulaire unique après auth)
- [x] **P0-2** — `CreateStandRequest`
- [x] **P0-3** — `StandController` : `store()` unique, plus de `storeStep` / session
- [x] **P0-4** — Vue `seller/create-stand.blade.php` ; steps supprimés
- [x] **P0-5** — Géoloc + `GET /geocode/reverse` (Nominatim côté serveur)
- [x] **P0-6** — Pays (`config/countries.php`) + ville texte
- [x] **P0-7** — Une catégorie (`category_id`)
- [x] **P0-8** — Logo optionnel ; pas de cover à la création
- [x] **P0-9** — Pré-remplissage nom / téléphone depuis `User`
- [x] **P0-10** — Tests `tests/Feature/Seller/CreateStandTest.php`
- [x] **P0-11** — Session `registered_seller_phone` retirée
- [x] **P0-12** — Enrichissement via `stand.edit` (déjà en place) ; `address` optionnel à l’update

### Critères d’acceptation P0

- Un nouveau vendeur crée un stand en **≤ 2 minutes** sans quitter un écran principal.
- Champs obligatoires = nom user, nom stand, catégorie, pays, ville, téléphone.
- Pays pré-rempli quand la géoloc réussit ; sinon saisie manuelle sans erreur bloquante.
- Plus de steps 1–4 ni champs zone / website / cover obligatoires à l’inscription stand.
- Stand visible (preview ou dashboard) immédiatement après submit.

---

## P1 — Vendeur & catalogue (après P0)

- [ ] Enrichissement profil stand (description, bannière, WhatsApp, site) depuis le dashboard
- [ ] Parcours « premier produit » guidé post-création stand
- [ ] API `POST /seller/stand` alignée sur le même payload que le web
- [ ] Finaliser routes **buy leads** (`buylead_credits`) côté API

---

## P1 — Client & marketplace

- [ ] Brancher la recherche header sur marketplace / produits
- [ ] Compte acheteur (rôle `buyer`) si nécessaire
- [ ] Notifications panier / demandes (aujourd’hui UI seulement)

---

## P2 — Admin & qualité

- [ ] Permissions Spatie granulaires (seed commenté)
- [ ] Filament vs admin Blade custom (décision architecture)
- [ ] Tests E2E parcours vendeur complet
- [ ] i18n FR formalisée (`APP_LOCALE=fr`)

---

## P2 — Infra & config

- [ ] Documenter `APP_CLIENT_DOMAIN`, `APP_SELLER_DOMAIN`, `APP_API_DOMAIN` dans `.env.example`
- [ ] Stockage images (S3) si prod

---

## Dette / bugs connus (à trier)

- `StandController@update` : incohérence `cover` vs `cover_image` sur upload
- `GEMINI.md` cite Filament admin ; code = Blade custom
- Locale app en `en` par défaut alors que l’UI est en français

---

## Journal

| Date | Changement |
|------|------------|
| 2026-10-17 | Création backlog ; UI africanisée en attente ; P0 = tunnel stand simplifié |
| 2026-10-17 | **P0 livré** — création stand en 1 écran, géoloc, tests OK |
| 2026-10-17 | Migrations alignées (users.name, stands legacy) + middleware `seller.role` / `seller.onboarding` / `seller.stand` |
