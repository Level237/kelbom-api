<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Produits | Kelbom</title>
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
        <main class="flex-1 p-4 md:p-8 w-full max-w-[1600px] mx-auto">

            @if (session('success'))
                <div
                    class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl font-bold text-sm shadow-sm flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            <!-- Header section -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-extrabold text-zinc-900 tracking-tight">Mes Produits</h1>
                    <p class="text-zinc-500 text-sm mt-1">Gérez votre catalogue, ajoutez de nouveaux articles et suivez
                        leurs performances.</p>
                </div>
                <div class="flex flex-wrap items-center gap-3 w-full sm:w-auto">
                    <button
                        class="flex-1 sm:flex-none px-4 py-2.5 bg-white border border-zinc-200 text-zinc-700 font-bold rounded-xl text-sm hover:bg-zinc-50 transition-colors shadow-sm flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                        </svg>
                        Importer
                    </button>
                    <a href="{{ route('seller.products.create') }}"
                        class="flex-1 sm:flex-none px-4 py-2.5 bg-[#0A2E65] hover:bg-zinc-900 text-white font-bold rounded-xl text-sm transition-all shadow-md active:scale-95 flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        Nouveau Produit
                    </a>
                </div>
            </div>

            <!-- Filters -->
            <form action="{{ route('seller.products.index') }}" method="GET"
                class="bg-white p-2 rounded-2xl border border-zinc-200/60 shadow-sm mb-6 flex flex-col sm:flex-row items-center gap-2">
                <div class="relative flex-1 w-full group">
                    <svg class="w-5 h-5 absolute left-3 top-1/2 -translate-y-1/2 text-zinc-400 group-focus-within:text-indigo-500 transition-colors"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Rechercher un produit..."
                        class="w-full pl-10 pr-4 py-2 bg-transparent border-none focus:ring-0 text-sm font-medium text-zinc-900 placeholder-zinc-400">
                </div>
                <div class="hidden sm:block w-px h-6 bg-zinc-200"></div>
                <div class="flex items-center gap-2 w-full sm:w-auto px-2">
                    <select name="status" onchange="this.form.submit()"
                        class="bg-transparent border-none text-sm font-medium text-zinc-600 focus:ring-0 cursor-pointer w-full sm:w-auto py-2">
                        <option value="">Tous les statuts</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Actif</option>
                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Brouillon</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactif</option>
                    </select>
                </div>
                <button type="submit" class="hidden">Filtrer</button>
            </form>

            <!-- Products Table -->
            <div class="bg-white rounded-[2rem] border border-zinc-200/60 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-zinc-50/50 border-b border-zinc-100">
                                <th class="px-6 py-4 text-xs font-semibold text-zinc-500 uppercase tracking-wider">
                                    Produit</th>
                                <th class="px-6 py-4 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Prix
                                </th>
                                <th class="px-6 py-4 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Vues
                                </th>
                                <th class="px-6 py-4 text-xs font-semibold text-zinc-500 uppercase tracking-wider">
                                    Demandes</th>
                                <th class="px-6 py-4 text-xs font-semibold text-zinc-500 uppercase tracking-wider">
                                    Statut</th>
                                <th
                                    class="px-6 py-4 text-xs font-semibold text-zinc-500 uppercase tracking-wider text-right">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-100">
                            @forelse ($products as $product)
                                <tr class="hover:bg-zinc-50/50 transition-colors group">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-4">
                                            <div
                                                class="w-12 h-12 rounded-xl bg-zinc-100 flex-shrink-0 flex items-center justify-center overflow-hidden border border-zinc-200/50">
                                                @if ($product->main_image_url)
                                                    <img src="{{ Storage::url($product->main_image_url) }}"
                                                        alt="{{ $product->name }}" class="w-full h-full object-cover">
                                                @else
                                                    <svg class="w-6 h-6 text-zinc-400" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                        </path>
                                                    </svg>
                                                @endif
                                            </div>
                                            <div>
                                                <p
                                                    class="text-sm font-bold text-zinc-900 group-hover:text-indigo-600 transition-colors">
                                                    {{ $product->name }}</p>
                                                <p class="text-xs text-zinc-500 mt-0.5 font-medium">Catégorie:
                                                    {{ $product->category?->name ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-sm font-bold text-zinc-900 font-mono">
                                            {{ number_format($product->price, 0, ',', ' ') }} FCFA</p>
                                        @if ($product->compare_at_price)
                                            <p class="text-xs text-zinc-400 line-through font-mono">
                                                {{ number_format($product->compare_at_price, 0, ',', ' ') }} FCFA</p>
                                        @endif
                                        
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-sm font-bold text-zinc-900 font-mono">
                                            {{ number_format($product->views_count, 0) }}</p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-sm font-bold text-zinc-900 font-mono">
                                            {{ number_format($product->inquiries_count, 0) }}</p>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($product->status == 'active')
                                            <span
                                                class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Actif
                                            </span>
                                        @elseif($product->status == 'draft')
                                            <span
                                                class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Brouillon
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-zinc-50 text-zinc-700 border border-zinc-200">
                                                <span class="w-1.5 h-1.5 rounded-full bg-zinc-400"></span> Inactif
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div
                                            class="flex items-center justify-end gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                            <a href="{{ route('seller.products.edit', $product) }}"
                                                class="p-2 text-zinc-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors"
                                                title="Modifier">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                                    </path>
                                                </svg>
                                            </a>
                                            <form action="{{ route('seller.products.destroy', $product) }}" method="POST"
                                                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="p-2 text-zinc-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                                    title="Supprimer">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-zinc-500 font-medium">
                                        Aucun produit trouvé.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if ($products->hasPages())
                    <div class="p-4 border-t border-zinc-100">
                        {{ $products->links() }}
                    </div>
                @endif
            </div>

        </main>
    </div>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>

</html>