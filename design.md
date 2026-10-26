# Kelbom — Charte graphique & design system

> **Statut : en attente** — priorité produit actuelle = simplifier la création de stand ([backlog.md](backlog.md)). Ne pas lancer la migration UI tant que ce chantier n’est pas livré.

**Register : brand + product** — Kelbom n’est pas un clone Alibaba / Amazon / Shopify. L’UI doit sentir le **jour de marché africain** : chaleur, densité humaine, géométrie des étals et des pergolas, indigo et terre — pas la froideur d’un SaaS bleu générique.

Ce document fixe la **direction cible**. L’implémentation actuelle (bleu `#0A2E65`, Plus Jakarta, grilles 4 colonnes blanches) est **legacy** : à migrer composant par composant.

---

## North Star (une phrase)

> Un acheteur ou un vendeur ouvre Kelbom comme on entre sous la **bâche d’un marché** : ombre fraîche, couleurs de la terre et de l’indigo, étals identifiables, rythme un peu décalé — jamais comme une marketplace importée d’ailleurs.

### Scène physique (référence lumière & mood)

- **Où :** marché couvert ou semi-ouvert, matinée avant la chaleur, poussière dorée (harmattan léger).
- **Lumière :** contrastes doux, pas de blanc clinique ; surfaces **crème shea**, ombres **chaudes**.
- **Ambiance :** vivant, confiant, pas « luxe safari » ni « startup SF dark mode ».

---

## Ce qu’on refuse (anti-références)

| Déjà vu | Pourquoi c’est hors sujet |
|---------|---------------------------|
| Marketplace blanche + bleu corporate + search pill Alibaba | Kelbom = marché, pas catalogue B2B chinois |
| Motifs « tribal » plaqués, zèbres, savane, masques stock | Décoratif, stéréotypé, non sémantique |
| Afrofuturisme violet néon / tracés or partout | Cliché « Wakanda UI kit » |
| Inter, Plus Jakarta, Roboto seuls | Typo globale sans identité |
| Grille parfaite 4×4 identique sur toute la page | Les marchés sont **irréguliers**, allées et étals décalés |
| Cartes `rounded-3xl shadow-sm` sans cadre | Trop « app 2023 » ; préférer **cadre d’étal** ( linteau, bandeau, poteau ) |
| Icônes Lucide seules, stroke uniforme | Acceptable en utilitaire ; l’identité vient de la **couleur, du cadre, du rythme** |

---

## Principes de design africanisé (sémantique, pas folklorique)

1. **Marché avant mall** — Chaque vendeur = **stand** avec fronton (couleur, nom, ville), pas une « product card » anonyme.
2. **Matériaux** — Laterite (terre cuite), indigo teint main, shea (crème), bois de baobab (texte), kola (or monétaire), palmier (succès / fraîcheur).
3. **Géométrie du tissé, pas du clipart** — Bandes diagonales **très subtiles** (5–8 % opacité), trames répétées en CSS ; jamais un PNG kente en fond full-screen.
4. **Rythme 3:2** — Espacements et colonnes qui **cassent la symétrie** (7/5, 5/7, étal qui déborde légèrement) — echo polyrythmique, pas rigueur suisse stricte.
5. **Langue visuelle francophone ouest-africain** — Badges « Jour K », « Stand vérifié », prix **FCFA** mis en avant typographiquement (chiffres larges, label petit).
6. **Symboles avec sens** — Si symboles Adinkra ou motifs géométriques : **un par écran max**, lié au sens (ex. confiance, échange), avec légende ou tooltip — pas wallpaper.
7. **Photo & illustration** — Vrais produits, vrais stands, mains, étoffes, marchés ; jamais banque d’images « African businessman handshake ».

---

## Stratégie couleur

**Committed palette** (~40 % surfaces teintées, pas le minimalisme « un accent à 10 % »).

### Rôles (tokens)

| Token | Hex | Sens | Usage |
|-------|-----|------|--------|
| **indigo** | `#1E3A5F` | Indigo marché / profondeur | Header, nav, liens forts, logo |
| **indigo-deep** | `#152A45` | Ombre sous la bâche | Footer, overlays, barre vendeur |
| **laterite** | `#C45C3E` | Terre cuite, chaleur | Accents étals, hover, filets, CTA secondaire chaud |
| **shea** | `#F5EDE0` | Crème beurre de karité | Fond page (remplace `zinc-50` froid) |
| **shea-dark** | `#EBE0D0` | Planches / allées | Zones alternées, search field |
| **kola** | `#D4A012` | Or du commerce | Prix, CTA « Publier une demande », étoiles |
| **kola-deep** | `#A67C00` | Pressé | Hover kola |
| **palm** | `#2D5A47` | Feuillage, confiance | Succès, vendeur vérifié, focus rings alternatifs |
| **bark** | `#3D2E24` | Écorce baobab | Texte principal sur shea |
| **harmattan** | `#8B7D6B` | Poussière, secondaire | Meta, labels, footer links |
| **night** | `#141010` | Nuit chaude | Rare ; hero vendeur, pas `#000` pur |

