<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier {{ $product->name }} | Kelbom</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-[#f9fafb] text-zinc-900 font-sans antialiased" x-data="{ sidebarOpen: false }">

    <!-- Sidebar Mobile Overlay -->
    <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" @click="sidebarOpen = false"
        class="fixed inset-0 z-40 bg-zinc-900/40 backdrop-blur-sm lg:hidden"></div>

    <x-seller.dashboard.sidebar />

    <!-- Main Content -->
    <div class="lg:pl-72 flex flex-col min-h-screen">

        <!-- Top Header Component -->
        <x-seller.dashboard.header />

        <!-- Page Content -->
        <main class="flex-1 p-4 md:p-8 w-full max-w-[1400px] mx-auto">

            <form action="{{ route('seller.products.update', $product) }}" method="POST" enctype="multipart/form-data"
                x-data="{ 
                    mainPreview: '{{ Storage::url($product->main_image_url) }}',
                    galleryPreviews: [],
                    specs: {{ json_encode($product->specifications ?? [['key' => '', 'value' => '']]) }},
                    handleMainImage(e) {
                        const file = e.target.files[0];
                        if (file) {
                            this.mainPreview = URL.createObjectURL(file);
                        }
                    },
                    handleGalleryImages(e) {
                        const files = Array.from(e.target.files);
                        this.galleryPreviews = files.map(file => URL.createObjectURL(file));
                    }
                }">
                @csrf
                @method('PUT')
                <!-- Header section -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
                    <div class="flex items-center gap-3">
                        <a href="{{ route('seller.products.index') }}"
                            class="p-2 text-zinc-400 hover:text-zinc-900 bg-white rounded-xl border border-zinc-200 shadow-sm transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                        </a>
                        <div>
                            <h1 class="text-2xl font-extrabold text-zinc-900 tracking-tight">Modifier le produit</h1>
                            <p class="text-zinc-500 text-sm mt-1">Mettez à jour les informations de
                                {{ $product->name }}.</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 w-full sm:w-auto">
                        <a href="{{ route('seller.products.index') }}"
                            class="flex-1 sm:flex-none px-5 py-2.5 bg-white border border-zinc-200 text-zinc-700 font-bold rounded-xl text-sm hover:bg-zinc-50 transition-colors shadow-sm text-center">
                            Annuler
                        </a>
                        <button type="submit"
                            class="flex-1 sm:flex-none px-5 py-2.5 bg-[#0A2E65] hover:bg-zinc-900 text-white font-bold rounded-xl text-sm transition-all shadow-md active:scale-95 flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            Mettre à jour
                        </button>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="mb-8 p-4 bg-red-50 border border-red-200 rounded-2xl">
                        <ul class="list-disc list-inside text-sm text-red-600 font-medium">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    <!-- Colonne Principale -->
                    <div class="lg:col-span-2 space-y-8">

                        <!-- Informations de base -->
                        <div class="bg-white rounded-[2rem] border border-zinc-200/60 p-8 shadow-sm">
                            <h2 class="text-lg font-bold text-zinc-900 mb-6 flex items-center gap-2">
                                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Informations de base
                            </h2>
                            <div class="space-y-6">
                                <div>
                                    <label for="name" class="block text-sm font-bold text-zinc-700 mb-2">Nom du produit
                                        <span class="text-red-500">*</span></label>
                                    <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}"
                                        placeholder="Ex: iPhone 15 Pro Max 256Go"
                                        class="w-full px-4 py-3 bg-zinc-50 border border-zinc-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all text-zinc-900 placeholder-zinc-400 font-medium"
                                        required>
                                </div>
                                <div>
                                    <label for="description"
                                        class="block text-sm font-bold text-zinc-700 mb-2">Description</label>
                                    <textarea id="description" name="description" rows="5"
                                        placeholder="Décrivez votre produit en détail..."
                                        class="w-full px-4 py-3 bg-zinc-50 border border-zinc-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all text-zinc-900 placeholder-zinc-400 font-medium resize-y">{{ old('description', $product->description) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Médias (Images) -->
                        <div class="bg-white rounded-[2rem] border border-zinc-200/60 p-8 shadow-sm">
                            <h2 class="text-lg font-bold text-zinc-900 mb-6 flex items-center gap-2">
                                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                Médias
                            </h2>

                            <!-- Image Principale -->
                            <div class="mb-8">
                                <label class="block text-sm font-bold text-zinc-700 mb-3">Image principale</label>
                                <div class="relative group">
                                    <input type="file" id="main_image" name="main_image" @change="handleMainImage"
                                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
                                        :class="mainPreview ? 'pointer-events-none' : ''" accept="image/*">

                                    <div x-show="!mainPreview"
                                        class="border-2 border-dashed border-zinc-300 bg-zinc-50 hover:bg-zinc-100 transition-colors rounded-2xl p-10 flex flex-col items-center justify-center text-center relative min-h-[200px]">
                                        <div
                                            class="w-16 h-16 bg-white rounded-full flex items-center justify-center shadow-sm border border-zinc-200 mb-4 group-hover:scale-110 transition-transform">
                                            <svg class="w-8 h-8 text-indigo-500" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12">
                                                </path>
                                            </svg>
                                        </div>
                                        <h3 class="text-sm font-bold text-zinc-900 mb-1">Modifier l'image principale
                                        </h3>
                                    </div>

                                    <div x-show="mainPreview"
                                        class="relative rounded-2xl overflow-hidden border border-zinc-200 shadow-sm aspect-video bg-zinc-100"
                                        x-cloak>
                                        <img :src="mainPreview" class="w-full h-full object-contain">
                                        <div class="absolute top-4 right-4 flex gap-2">
                                            <button type="button"
                                                @click="mainPreview = null; document.getElementById('main_image').value = ''"
                                                class="p-2 bg-red-500 text-white rounded-xl shadow-lg hover:bg-red-600 transition-colors z-20">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Galerie d'images existantes -->
                            <div class="mb-8">
                                <label class="block text-sm font-bold text-zinc-700 mb-3">Galerie actuelle</label>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                    @foreach ($product->images as $image)
                                        <div
                                            class="relative rounded-xl overflow-hidden border border-zinc-200 aspect-square bg-zinc-50 group">
                                            <img src="{{ $image->image_url }}" class="w-full h-full object-cover">
                                        </div>
                                    @endforeach

                                    <div
                                        class="border-2 border-dashed border-zinc-300 bg-zinc-50 hover:bg-zinc-100 transition-colors rounded-xl flex flex-col items-center justify-center text-center cursor-pointer relative aspect-square group">
                                        <input type="file" name="images[]" multiple @change="handleGalleryImages"
                                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                            accept="image/*">
                                        <svg class="w-6 h-6 text-zinc-400 group-hover:text-indigo-500 transition-colors"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4"></path>
                                        </svg>
                                        <span class="text-[10px] font-bold text-zinc-500 mt-2">Ajouter</span>
                                    </div>
                                </div>
                                <template x-if="galleryPreviews.length > 0">
                                    <div class="mt-4">
                                        <p class="text-xs font-bold text-indigo-600 mb-2">Nouvelles images à ajouter :
                                        </p>
                                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                            <template x-for="(preview, index) in galleryPreviews" :key="index">
                                                <div
                                                    class="relative rounded-xl overflow-hidden border border-indigo-200 aspect-square bg-zinc-50">
                                                    <img :src="preview" class="w-full h-full object-cover">
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <!-- Tarification -->
                        <div class="bg-white rounded-[2rem] border border-zinc-200/60 p-8 shadow-sm">
                            <h2 class="text-lg font-bold text-zinc-900 mb-6 flex items-center gap-2">
                                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                                Tarification
                            </h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="price" class="block text-sm font-bold text-zinc-700 mb-2">Prix de vente
                                        (FCFA) <span class="text-red-500">*</span></label>
                                    <input type="number" id="price" name="price"
                                        value="{{ old('price', $product->price) }}" placeholder="0" min="0"
                                        class="w-full px-4 py-3 bg-zinc-50 border border-zinc-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all text-zinc-900 font-bold font-mono"
                                        required>
                                </div>
                                <div>
                                    <label for="compare_at_price"
                                        class="block text-sm font-bold text-zinc-700 mb-2">Prix barré (FCFA)</label>
                                    <input type="number" id="compare_at_price" name="compare_at_price"
                                        value="{{ old('compare_at_price', $product->compare_at_price) }}"
                                        placeholder="0" min="0"
                                        class="w-full px-4 py-3 bg-zinc-50 border border-zinc-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all text-zinc-900 font-bold font-mono">
                                </div>
                            </div>
                        </div>

                        <!-- Ventes & Unité -->
                        <div class="bg-white rounded-[2rem] border border-zinc-200/60 p-8 shadow-sm">
                            <h2 class="text-lg font-bold text-zinc-900 mb-6 flex items-center gap-2">
                                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                Ventes & Unités
                            </h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="min_order_quantity"
                                        class="block text-sm font-bold text-zinc-700 mb-2">Quantité minimum</label>
                                    <input type="number" id="min_order_quantity" name="min_order_quantity"
                                        value="{{ old('min_order_quantity', $product->min_order_quantity) }}" min="1"
                                        class="w-full px-4 py-3 bg-zinc-50 border border-zinc-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all text-zinc-900 font-bold font-mono">
                                </div>
                                <div>
                                    <label for="unit" class="block text-sm font-bold text-zinc-700 mb-2">Unité</label>
                                    <input type="text" id="unit" name="unit" value="{{ old('unit', $product->unit) }}"
                                        placeholder="Ex: Pièce, Kg..."
                                        class="w-full px-4 py-3 bg-zinc-50 border border-zinc-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all text-zinc-900 font-medium">
                                </div>
                            </div>
                        </div>

                        <!-- Spécifications -->
                        <div class="bg-white rounded-[2rem] border border-zinc-200/60 p-8 shadow-sm">
                            <h2 class="text-lg font-bold text-zinc-900 mb-6 flex items-center gap-2">
                                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                    </path>
                                </svg>
                                Spécifications
                            </h2>
                            <template x-for="(spec, index) in specs" :key="index">
                                <div class="flex items-center gap-3 mb-3">
                                    <input type="text" :name="`specifications[${index}][key]`" x-model="spec.key"
                                        placeholder="Clé"
                                        class="flex-1 px-4 py-2.5 bg-zinc-50 border border-zinc-200 rounded-xl text-sm focus:outline-none focus:border-indigo-500 text-zinc-900 font-medium">
                                    <input type="text" :name="`specifications[${index}][value]`" x-model="spec.value"
                                        placeholder="Valeur"
                                        class="flex-1 px-4 py-2.5 bg-zinc-50 border border-zinc-200 rounded-xl text-sm focus:outline-none focus:border-indigo-500 text-zinc-900 font-medium">
                                    <button type="button" @click="specs.splice(index, 1)"
                                        class="p-2 text-zinc-400 hover:text-red-500 bg-zinc-50 hover:bg-red-50 rounded-xl transition-colors shrink-0">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </template>
                            <button type="button" @click="specs.push({key: '', value: ''})"
                                class="mt-2 text-sm font-bold text-indigo-600 hover:text-indigo-800 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                                Ajouter une spécification
                            </button>
                        </div>
                    </div>

                    <!-- Colonne Latérale -->
                    <div class="space-y-8">
                        <!-- Statut -->
                        <div class="bg-white rounded-[2rem] border border-zinc-200/60 p-8 shadow-sm">
                            <h2 class="text-lg font-bold text-zinc-900 mb-6">Statut</h2>
                            <div class="space-y-4">
                                @foreach(['active' => 'Actif', 'draft' => 'Brouillon', 'inactive' => 'Inactif'] as $val => $label)
                                    <label
                                        class="flex items-center gap-3 p-4 border border-zinc-200 rounded-xl cursor-pointer hover:bg-zinc-50 transition-colors has-[:checked]:border-indigo-500 has-[:checked]:bg-indigo-50/50">
                                        <input type="radio" name="status" value="{{ $val }}" {{ old('status', $product->status) == $val ? 'checked' : '' }}
                                            class="w-5 h-5 text-indigo-600 border-zinc-300 focus:ring-indigo-500">
                                        <span class="text-sm font-bold text-zinc-900">{{ $label }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Catégorie -->
                        <div class="bg-white rounded-[2rem] border border-zinc-200/60 p-8 shadow-sm">
                            <h2 class="text-lg font-bold text-zinc-900 mb-6">Catégorie</h2>
                            <select id="category_id" name="category_id"
                                class="w-full px-4 py-3 bg-zinc-50 border border-zinc-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all text-zinc-900 font-medium"
                                required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </form>
        </main>
    </div>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>

</html>