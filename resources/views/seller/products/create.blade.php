<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau produit | Kelbom</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif; }
        .field {
            width: 100%;
            min-height: 48px;
            padding: 0 14px;
            border-radius: 12px;
            border: 1px solid #e6e2da;
            background: #fff;
            color: #1c1917;
            font-size: 15px;
            outline: none;
            transition: border-color .15s, box-shadow .15s;
        }
        .field:focus {
            border-color: #1e3a5f;
            box-shadow: 0 0 0 4px rgba(30, 58, 95, 0.12);
        }
        .field-label {
            display: block;
            margin-bottom: 6px;
            font-size: 13px;
            font-weight: 600;
            color: #3d2e24;
        }
        textarea.field { padding: 12px 14px; min-height: 120px; resize: vertical; }
    </style>
</head>

<body class="bg-[#f4f1ea] text-bark antialiased pb-24 lg:pb-8" x-data="{ sidebarOpen: false }">

    <div x-show="sidebarOpen" x-transition.opacity @click="sidebarOpen = false"
        class="fixed inset-0 z-40 bg-night/40 backdrop-blur-sm lg:hidden"></div>

    <x-seller.dashboard.sidebar />

    <div class="lg:pl-72 flex flex-col min-h-screen">
        <x-seller.dashboard.header />

        <main class="flex-1 p-4 md:p-8 w-full max-w-[1280px] mx-auto">

            <form action="{{ route('seller.products.store') }}" method="POST" enctype="multipart/form-data"
                x-data="productCreateForm()"
                class="relative">
                @csrf

                <section class="mb-6 rounded-2xl border border-[#e7e2d8] bg-white p-5 sm:p-6 shadow-sm">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <a href="{{ route('seller.products.index') }}" class="text-xs font-semibold text-indigo hover:underline">← Produits</a>
                            <h1 class="mt-1 text-xl sm:text-2xl font-semibold text-indigo-deep">Nouveau produit</h1>
                            <p class="mt-1 text-sm text-harmattan">Commencez par le nom, puis le prix, la catégorie et les photos.</p>
                        </div>
                        <div class="hidden sm:flex items-center gap-3">
                            <a href="{{ route('seller.products.index') }}"
                                class="inline-flex h-12 items-center rounded-xl border border-[#e6e2da] px-5 text-sm font-semibold text-bark hover:bg-[#faf8f4]">
                                Annuler
                            </a>
                            <button type="submit"
                                class="inline-flex h-12 items-center gap-2 rounded-xl bg-indigo px-6 text-sm font-semibold text-shea hover:bg-indigo-deep">
                                Publier le produit
                            </button>
                        </div>
                    </div>
                </section>

                @if ($errors->any())
                    <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                        <p class="font-semibold mb-1">Corrigez les champs suivants</p>
                        <ul class="list-disc list-inside space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mx-auto max-w-3xl space-y-6">

                        <section class="rounded-2xl border border-[#e7e2d8] bg-white p-5 sm:p-6 shadow-sm">
                            <label for="name" class="field-label">Nom du produit <span class="text-laterite">*</span></label>
                            <input type="text" id="name" name="name" x-model="name"
                                placeholder="Ex : Sac en wax premium" class="field text-base font-semibold" required autofocus>
                            <div class="mt-4">
                                <label for="category_id" class="field-label">Catégorie <span class="text-laterite">*</span></label>
                                <select id="category_id" name="category_id" x-model="categoryId" class="field" required>
                                    <option value="">Choisir…</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-4">
                                <label for="description" class="field-label">Description</label>
                                <textarea id="description" name="description" x-model="description" rows="4"
                                    placeholder="Matériaux, usages, délais de livraison…" class="field"></textarea>
                            </div>
                        </section>

                        <section class="rounded-2xl border border-[#e7e2d8] bg-white p-5 sm:p-6 shadow-sm">
                            <h2 class="text-sm font-semibold text-indigo-deep mb-4">Prix & vente</h2>
                            <div class="grid gap-4 sm:grid-cols-2">
                                <div>
                                    <label for="price" class="field-label">Prix (FCFA) <span class="text-laterite">*</span></label>
                                    <input type="number" id="price" name="price" x-model="price" min="0" placeholder="15000" class="field font-semibold tabular-nums" required>
                                </div>
                                <div>
                                    <label for="compare_at_price" class="field-label">Prix barré (FCFA)</label>
                                    <input type="number" id="compare_at_price" name="compare_at_price" x-model="comparePrice" min="0" placeholder="18000" class="field font-semibold tabular-nums">
                                </div>
                                <div>
                                    <label for="min_order_quantity" class="field-label">Quantité minimum</label>
                                    <input type="number" id="min_order_quantity" name="min_order_quantity" x-model="moq" min="1" class="field">
                                </div>
                                <div>
                                    <label for="unit" class="field-label">Unité</label>
                                    <input type="text" id="unit" name="unit" x-model="unit" placeholder="Pièce, kg, lot…" class="field">
                                </div>
                            </div>
                        </section>

                        <section class="rounded-2xl border border-[#e7e2d8] bg-white p-5 sm:p-6 shadow-sm">
                            <h2 class="text-sm font-semibold text-indigo-deep">Photos</h2>
                            <p class="mt-0.5 mb-5 text-xs text-harmattan">L’image principale s’affiche sur la marketplace.</p>
                            <label class="group relative mb-5 block cursor-pointer overflow-hidden rounded-2xl border border-dashed border-[#cfc8bc] bg-[#faf8f4] transition hover:border-indigo hover:bg-white">
                                <input type="file" id="main_image" name="main_image" accept="image/*" class="sr-only" @change="handleMainImage($event)">
                                <template x-if="mainPreview">
                                    <div class="relative aspect-[16/10]">
                                        <img :src="mainPreview" alt="" class="h-full w-full object-cover">
                                        <span class="absolute bottom-4 left-4 rounded-lg bg-white/95 px-3 py-1.5 text-xs font-semibold text-indigo-deep shadow-sm">Changer l’image</span>
                                        <button type="button" @click.prevent="clearMain()"
                                            class="absolute top-3 right-3 rounded-lg bg-white/95 p-2 text-red-600 shadow-sm hover:bg-white">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                        </button>
                                    </div>
                                </template>
                                <template x-if="!mainPreview">
                                    <div class="flex aspect-[16/10] flex-col items-center justify-center gap-2 p-6 text-center">
                                        <p class="text-sm font-semibold text-bark">Image principale</p>
                                        <p class="text-xs text-harmattan">Cliquez pour choisir une photo</p>
                                    </div>
                                </template>
                            </label>
                            <p class="mb-3 text-xs font-semibold text-bark">Galerie (optionnel)</p>
                            <div class="grid grid-cols-3 sm:grid-cols-4 gap-3">
                                <template x-for="(preview, index) in galleryPreviews" :key="index">
                                    <div class="relative aspect-square overflow-hidden rounded-xl border border-[#e7e2d8]">
                                        <img :src="preview" class="h-full w-full object-cover">
                                    </div>
                                </template>
                                <label class="relative flex aspect-square cursor-pointer flex-col items-center justify-center rounded-xl border border-dashed border-[#cfc8bc] bg-[#faf8f4] text-harmattan hover:border-indigo hover:text-indigo">
                                    <input type="file" name="images[]" multiple accept="image/*" class="sr-only" @change="handleGalleryImages($event)">
                                    <span class="text-[11px] font-semibold">Ajouter</span>
                                </label>
                            </div>
                        </section>

                        <section class="rounded-2xl border border-[#e7e2d8] bg-white p-5 sm:p-6 shadow-sm">
                            <div class="mb-4 flex items-center justify-between gap-3">
                                <h2 class="text-sm font-semibold text-indigo-deep">Caractéristiques</h2>
                                <button type="button" @click="specs.push({key: '', value: ''})"
                                    class="text-xs font-semibold text-indigo hover:underline">+ Ajouter</button>
                            </div>
                            <template x-for="(spec, index) in specs" :key="index">
                                <div class="mb-3 grid gap-2 sm:grid-cols-[1fr_1fr_auto]">
                                    <input type="text" :name="`specifications[${index}][key]`" x-model="spec.key" placeholder="Ex : Matière" class="field">
                                    <input type="text" :name="`specifications[${index}][value]`" x-model="spec.value" placeholder="Ex : Coton" class="field">
                                    <button type="button" @click="specs.splice(index, 1)" class="flex h-12 items-center justify-center rounded-xl border border-[#e6e2da] text-harmattan hover:border-red-200 hover:text-red-600 sm:w-12">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                    </button>
                                </div>
                            </template>
                        </section>

                        <section class="rounded-2xl border border-[#e7e2d8] bg-white p-5 sm:p-6 shadow-sm">
                            <h2 class="text-sm font-semibold text-indigo-deep mb-3">Visibilité</h2>
                            <div class="space-y-2">
                                <label class="flex cursor-pointer items-start gap-3 rounded-xl border border-[#e6e2da] p-3 transition has-[:checked]:border-indigo has-[:checked]:bg-indigo/5">
                                    <input type="radio" name="status" value="active" x-model="status" class="mt-1 text-indigo focus:ring-indigo">
                                    <span><span class="block text-sm font-semibold">Actif</span><span class="text-xs text-harmattan">Visible sur la marketplace</span></span>
                                </label>
                                <label class="flex cursor-pointer items-start gap-3 rounded-xl border border-[#e6e2da] p-3 transition has-[:checked]:border-indigo has-[:checked]:bg-indigo/5">
                                    <input type="radio" name="status" value="draft" x-model="status" class="mt-1 text-indigo focus:ring-indigo">
                                    <span><span class="block text-sm font-semibold">Brouillon</span><span class="text-xs text-harmattan">Enregistré, non publié</span></span>
                                </label>
                                <label class="flex cursor-pointer items-start gap-3 rounded-xl border border-[#e6e2da] p-3 transition has-[:checked]:border-laterite has-[:checked]:bg-laterite/5">
                                    <input type="radio" name="status" value="inactive" x-model="status" class="mt-1 text-laterite focus:ring-laterite">
                                    <span><span class="block text-sm font-semibold">Inactif</span><span class="text-xs text-harmattan">Retiré temporairement</span></span>
                                </label>
                            </div>
                        </section>
                </div>

                {{-- Barre fixe mobile --}}
                <div class="fixed inset-x-0 bottom-0 z-30 border-t border-[#e7e2d8] bg-white/95 p-4 backdrop-blur-md sm:hidden">
                    <div class="flex gap-3">
                        <a href="{{ route('seller.products.index') }}" class="flex h-12 flex-1 items-center justify-center rounded-xl border border-[#e6e2da] text-sm font-semibold text-bark">Annuler</a>
                        <button type="submit" class="flex h-12 flex-[2] items-center justify-center gap-2 rounded-xl bg-indigo text-sm font-semibold text-shea shadow-md">Publier</button>
                    </div>
                </div>
            </form>
        </main>
    </div>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        function productCreateForm() {
            return {
                name: @js(old('name', '')),
                description: @js(old('description', '')),
                price: @js(old('price', '')),
                comparePrice: @js(old('compare_at_price', '')),
                unit: @js(old('unit', '')),
                moq: @js(old('min_order_quantity', 1)),
                categoryId: @js((string) old('category_id', '')),
                status: @js(old('status', 'draft')),
                mainPreview: null,
                galleryPreviews: [],
                specs: [{ key: '', value: '' }],

                get statusLabel() {
                    return { active: 'En ligne', draft: 'Brouillon', inactive: 'Inactif' }[this.status] || 'Brouillon';
                },
                get formattedPrice() {
                    const n = Number(this.price);
                    return Number.isFinite(n) && n > 0
                        ? new Intl.NumberFormat('fr-FR').format(n) + ' FCFA'
                        : '— FCFA';
                },
                get formattedCompare() {
                    const n = Number(this.comparePrice);
                    return Number.isFinite(n) ? new Intl.NumberFormat('fr-FR').format(n) + ' FCFA' : '';
                },
                handleMainImage(e) {
                    const file = e.target.files[0];
                    if (file) this.mainPreview = URL.createObjectURL(file);
                },
                clearMain() {
                    this.mainPreview = null;
                    const input = document.getElementById('main_image');
                    if (input) input.value = '';
                },
                handleGalleryImages(e) {
                    this.galleryPreviews = Array.from(e.target.files).map(f => URL.createObjectURL(f));
                },
            };
        }
    </script>
</body>

</html>
