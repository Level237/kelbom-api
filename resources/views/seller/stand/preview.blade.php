<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $stand->stand_name }} | Aperçu Live</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] {
            display: none !important;
        }

        .studio-blur {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.4);
        }

        .premium-transition {
            transition: all 400ms cubic-bezier(0.16, 1, 0.3, 1);
        }
    </style>
</head>

<body class="bg-white text-zinc-900 font-sans antialiased selection:bg-zinc-900 selection:text-white">

    <!-- Highly Polished Developer/Studio Preview Banner -->
    <div class="bg-zinc-950 text-zinc-300 px-4 py-2.5 text-center text-[11px] font-mono tracking-tight border-b border-zinc-800/60 sticky top-0 z-50 flex items-center justify-center gap-4 shadow-sm">
        <div class="flex items-center gap-1.5">
            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span>
            <span class="text-zinc-400 font-medium">MODE APERÇU LIVE &bull; Visualisation publique de votre vitrine</span>
        </div>
        <a href="{{ route('seller.stand.edit') }}" class="px-2.5 py-0.5 bg-zinc-800 text-zinc-200 border border-zinc-700 hover:border-zinc-500 hover:text-white rounded font-mono text-[10px] premium-transition uppercase tracking-wider">
            Retour à l'édition
        </a>
    </div>

    <!-- Master Showcase Header -->
    <header class="relative">
        <!-- High-fidelity Immersive Banner -->
        <div class="h-[38vh] md:h-[46vh] w-full relative overflow-hidden bg-zinc-900">
            @if($stand->cover_url)
                <img src="{{ $stand->cover_url }}" class="w-full h-full object-cover opacity-95">
            @else
                <div class="w-full h-full bg-gradient-to-br from-zinc-800 to-zinc-900 flex items-center justify-center">
                    <svg class="w-12 h-12 text-zinc-700/60" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"></path></svg>
                </div>
            @endif
            <!-- Cinematic Vignette Edge Shading -->
            <div class="absolute inset-0 bg-gradient-to-t from-white via-transparent to-black/20"></div>
        </div>

        <!-- Stand Profile Identity Block -->
        <div class="max-w-7xl mx-auto px-6 md:px-10 relative -mt-20 md:-mt-24 pb-8 border-b border-zinc-100">
            <div class="flex flex-col md:flex-row items-start md:items-end justify-between gap-6">
                
                <div class="flex flex-col sm:flex-row items-start sm:items-end gap-5">
                    <!-- Brand Identity Mark Container -->
                    <div class="w-28 h-28 md:w-36 md:h-36 rounded-3xl bg-white p-1.5 shadow-[0_24px_48px_-12px_rgba(0,0,0,0.12)] border border-zinc-200/50 shrink-0 relative z-10 flex items-center justify-center">
                        <div class="w-full h-full rounded-[1.25rem] bg-zinc-50 border border-zinc-100 overflow-hidden flex items-center justify-center">
                            @if($stand->logo_url)
                                <img src="{{ $stand->logo_url }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-zinc-400 font-semibold tracking-tighter text-3xl">
                                    {{ substr($stand->stand_name, 0, 1) }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Meta Brand Typography Info -->
                    <div class="text-zinc-900 md:mb-2">
                        <div class="flex flex-wrap items-center gap-2.5 mb-2">
                            <h1 class="text-2xl md:text-4xl font-semibold tracking-tighter text-zinc-950">{{ $stand->stand_name }}</h1>
                            @if($stand->is_verified)
                                <div class="bg-zinc-950 text-white p-0.5 rounded-full shadow-sm" title="Vérifié">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"></path></svg>
                                </div>
                            @endif
                        </div>
                        
                        <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-xs font-medium text-zinc-500">
                            <div class="flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-zinc-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25s-7.5-4.108-7.5-11.25a7.5 7.5 0 1115 0z"></path></svg>
                                <span>{{ $stand->city }}, {{ $stand->country }}</span>
                            </div>
                            <div class="w-1 h-1 bg-zinc-300 rounded-full hidden sm:block"></div>
                            <div class="flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                <span class="font-mono text-[11px] font-bold text-zinc-800">{{ $stand->rating_avg ?? '5.0' }}</span>
                                <span class="text-zinc-400 font-normal">({{ $stand->total_reviews ?? '0' }} avis)</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Strategic Contact Interface Node -->
                <div class="flex items-center gap-2.5 w-full sm:w-auto self-stretch md:self-auto md:mb-2">
                    <button class="flex-1 sm:flex-none px-5 py-2.5 bg-zinc-950 text-white font-medium text-xs uppercase tracking-wider rounded-xl hover:bg-zinc-800 premium-transition active:scale-[0.97] shadow-sm">
                        Contacter
                    </button>
                    @if($stand->whatsapp_number)
                        <a href="https://wa.me/{{ preg_replace('/\D/', '', $stand->whatsapp_number) }}"
                            class="p-2.5 border border-zinc-200 hover:border-zinc-300 hover:bg-zinc-50 text-emerald-600 rounded-xl premium-transition active:scale-[0.97] shadow-sm"
                            target="_blank" rel="noopener">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z">
                                </path>
                            </svg>
                        </a>
                    @endif
                </div>

            </div>
        </div>
    </header>

    <!-- Main Content Canvas -->
    <main class="max-w-7xl mx-auto px-6 md:px-10 py-14">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            
            <!-- Left: Curated Product Showcase -->
            <div class="lg:col-span-8">
                <div class="flex items-center justify-between border-b border-zinc-100 pb-4 mb-8">
                    <h2 class="text-sm font-semibold uppercase tracking-wider text-zinc-800">Catalogue de la Collection</h2>
                    <span class="text-xs font-mono font-medium text-zinc-400 bg-zinc-50 border border-zinc-100 px-2 py-0.5 rounded">
                        {{ $stand->products->count() }} articles dispos
                    </span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-12">
                    @forelse($stand->products as $product)
                        <div class="group cursor-pointer">
                            <!-- Soft Matte Product Card Canvas -->
                            <div class="aspect-square rounded-2xl overflow-hidden bg-zinc-50 border border-zinc-200/60 mb-4 relative shadow-[0_4px_12px_rgba(0,0,0,0.01)]">
                                @if($product->main_image_url)
                                    <img src="{{ Storage::url($product->main_image_url) }}"
                                        class="w-full h-full object-cover group-hover:scale-[1.02] premium-transition duration-500">
                                @endif
                                <div class="absolute top-3 left-3 px-2 py-0.5 bg-zinc-950/80 backdrop-blur rounded text-[9px] font-semibold text-white uppercase tracking-widest">
                                    Nouveau
                                </div>
                            </div>
                            
                            <div class="space-y-1">
                                <h3 class="text-sm font-semibold text-zinc-900 group-hover:text-zinc-600 premium-transition">
                                    {{ $product->name }}
                                </h3>
                                <p class="text-xs text-zinc-400 font-medium">{{ $product->category?->name ?? 'Catégorie Générale' }}</p>
                                <p class="text-sm font-bold font-mono tracking-tight text-zinc-950 pt-1">
                                    {{ number_format($product->price, 0, ',', ' ') }} FCFA
                                </p>
                            </div>
                        </div>
                    @empty
                        <!-- Perfectly Composed Empty Showroom State -->
                        <div class="col-span-2 py-20 flex flex-col items-center justify-center gap-3 text-center bg-zinc-50 rounded-2xl border border-dashed border-zinc-200/80 p-8">
                            <svg class="w-6 h-6 text-zinc-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 Carlsbad 5.197m0 0A7.5 7.5 0 105.196 12m5.004-6.804A7.5 7.5 0 0012 21.75a7.5 7.5 0 006.804-10.5M12 7.5V12l3 3"></path></svg>
                            <p class="text-xs font-medium text-zinc-400 tracking-wide">Aucun produit n'est actuellement exposé dans la vitrine.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Right Column: Asymmetric Brand Info Node -->
            <div class="lg:col-span-4 space-y-10 lg:pl-4">
                
                <!-- Narrative Section -->
                <section class="space-y-4">
                    <h2 class="text-[10px] font-bold uppercase tracking-widest text-zinc-400">À propos de l'atelier</h2>
                    <p class="text-sm text-zinc-600 leading-relaxed font-normal">
                        {{ $stand->description ?? 'Aucune description rédigée pour le moment.' }}
                    </p>
                </section>

                <!-- Location Block -->
                <section class="space-y-4">
                    <h2 class="text-[10px] font-bold uppercase tracking-widest text-zinc-400">Point d'ancrage</h2>
                    <div class="bg-zinc-50 border border-zinc-200/60 rounded-2xl p-5 shadow-[0_2px_8px_rgba(0,0,0,0.01)]">
                        <div class="flex items-start gap-3.5">
                            <div class="p-2 bg-white rounded-lg border border-zinc-200 shadow-sm shrink-0 text-zinc-800">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25s-7.5-4.108-7.5-11.25a7.5 7.5 0 1115 0z"></path></svg>
                            </div>
                            <div class="space-y-0.5">
                                <p class="text-xs font-semibold text-zinc-900">{{ $stand->city }}, {{ $stand->country }}</p>
                                <p class="text-xs text-zinc-400 leading-normal font-normal">{{ $stand->address }}</p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Artisan / Owner Block -->
                <section class="space-y-4">
                    <h2 class="text-[10px] font-bold uppercase tracking-widest text-zinc-400">Responsable d'établissement</h2>
                    <div class="flex items-center gap-3.5 p-4 bg-zinc-950 text-white rounded-2xl shadow-[0_20px_40px_-12px_rgba(0,0,0,0.1)] relative overflow-hidden">
                        <div class="absolute -right-8 -bottom-8 w-20 h-20 bg-zinc-800/30 rounded-full blur-xl pointer-events-none"></div>
                        <div class="w-10 h-10 rounded-xl bg-zinc-800 border border-zinc-700 flex items-center justify-center font-mono text-xs font-bold text-zinc-200 shrink-0 select-none">
                            {{ substr($stand->user->name ?? 'V', 0, 1) }}
                        </div>
                        <div class="space-y-0.5">
                            <p class="text-xs font-medium text-white tracking-tight">{{ $stand->user->name ?? 'Artisan Partenaire' }}</p>
                            <p class="text-[10px] text-zinc-500 font-medium">
                                Enregistré en {{ $stand->created_at ? $stand->created_at->format('M Y') : '2026' }}
                            </p>
                        </div>
                    </div>
                </section>
                
            </div>
        </div>
    </main>

    <!-- Refined Minimalist Signature Footer -->
    <footer class="border-t border-zinc-100 py-12 text-center text-zinc-400 text-xs font-normal space-y-1.5 bg-zinc-50/50 mt-12">
        <p>&copy; {{ date('Y') }} &bull; {{ $stand->stand_name }} &bull; Vitrine Artisanale Autonome.</p>
        <p class="text-[10px] font-medium tracking-wide text-zinc-400">Propulsé par <span class="text-zinc-950 font-semibold tracking-tighter">kelbom.</span></p>
    </footer>

</body>

</html>