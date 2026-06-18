<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $stand->stand_name }} | Aperçu Live</title>
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

<body class="bg-white text-zinc-900 font-sans antialiased">

    <!-- Preview Banner -->
    <div
        class="bg-indigo-600 text-white px-4 py-2 text-center text-xs font-bold uppercase tracking-widest sticky top-0 z-50 shadow-lg">
        Mode Aperçu : Voici comment vos clients voient votre stand
        <a href="{{ route('seller.stand.edit') }}" class="ml-4 underline hover:text-indigo-200 transition-colors">Retour
            à l'édition</a>
    </div>

    <!-- Hero / Header -->
    <header class="relative">
        <!-- Cover -->
        <div class="h-[40vh] md:h-[50vh] w-full relative overflow-hidden">
            @if($stand->cover_url)
                <img src="{{ $stand->cover_url }}" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full bg-zinc-100 flex items-center justify-center text-zinc-300">
                    <svg class="w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                </div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
        </div>

        <!-- Stand Info Overlay -->
        <div class="max-w-7xl mx-auto px-6 relative -mt-20 md:-mt-32 pb-12">
            <div class="flex flex-col md:flex-row items-end gap-6">
                <!-- Logo -->
                <div
                    class="w-32 h-32 md:w-48 md:h-48 rounded-[2.5rem] bg-white p-2 shadow-2xl border border-white shrink-0 relative z-10">
                    <div class="w-full h-full rounded-[2.2rem] bg-zinc-50 border border-zinc-100 overflow-hidden">
                        @if($stand->logo_url)
                            <img src="{{ $stand->logo_url }}" class="w-full h-full object-cover">
                        @else
                            <div
                                class="w-full h-full flex items-center justify-center text-zinc-300 bg-zinc-50 font-bold text-4xl">
                                {{ substr($stand->stand_name, 0, 1) }}
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Text Info -->
                <div class="flex-1 text-white md:mb-6">
                    <div class="flex items-center gap-3 mb-2">
                        <h1 class="text-3xl md:text-5xl font-extrabold tracking-tighter">{{ $stand->stand_name }}</h1>
                        @if($stand->is_verified)
                            <div class="bg-indigo-500 text-white p-1 rounded-full" title="Vérifié">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z">
                                    </path>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="flex flex-wrap items-center gap-4 text-sm font-medium text-white/80">
                        <div class="flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            {{ $stand->city }}, {{ $stand->country }}
                        </div>
                        <div class="flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.382-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                                </path>
                            </svg>
                            {{ $stand->rating_avg ?? '5.0' }} ({{ $stand->total_reviews ?? '0' }} avis)
                        </div>
                    </div>
                </div>

                <!-- CTA -->
                <div class="hidden md:flex gap-3 mb-6">
                    <button
                        class="px-6 py-3 bg-white text-zinc-900 font-bold rounded-2xl text-sm shadow-xl hover:bg-zinc-50 transition-all active:scale-95">Contacter</button>
                    @if($stand->whatsapp_number)
                        <a href="https://wa.me/{{ preg_replace('/\D/', '', $stand->whatsapp_number) }}"
                            class="p-3 bg-emerald-500 text-white rounded-2xl shadow-xl hover:bg-emerald-600 transition-all active:scale-95">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z">
                                </path>
                            </svg>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            <!-- Left: Catalog -->
            <div class="lg:col-span-8">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-2xl font-bold tracking-tight">Catalogue Produits</h2>
                    <div class="flex items-center gap-2">
                        <span class="text-sm font-medium text-zinc-400">{{ $stand->products->count() }} articles</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @forelse($stand->products as $product)
                        <div class="group cursor-pointer">
                            <div class="aspect-square rounded-3xl overflow-hidden bg-zinc-100 mb-4 relative">
                                @if($product->main_image_url)
                                    <img src="{{ Storage::url($product->main_image_url) }}"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                @endif
                                <div
                                    class="absolute top-4 right-4 px-3 py-1 bg-white/90 backdrop-blur rounded-full text-[10px] font-bold uppercase tracking-widest shadow-lg">
                                    Nouveau</div>
                            </div>
                            <h3 class="font-bold text-zinc-900 group-hover:text-indigo-600 transition-colors">
                                {{ $product->name }}</h3>
                            <p class="text-sm text-zinc-500 font-medium mb-2">{{ $product->category?->name }}</p>
                            <p class="text-lg font-extrabold font-mono text-zinc-950">
                                {{ number_format($product->price, 0, ',', ' ') }} FCFA</p>
                        </div>
                    @empty
                        <div
                            class="col-span-2 py-20 text-center text-zinc-400 font-medium bg-zinc-50 rounded-[2.5rem] border border-dashed border-zinc-200">
                            Aucun produit n'est encore affiché.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Right: About & Location -->
            <div class="lg:col-span-4 space-y-12">
                <section>
                    <h2 class="text-sm font-extrabold uppercase tracking-widest text-zinc-400 mb-6">À propos</h2>
                    <p class="text-zinc-600 leading-relaxed font-medium">
                        {{ $stand->description ?? 'Aucune description fournie.' }}
                    </p>
                </section>

                <section>
                    <h2 class="text-sm font-extrabold uppercase tracking-widest text-zinc-400 mb-6">Localisation</h2>
                    <div class="bg-zinc-50 rounded-[2rem] p-6 border border-zinc-100">
                        <div class="flex items-start gap-4 mb-4">
                            <div class="p-3 bg-white rounded-xl shadow-sm">
                                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold text-zinc-900">{{ $stand->city }}</p>
                                <p class="text-sm text-zinc-500 font-medium">{{ $stand->address }}</p>
                            </div>
                        </div>
                    </div>
                </section>

                <section>
                    <h2 class="text-sm font-extrabold uppercase tracking-widest text-zinc-400 mb-6">Vendeur</h2>
                    <div class="flex items-center gap-4 p-6 bg-zinc-950 text-white rounded-[2rem] shadow-2xl">
                        <div
                            class="w-12 h-12 rounded-full bg-indigo-600 flex items-center justify-center font-bold text-sm shrink-0">
                            {{ substr($stand->user->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="font-bold">{{ $stand->user->name }}</p>
                            <p class="text-xs text-white/50 font-medium">Membre depuis
                                {{ $stand->created_at->format('M Y') }}</p>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>

    <footer class="border-t border-zinc-100 py-12 text-center text-zinc-400 text-sm font-medium">
        &copy; 2024 {{ $stand->stand_name }} . Tous droits réservés. <br>
        Propulsé par <span class="text-zinc-900 font-extrabold tracking-tighter">kelbom.</span>
    </footer>

</body>

</html>