<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord | Kelbom</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>

<body class="bg-[#f4f1ea] text-bark antialiased" x-data="{ sidebarOpen: false }">

    <div x-show="sidebarOpen" x-transition.opacity @click="sidebarOpen = false"
        class="fixed inset-0 z-40 bg-night/40 backdrop-blur-sm lg:hidden"></div>

    <x-seller.dashboard.sidebar />

    <div class="lg:pl-72 flex flex-col min-h-screen">
        <x-seller.dashboard.header />

        <main class="flex-1 p-4 md:p-8 w-full max-w-[1200px] mx-auto">

            @php
                $stand = Auth::user()->stand;
                $kpiCards = [
                    ['label' => 'Vues produits', 'value' => $stats['views'], 'hint' => 'Sur vos annonces', 'tone' => 'indigo'],
                    ['label' => 'Contacts', 'value' => $stats['inquiries'], 'hint' => 'Demandes reçues', 'tone' => 'palm'],
                    ['label' => 'Produits actifs', 'value' => $stats['active_products'], 'hint' => 'En ligne', 'tone' => 'kola'],
                    ['label' => 'Crédits leads', 'value' => $stats['credits'], 'hint' => 'Disponibles', 'tone' => 'laterite'],
                ];
            @endphp

            {{-- En-tête + CTA principal --}}
            <section class="mb-6 rounded-2xl border border-[#e7e2d8] bg-white p-5 sm:p-6 shadow-sm">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-harmattan">Tableau de bord</p>
                        <h1 class="mt-1 text-xl sm:text-2xl font-semibold text-indigo-deep">
                            Bonjour, {{ Auth::user()->name ?? 'Vendeur' }}
                        </h1>
                        <p class="mt-1 text-sm text-harmattan max-w-lg">
                            @if($stand)
                                Gérez <span class="font-semibold text-bark">{{ $stand->stand_name }}</span> et ajoutez des produits pour être visible sur la marketplace.
                            @else
                                Complétez votre stand pour publier vos produits.
                            @endif
                        </p>
                    </div>
                    <a href="{{ route('seller.products.create') }}"
                        class="inline-flex h-12 shrink-0 items-center justify-center gap-2 rounded-xl bg-indigo px-6 text-[15px] font-semibold text-shea shadow-[0_8px_20px_-10px_rgba(30,58,95,0.85)] transition hover:bg-indigo-deep active:scale-[0.99]">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                        Créer un produit
                    </a>
                </div>
            </section>

            {{-- KPI : carousel mobile / grille desktop --}}
            <section class="mb-6" x-data="{
                kpiIndex: 0,
                kpiTotal: {{ count($kpiCards) }},
                touchStartX: 0,
                nextKpi() { this.kpiIndex = (this.kpiIndex + 1) % this.kpiTotal; },
                prevKpi() { this.kpiIndex = (this.kpiIndex - 1 + this.kpiTotal) % this.kpiTotal; },
            }">
                <div class="mb-3 flex items-center justify-between">
                    <h2 class="text-sm font-semibold text-indigo-deep">Indicateurs</h2>
                    <div class="flex gap-1.5 lg:hidden">
                        @foreach ($kpiCards as $i => $card)
                            <button type="button" @click="kpiIndex = {{ $i }}"
                                class="h-1.5 rounded-full transition-all"
                                :class="kpiIndex === {{ $i }} ? 'w-6 bg-indigo' : 'w-2 bg-[#d6d0c6]'"
                                aria-label="KPI {{ $i + 1 }}"></button>
                        @endforeach
                    </div>
                </div>

                <div class="lg:hidden overflow-hidden rounded-2xl"
                    @touchstart="touchStartX = $event.changedTouches[0].screenX"
                    @touchend="const dx = $event.changedTouches[0].screenX - touchStartX; if (dx < -40) nextKpi(); if (dx > 40) prevKpi();">
                    <div class="flex transition-transform duration-300 ease-out"
                        :style="`transform: translateX(-${kpiIndex * 100}%)`">
                        @foreach ($kpiCards as $card)
                            <article class="w-full shrink-0 rounded-2xl border border-[#e7e2d8] bg-white p-5 shadow-sm">
                                <p class="text-xs font-medium text-harmattan">{{ $card['label'] }}</p>
                                <p class="mt-2 text-3xl font-bold tabular-nums text-indigo-deep">{{ number_format($card['value'], 0, ',', ' ') }}</p>
                                <p class="mt-1 text-xs text-harmattan">{{ $card['hint'] }}</p>
                            </article>
                        @endforeach
                    </div>
                </div>

                <div class="hidden lg:grid lg:grid-cols-4 gap-4">
                    @foreach ($kpiCards as $card)
                        <article class="rounded-2xl border border-[#e7e2d8] bg-white p-5 shadow-sm">
                            <p class="text-xs font-medium text-harmattan">{{ $card['label'] }}</p>
                            <p class="mt-2 text-3xl font-bold tabular-nums text-indigo-deep">{{ number_format($card['value'], 0, ',', ' ') }}</p>
                            <p class="mt-1 text-xs text-harmattan">{{ $card['hint'] }}</p>
                        </article>
                    @endforeach
                </div>
            </section>

            {{-- Actions rapides --}}
            <section class="mb-8">
                <h2 class="mb-3 text-sm font-semibold text-indigo-deep">Actions rapides</h2>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                    <a href="{{ route('seller.products.create') }}"
                        class="flex flex-col gap-3 rounded-2xl border border-indigo/15 bg-indigo p-4 text-shea shadow-sm transition hover:bg-indigo-deep">
                        <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-white/15">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                        </span>
                        <span class="text-sm font-semibold leading-tight">Créer un produit</span>
                    </a>
                    <a href="{{ route('seller.products.index') }}"
                        class="flex flex-col gap-3 rounded-2xl border border-[#e7e2d8] bg-white p-4 shadow-sm transition hover:border-indigo/30">
                        <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#faf8f4] text-indigo">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        </span>
                        <span class="text-sm font-semibold text-bark leading-tight">Mes produits</span>
                    </a>
                    <a href="{{ route('seller.stand.edit') }}"
                        class="flex flex-col gap-3 rounded-2xl border border-[#e7e2d8] bg-white p-4 shadow-sm transition hover:border-indigo/30">
                        <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#faf8f4] text-indigo">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </span>
                        <span class="text-sm font-semibold text-bark leading-tight">Modifier le stand</span>
                    </a>
                    <a href="{{ route('seller.stand.preview') }}"
                        class="flex flex-col gap-3 rounded-2xl border border-[#e7e2d8] bg-white p-4 shadow-sm transition hover:border-indigo/30">
                        <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#faf8f4] text-indigo">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        </span>
                        <span class="text-sm font-semibold text-bark leading-tight">Voir ma vitrine</span>
                    </a>
                </div>
            </section>

            {{-- Produits récents --}}
            <section class="rounded-2xl border border-[#e7e2d8] bg-white shadow-sm overflow-hidden">
                <div class="flex items-center justify-between gap-3 border-b border-[#eee8de] px-5 py-4 sm:px-6">
                    <h2 class="text-sm font-semibold text-indigo-deep">Produits récents</h2>
                    <a href="{{ route('seller.products.index') }}" class="text-xs font-semibold text-indigo hover:underline">Tout voir</a>
                </div>

                @if($recentProducts->isEmpty())
                    <div class="px-5 py-12 text-center sm:px-6">
                        <p class="text-sm text-harmattan mb-4">Aucun produit pour l’instant.</p>
                        <a href="{{ route('seller.products.create') }}"
                            class="inline-flex h-10 items-center rounded-lg bg-indigo px-4 text-sm font-semibold text-shea hover:bg-indigo-deep">
                            Créer mon premier produit
                        </a>
                    </div>
                @else
                    <ul class="divide-y divide-[#eee8de]">
                        @foreach($recentProducts as $product)
                            <li class="flex items-center gap-3 px-5 py-3.5 sm:px-6 hover:bg-[#faf8f4] transition">
                                @if($product->main_image_url)
                                    <img src="{{ Storage::url($product->main_image_url) }}" alt=""
                                        class="h-11 w-11 shrink-0 rounded-lg object-cover border border-[#e7e2d8]">
                                @else
                                    <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg bg-[#faf8f4] text-harmattan border border-[#e7e2d8]">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    </span>
                                @endif
                                <div class="min-w-0 flex-1">
                                    <p class="truncate text-sm font-semibold text-bark">{{ $product->name }}</p>
                                    <p class="text-xs text-harmattan">{{ $product->created_at->format('d/m/Y') }} · {{ $product->formatted_price }}</p>
                                </div>
                                @if($product->status === 'active')
                                    <span class="shrink-0 rounded-full bg-palm/10 px-2.5 py-0.5 text-[11px] font-semibold text-palm">Actif</span>
                                @else
                                    <span class="shrink-0 rounded-full bg-[#f4f1ea] px-2.5 py-0.5 text-[11px] font-semibold text-harmattan">Inactif</span>
                                @endif
                                <a href="{{ route('seller.products.edit', $product) }}" class="shrink-0 text-xs font-semibold text-indigo hover:underline">Modifier</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </section>
        </main>
    </div>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>

</html>
