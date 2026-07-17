<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelbom - Tous les produits</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            -webkit-font-smoothing: antialiased;
        }
    </style>
</head>

<body class="bg-zinc-50 text-zinc-900 flex flex-col min-h-screen">

    <!-- Top Header -->
    <x-client.top-header />

    <!-- Main Header -->
    <x-client.header />

    <!-- Main Content -->
    <main class="flex-grow">

        <!-- Marketplace Hero Section -->
        <section
            class="relative bg-[#0A2E65] h-[300px] md:h-[350px] flex items-center justify-center overflow-hidden border-b border-zinc-200">
            <!-- Background Image with light opacity -->
            <img src="https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?q=80&w=1920&auto=format&fit=crop"
                alt="Products Background"
                class="absolute inset-0 w-full h-full object-cover opacity-20 transition-transform duration-[10s] hover:scale-105">

            <!-- Dark Overlay Gradient -->
            <div class="absolute inset-0 bg-gradient-to-t from-[#050B14] via-[#050B14]/40 to-transparent opacity-90">
            </div>

            <!-- Content -->
            <div class="relative z-10 text-center px-4 max-w-3xl mx-auto">
                <span
                    class="inline-block px-3 py-1 bg-white/10 text-white border border-white/20 text-[12px] font-bold uppercase tracking-widest rounded-full mb-5 backdrop-blur-sm shadow-sm">
                    Tous les Produits
                </span>
                <h1 class="text-4xl md:text-5xl font-black text-white mb-5 tracking-tight">
                    Trouvez ce qu'il vous faut
                </h1>
                <p class="text-[16px] md:text-lg text-blue-100 font-medium leading-relaxed max-w-2xl mx-auto">
                    Parcourez des milliers de produits proposés par nos stands vérifiés.
                </p>
            </div>
        </section>

        <!-- Products List Section -->
        <section class="max-w-[1400px] mx-auto px-4 md:px-8 py-12 flex flex-col lg:flex-row gap-8">

            <!-- Left Sidebar: Filters -->
            <aside class="lg:w-1/4 shrink-0">
                <form id="filter-form" action="{{ route('client.products') }}" method="GET"
                    class="bg-white rounded-2xl border border-zinc-200 p-6 sticky top-[100px]">
                    @if(request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-black text-zinc-900 flex items-center gap-2">
                            <svg class="w-5 h-5 text-zinc-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
                                </path>
                            </svg>
                            Filtres
                        </h3>
                        <button type="button"
                            class="text-[13px] font-bold text-blue-600 hover:text-blue-800 lg:hidden">Fermer</button>
                    </div>

                    <!-- Categories -->
                    <div class="mb-6">
                        <h4 class="font-bold text-zinc-800 text-[15px] mb-3">Catégories</h4>
                        <div class="space-y-3 max-h-[300px] overflow-y-auto pr-2 no-scrollbar">
                            @foreach($categories as $category)
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                        onchange="this.form.submit()" {{ in_array($category->id, request('categories', [])) ? 'checked' : '' }}
                                        class="w-4 h-4 rounded border-zinc-300 text-[#0A2E65] focus:ring-[#0A2E65] cursor-pointer">
                                    <span
                                        class="text-[14px] {{ in_array($category->id, request('categories', [])) ? 'text-zinc-900 font-medium' : 'text-zinc-600 group-hover:text-zinc-900' }} transition-colors">{{ $category->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <hr class="border-zinc-100 mb-6">

                    <!-- Price -->
                    <div class="mb-6">
                        <h4 class="font-bold text-zinc-800 text-[15px] mb-3">Gamme de Prix (FCFA)</h4>
                        <div class="flex items-center gap-3">
                            <div class="flex-1">
                                <input type="number" name="min_price" placeholder="Min" value="{{ request('min_price') }}"
                                    class="w-full h-10 px-3 text-[14px] border border-zinc-300 rounded-lg focus:ring-2 focus:ring-[#0A2E65] focus:border-[#0A2E65] outline-none transition-all">
                            </div>
                            <span class="text-zinc-400 font-medium">-</span>
                            <div class="flex-1">
                                <input type="number" name="max_price" placeholder="Max" value="{{ request('max_price') }}"
                                    class="w-full h-10 px-3 text-[14px] border border-zinc-300 rounded-lg focus:ring-2 focus:ring-[#0A2E65] focus:border-[#0A2E65] outline-none transition-all">
                            </div>
                        </div>
                        <button type="submit" class="w-full mt-4 py-2 bg-[#0A2E65] text-white text-[13px] font-bold rounded-lg hover:bg-blue-900 transition-colors">
                            Appliquer le prix
                        </button>
                    </div>

                    <a href="{{ route('client.products') }}"
                        class="block text-center w-full py-2.5 bg-zinc-50 hover:bg-zinc-100 text-zinc-700 font-bold rounded-xl border border-zinc-200 transition-colors text-[14px]">
                        Réinitialiser
                    </a>
                </form>
            </aside>

            <!-- Right Content: Products List -->
            <div class="lg:w-3/4">

                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl md:text-2xl font-black text-zinc-900">Tous les produits <span
                            class="text-zinc-500 font-medium text-base ml-2">({{ $products->total() }} résultats)</span>
                    </h2>
                    <!-- Mobile Filter Button -->
                    <button
                        class="lg:hidden flex items-center gap-2 px-4 py-2 bg-white border border-zinc-200 rounded-lg text-sm font-bold shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
                            </path>
                        </svg>
                        Filtres
                    </button>
                </div>

                <!-- Products Grid -->
                <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-6">
                    @forelse($products as $product)
                        <a href="#"
                            class="group bg-white rounded-2xl border border-zinc-200/80 overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col">
                            <div class="aspect-square bg-zinc-100 relative overflow-hidden">
                                <img src="{{ Str::startsWith($product->main_image_url, 'http') ? $product->main_image_url : Storage::url($product->main_image_url) }}"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                @if($product->compare_at_price > $product->price)
                                    <div class="absolute top-3 right-3 bg-red-500 text-white text-[11px] font-bold px-2 py-1 rounded-md shadow-sm">
                                        -{{ round((($product->compare_at_price - $product->price) / $product->compare_at_price) * 100) }}%
                                    </div>
                                @endif
                            </div>
                            <div class="p-4 flex flex-col flex-1">
                                <h3 class="font-bold text-zinc-900 text-[15px] group-hover:text-[#0A2E65] transition-colors line-clamp-2 leading-tight mb-2">
                                    {{ $product->name }}
                                </h3>
                                <div class="text-[12px] text-zinc-500 mb-3 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                    <span class="truncate">{{ $product->stand->stand_name ?? 'Kelbom' }}</span>
                                </div>
                                <div class="mt-auto pt-2 border-t border-zinc-100">
                                    <div class="text-[#0A2E65] font-black text-lg">{{ number_format($product->price, 0, ',', ' ') }} FCFA</div>
                                    @if($product->compare_at_price > $product->price)
                                        <div class="text-zinc-400 text-[12px] line-through">{{ number_format($product->compare_at_price, 0, ',', ' ') }} FCFA</div>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="col-span-2 sm:col-span-3 xl:col-span-4 py-16 text-center bg-white rounded-2xl border border-zinc-200 border-dashed">
                            <div class="w-16 h-16 bg-zinc-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-zinc-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-zinc-900 mb-2">Aucun produit trouvé</h3>
                            <p class="text-zinc-500">Modifiez vos filtres ou effectuez une autre recherche.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($products->hasPages())
                    <div class="mt-10">
                        {{ $products->links() }}
                    </div>
                @endif

            </div>

        </section>

    </main>

    <!-- Footer Component -->
    <x-client.footer />

</body>

</html>