### Neutres

- Pas de `#FFFFFF` / `#000000` bruts : blanc **légèrement shea** (`#FFFBF7`), noir **night**.
- Texte sur indigo : `#F5EDE0` (pas gris bleuté froid).

### Legacy (migration)

| Ancien | Remplacer par |
|--------|----------------|
| `#0A2E65` | `indigo` |
| `#EAB308` / amber Tailwind | `kola` |
| `#FDFBF4` | `shea` |
| `bg-zinc-50` | `bg-shea` / `bg-kelbom-shea` |
| `text-zinc-900` | `text-bark` |

---

## Typographie

### Intent

Typo **contemporaine africaine** : géométrique mais humaine, titres avec ** présence ** (marché = on crie le prix, on lit le nom du stand de loin).

### Stack recommandée (Fontshare — gratuit, CDN)

| Rôle | Police | Graisses |
|------|--------|----------|
| **Display / titres** | [Clash Display](https://www.fontshare.com/fonts/clash-display) | 600, 700 |
| **UI / corps** | [Satoshi](https://www.fontshare.com/fonts/satoshi) | 400, 500, 700, 900 |
| **Chiffres & prix** | Satoshi **900** + `tabular-nums` | — |
| **Fallback système** | `ui-sans-serif` | — |

Chargement (layout client / seller) :

```html
<link href="https://api.fontshare.com/v2/css?f[]=satoshi@400,500,700,900&f[]=clash-display@600,700&display=swap" rel="stylesheet">
```

### Hiérarchie

| Élément | Style |
|---------|--------|
| H1 hero | `font-display text-4xl md:text-6xl font-bold tracking-tight text-bark` ou blanc sur indigo |
| Nom de stand | Clash Display, uppercase optionnel sur 1 mot |
| Corps | Satoshi 15–16px, `leading-relaxed` |
| Label marché | `text-xs font-bold uppercase tracking-[0.12em] text-harmattan` |
| Prix FCFA | `font-black tabular-nums text-kola` ; « FCFA » en `text-sm font-bold` |

**Abandonner** Plus Jakarta Sans sur le site public (admin peut rester sobre Satoshi-only).

---

## Grille & layout — « Allées et étals »

| Concept | Règle |
|---------|--------|
| **Conteneur** | `max-w-[1400px]` conservé, mais sections avec **bandes pleine largeur** shea / indigo alternées |
| **Étal (carte stand/produit)** | Classe `.kelbom-stall` : linteau coloré 4px (laterite OU indigo selon catégorie), corps shea-dark ou blanc cassé, ombre **chaude** `rgba(61,46,36,0.12)` |
| **Grille produits** | `grid-cols-2 md:grid-cols-3 lg:grid-cols-4` + **1 carte vedette** `md:col-span-2 md:row-span-2` sur l’accueil |
| **Asymétrie** | Hero accueil : 62/38 ou 7/5, pas 70/30 générique ; carousel latéral encadré comme **panneau d’annonce** marché |
| **Allée** | Espacement vertical généreux `py-14 md:py-20` entre « rangées » d’étals |

---

## Composants signature

### Canopée (top bar + header)

- Bandeau supérieur **indigo-deep** avec filet **laterite** 2px en bas (corde / bâche).
- Texte : « Le jour K — Ouvrez votre stand » (pas « Devenez vendeur » corporate).
- Header **shea** ou **blanc cassé**, bordure bark/10 ; logo = **carrefour** (4 chemins) + wordmark Kelbom, point en **kola**.

### Recherche

- Forme **rectangulaire adoucie** (`rounded-lg`), pas pill Silicon Valley.
- Fond `shea-dark`, icône loupe ; placeholder : « Qu’est-ce qu’on cherche au marché ? »

### Boutons

| Variant | Style |
|---------|--------|
| **Primaire** | `bg-indigo text-shea hover:bg-indigo-deep` ; coins `rounded-lg` |
| **Commerce (or)** | `bg-kola text-bark hover:bg-kola-deep` |
| **Terre** | `bg-laterite text-shea` — inscription vendeur, emphase humaine |
| **Ghost** | `text-indigo underline-offset-4 hover:underline` |

Éviter pills noirs type Apple sauf hero vendeur (nuit marché).

### CTA Demande (RFQ)

- Fond **indigo** + **motif weave** (utility CSS) ; titre Clash Display ; bouton **kola** ; copy : « Pas trouvé ? Criez votre besoin — les stands vous répondent. »

### Badge « Stand vérifié »

- `palm` + pictogramme simple (main + poignée / sceau), pas checkmark bleu générique seul.

### Footer

- `night` ou `indigo-deep`, liens `harmattan`, titres `shea` ; colonne « Villes » (Dakar, Abidjan, Lomé…) même si liens `#` au début — ancrage géographique.

---

## Motifs & texture (CSS only)

| Classe | Effet |
|--------|--------|
| `.kelbom-weave` | Trame diagonale 45°, laterite/indigo à 4–6 % opacité |
| `.kelbom-canopy-edge` | `border-bottom: 3px solid` + `repeating-linear-gradient` léger |
| `.kelbom-stall` | Linteau + ombre chaude (voir `@layer components` dans `app.css`) |

Pas de SVG motif répété lourd ; performance mobile d’abord.

---

## Motion

- **Entrée étal** : léger `translateY(8px)` + fade, stagger 50ms entre cartes (Alpine ou CSS).
- **Pas** de parallax agressif ni bounce elastique « dribbble 2020 ».
- **Carousel** : transition crossfade lente (700ms) — chaleur du jour qui avance.

---

## Iconographie

- Préférer **silhouettes pleines** simples (style signalétique marché) pour catégories clés.
- Lucide OK pour utilitaires (settings, trash).
- Couleur icône : `bark` ou `indigo`, pas multicolore enfantin.

---

## Admin & dashboard vendeur

- **Admin** : rester **product register** — Satoshi, fond `#F0E9DC` (shea assombri), accents indigo ; pas de décor marché lourd.
- **Dashboard vendeur** : touches **laterite + kola** (revenus, crédits leads) ; sidebar indigo-deep.

---

## Accessibilité

- Contraste bark sur shea ≥ WCAG AA pour corps ; kola sur bark pour boutons or vérifier AA.
- Focus : `ring-2 ring-palm ring-offset-2 ring-offset-shea`.
- `aria-label` sur icon-only ; ne pas coder l’info uniquement par la couleur (badges texte + couleur).

---

## Implémentation technique

### Tokens Tailwind 4

Définis dans `resources/css/app.css` (`@theme`) — utiliser `bg-indigo`, `text-kola`, `font-display`, etc.

### Ordre de migration UI

1. `app.css` tokens + utilities (fait en premier).
2. Layout partagé client (fonts Fontshare, `body` shea + bark).
3. `top-header`, `header`, `footer`, `request-cta`.
4. `homepage` (hero, stands premium, catégories).
5. Marketplace / fiche stand / seller landing.
6. Admin en dernier (surface outil).

### Checklist nouvelle page

1. Fond `bg-shea`, texte `text-bark`.
2. Fontshare Satoshi + Clash Display.
3. Section au moins une **asymétrie** ou un **linteau** d’étal.
4. CTA commerce en **kola**, navigation en **indigo**.
5. Copy en français marché (tu/vous selon ton produit — Kelbom = **vous** côté pro, **on** côté communauté).
6. Zéro hex legacy `#0A2E65` dans le diff.

---

## Logo (évolution suggérée)

- Abandonner le « K » startup gradient seul.
- Symbole : **carrefour de allées** (4 traits épais se croisant) dans un carré arrondi indigo, ou initiale K formée par deux bandes tissées.
- Wordmark : **Kelbom** Satoshi/Clash bold ; point final **kola** (pas blue-500 Tailwind).

---

## Références d’inspiration (mood, pas copie)

- Architecture des marchés couverts (Dantokpa, Sandaga, Makola) — **couloirs, pergolas, frontons**.
- Textile indigo (eg. pays dogon, boubou) — **profondeur de bleu**, pas flat #0066FF.
- Affiches peintes main — **typo bold**, hiérarchie claire.
- Design studios continentaux (identités fintech / retail UA, NG, SN, CI) — **couleur assumée**, pas minimalisme gris.

---

## État legacy (oct. 2026)

L’existant documenté précédemment (Plus Jakarta, zinc, `#0A2E65`, grilles symétriques) reste dans le code jusqu’à migration. **Toute nouvelle PR UI** doit suivre ce document, pas l’ancien checklist.

---

*Charte cible — Kelbom, marché digital africain.*
