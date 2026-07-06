<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelbom - Marketplace</title>

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
            class="relative bg-[#050B14] h-[300px] md:h-[400px] flex items-center justify-center overflow-hidden border-b border-zinc-200">
            <!-- Background Image with light opacity -->
            <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?q=80&w=1920&auto=format&fit=crop"
                alt="Marketplace Background"
                class="absolute inset-0 w-full h-full object-cover opacity-20 transition-transform duration-[10s] hover:scale-105">

            <!-- Dark Overlay Gradient -->
            <div class="absolute inset-0 bg-gradient-to-t from-[#050B14] via-[#050B14]/60 to-transparent opacity-90">
            </div>

            <!-- Content -->
            <div class="relative z-10 text-center px-4 max-w-3xl mx-auto">
                <span
                    class="inline-block px-3 py-1 bg-blue-500/20 text-blue-200 border border-blue-500/30 text-[12px] font-bold uppercase tracking-widest rounded-full mb-5 backdrop-blur-sm shadow-sm">
                    Catalogue Kelbom
                </span>
                <h1 class="text-4xl md:text-5xl font-black text-white mb-5 tracking-tight">
                    Explorez la Marketplace
                </h1>
                <p class="text-[16px] md:text-lg text-blue-100/90 font-medium leading-relaxed max-w-2xl mx-auto">
                    Découvrez des milliers de stands, produits exclusifs et fournisseurs à travers le monde. Trouvez
                    exactement ce qu'il vous faut en quelques clics.
                </p>
            </div>
        </section>

        <!-- Stands List Section -->
        <section class="max-w-[1400px] mx-auto px-4 md:px-8 py-12 flex flex-col lg:flex-row gap-8">

            <!-- Left Sidebar: Filters -->
            <aside class="lg:w-1/4 shrink-0">
                <form id="filter-form" action="{{ route('client.marketplace') }}" method="GET"
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

                    <!-- Rating -->
                    <div class="mb-6">
                        <h4 class="font-bold text-zinc-800 text-[15px] mb-3">Évaluation minimale</h4>
                        <div class="space-y-3">
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" name="rating" value="4" onchange="this.form.submit()" {{ request('rating') == '4' ? 'checked' : '' }}
                                    class="w-4 h-4 text-[#0A2E65] focus:ring-[#0A2E65] border-zinc-300 cursor-pointer">
                                <div class="flex items-center gap-1">
                                    <svg class="w-4 h-4 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                    <span class="text-[14px] text-zinc-600 group-hover:text-zinc-900">4 étoiles &
                                        plus</span>
                                </div>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" name="rating" value="3" onchange="this.form.submit()" {{ request('rating') == '3' ? 'checked' : '' }}
                                    class="w-4 h-4 text-[#0A2E65] focus:ring-[#0A2E65] border-zinc-300 cursor-pointer">
                                <div class="flex items-center gap-1">
                                    <svg class="w-4 h-4 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                    <span class="text-[14px] text-zinc-600 group-hover:text-zinc-900">3 étoiles &
                                        plus</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <a href="{{ route('client.marketplace') }}"
                        class="block text-center w-full py-2.5 bg-zinc-50 hover:bg-zinc-100 text-zinc-700 font-bold rounded-xl border border-zinc-200 transition-colors text-[14px]">
                        Réinitialiser
                    </a>
                </form>
            </aside>

            <!-- Right Content: Stands List -->
            <div class="lg:w-3/4">

                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl md:text-2xl font-black text-zinc-900">Tous les stands <span
                            class="text-zinc-500 font-medium text-base ml-2">({{ $stands->total() }} résultats)</span>
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

                <!-- Stands Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                    @forelse($stands as $stand)
                        <a href="{{ route('client.stand.show', $stand->slug) }}"
                            class="group bg-white rounded-2xl border border-zinc-200/80 overflow-hidden shadow-sm hover:shadow-xl hover:shadow-[#0A2E65]/5 hover:-translate-y-1 transition-all duration-300 flex flex-col">
                            <!-- Top Section: Cover & Avatar -->
                            <div class="relative">
                                <!-- Cover / Banner -->
                                <div class="h-28 bg-zinc-100 relative overflow-hidden">
                                    <img src="{{ Str::startsWith($stand->cover_url, 'http') ? $stand->cover_url : Storage::url($stand->cover_url) }}"
                                        alt="Cover {{ $stand->stand_name }}"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                    <div
                                        class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors duration-300">
                                    </div>
                                </div>
                                <!-- Logo Avatar -->
                                <div class="absolute -bottom-6 left-5 z-20">
                                    <div
                                        class="w-[60px] h-[60px] rounded-xl border-4 border-white bg-white shadow-sm overflow-hidden group-hover:scale-105 group-hover:shadow-md transition-all duration-300 flex items-center justify-center font-bold text-xl text-[#0A2E65]">
                                        @if($stand->logo_url)
                                            <img src="{{ Str::startsWith($stand->logo_url, 'http') ? $stand->logo_url : Storage::url($stand->logo_url) }}"
                                                alt="{{ $stand->stand_name }}" class="w-full h-full object-cover">
                                        @else
                                            {{ strtoupper(substr($stand->stand_name, 0, 1)) }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- Details -->
                            <div class="pt-9 pb-5 px-5 flex-1 flex flex-col">
                                <div class="flex justify-between items-start mb-3">
                                    <div>
                                        <h3
                                            class="font-bold text-zinc-900 text-[17px] group-hover:text-[#0A2E65] transition-colors leading-tight">
                                            {{ $stand->stand_name }}
                                        </h3>
                                        <p class="text-[13px] text-zinc-500 font-medium mt-0.5">
                                            {{ $stand->categories->pluck('name')->implode(', ') }}</p>
                                    </div>
                                    <!-- Rating Badge -->
                                    <div
                                        class="flex items-center gap-1 bg-amber-50 px-1.5 py-1 rounded-lg border border-amber-100/50 shrink-0">
                                        <svg class="w-3.5 h-3.5 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                            </path>
                                        </svg>
                                        <span
                                            class="text-xs font-bold text-amber-700">{{ number_format($stand->rating_avg, 1) }}</span>
                                    </div>
                                </div>
                                <p class="text-[14px] text-zinc-600 mb-6 line-clamp-2 leading-relaxed flex-1">
                                    {{ $stand->description }}
                                </p>
                                <!-- Action Button -->
                                <div
                                    class="w-full py-2.5 bg-zinc-50 border border-zinc-200 text-zinc-800 font-bold rounded-xl group-hover:bg-[#0A2E65] group-hover:border-[#0A2E65] group-hover:text-white transition-all duration-300 text-[14px] flex items-center justify-center gap-2">
                                    Visiter le stand
                                    <svg class="w-4 h-4 opacity-0 -ml-4 group-hover:opacity-100 group-hover:ml-0 transition-all duration-300"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="col-span-1 sm:col-span-2 xl:col-span-3 py-16 text-center">
                            <h3 class="text-lg font-bold text-zinc-900 mb-2">Aucun stand trouvé</h3>
                            <p class="text-zinc-500">Essayez de modifier vos filtres pour voir plus de résultats.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($stands->hasPages())
                    <div class="mt-10">
                        {{ $stands->links() }}
                    </div>
                @endif

            </div>

        </section>


    </main>

    <!-- Footer Component -->
    <x-client.footer />

</body>

</html>