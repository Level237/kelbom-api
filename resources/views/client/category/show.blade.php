<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $category->name }} - Kelbom Marketplace</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
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

    <main class="flex-grow pb-16">
        
        <!-- Category Hero -->
        <section class="bg-white border-b border-zinc-200">
            <div class="max-w-[1400px] mx-auto px-4 md:px-8 py-12 md:py-16">
                <div class="max-w-3xl">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="px-3 py-1 bg-blue-50 text-blue-700 text-xs font-bold uppercase tracking-widest rounded-full border border-blue-100">
                            Catégorie
                        </span>
                    </div>
                    <h1 class="text-3xl md:text-5xl font-black text-zinc-900 tracking-tight mb-4">
                        {{ $category->name }}
                    </h1>
                    @if($category->description)
                        <p class="text-zinc-500 text-lg md:text-xl leading-relaxed">
                            {{ $category->description }}
                        </p>
                    @endif
                </div>
            </div>
        </section>

        <div class="max-w-[1400px] mx-auto px-4 md:px-8 mt-12 space-y-16">
            
            <!-- Stands Section -->
            <section>
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-2xl font-black text-zinc-900 flex items-center gap-2">
                        Boutiques & Stands
                        <span class="bg-zinc-100 text-zinc-600 text-sm py-0.5 px-2.5 rounded-full font-bold ml-2">{{ $stands->count() }}</span>
                    </h2>
                </div>

                @if($stands->isEmpty())
                    <div class="bg-white rounded-2xl border border-zinc-200 border-dashed p-12 text-center">
                        <div class="w-16 h-16 bg-zinc-50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-zinc-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-zinc-900 mb-2">Aucun stand trouvé</h3>
                        <p class="text-zinc-500">Il n'y a actuellement aucun stand vérifié dans cette catégorie.</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($stands as $stand)
                            <a href="{{ route('client.stand.show', $stand->slug) }}" class="group bg-white rounded-2xl border border-zinc-200 overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col">
                                <div class="relative h-24 bg-zinc-100">
                                    <img src="{{ Str::startsWith($stand->cover_url, 'http') ? $stand->cover_url : Storage::url($stand->cover_url) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                    <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors"></div>
                                </div>
                                <div class="px-5 pb-5 relative flex-1 flex flex-col">
                                    <div class="w-14 h-14 rounded-xl border-4 border-white bg-white shadow-sm overflow-hidden -mt-7 mb-3 relative z-10 flex items-center justify-center text-[#0A2E65] font-bold text-xl">
                                        @if($stand->logo_url)
                                            <img src="{{ Str::startsWith($stand->logo_url, 'http') ? $stand->logo_url : Storage::url($stand->logo_url) }}" class="w-full h-full object-cover">
                                        @else
                                            {{ strtoupper(substr($stand->stand_name, 0, 1)) }}
                                        @endif
                                    </div>
                                    <h3 class="font-bold text-zinc-900 text-[16px] group-hover:text-[#0A2E65] transition-colors line-clamp-1 mb-1">
                                        {{ $stand->stand_name }}
                                    </h3>
                                    <div class="flex items-center gap-1 mb-3">
                                        <svg class="w-3.5 h-3.5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        <span class="text-[12px] font-bold text-zinc-700">{{ number_format($stand->rating_avg, 1) }}</span>
                                    </div>
                                    <p class="text-sm text-zinc-500 line-clamp-2 mt-auto">
                                        {{ $stand->description }}
                                    </p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </section>

            <!-- Products Section -->
            <section>
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-2xl font-black text-zinc-900 flex items-center gap-2">
                        Produits
                        <span class="bg-zinc-100 text-zinc-600 text-sm py-0.5 px-2.5 rounded-full font-bold ml-2">{{ $products->count() }}</span>
                    </h2>
                </div>

                @if($products->isEmpty())
                    <div class="bg-white rounded-2xl border border-zinc-200 border-dashed p-12 text-center">
                        <div class="w-16 h-16 bg-zinc-50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-zinc-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-zinc-900 mb-2">Aucun produit trouvé</h3>
                        <p class="text-zinc-500">Aucun produit actif n'est disponible pour cette catégorie.</p>
                    </div>
                @else
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 md:gap-6">
                        @foreach($products as $product)
                            <a href="#" class="group bg-white rounded-xl border border-zinc-200 overflow-hidden hover:shadow-lg transition-all duration-300 flex flex-col">
                                <div class="aspect-square bg-zinc-100 relative overflow-hidden">
                                    <img src="{{ Str::startsWith($product->main_image_url, 'http') ? $product->main_image_url : Storage::url($product->main_image_url) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                </div>
                                <div class="p-4 flex flex-col flex-1">
                                    <h3 class="text-[14px] font-bold text-zinc-900 group-hover:text-[#0A2E65] transition-colors line-clamp-2 mb-1">
                                        {{ $product->name }}
                                    </h3>
                                    <div class="text-[12px] text-zinc-500 mb-3">{{ $product->stand->stand_name ?? 'Kelbom' }}</div>
                                    <div class="mt-auto">
                                        <div class="text-[#0A2E65] font-black">{{ number_format($product->price, 0, ',', ' ') }} FCFA</div>
                                        @if($product->compare_at_price > $product->price)
                                            <div class="text-zinc-400 text-[11px] line-through">{{ number_format($product->compare_at_price, 0, ',', ' ') }} FCFA</div>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </section>

        </div>
    </main>

    <!-- Footer Component -->
    <x-client.footer />

</body>
</html>
