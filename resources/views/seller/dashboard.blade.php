<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord | Kelbom</title>
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

            <!-- Welcome Banner -->
            <div
                class="relative bg-gradient-to-br from-zinc-950 via-zinc-900 to-zinc-800 rounded-[2rem] p-8 sm:p-10 mb-8 overflow-hidden shadow-2xl shadow-zinc-900/10 border border-zinc-800/50">
                <!-- Background decoration -->
                <div
                    class="absolute top-0 right-0 -mt-10 -mr-10 w-64 h-64 bg-indigo-500/20 rounded-full blur-3xl pointer-events-none">
                </div>
                <div
                    class="absolute bottom-0 left-20 w-40 h-40 bg-fuchsia-500/10 rounded-full blur-2xl pointer-events-none">
                </div>

                <div class="relative z-10 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
                    <div>
                        <h2 class="text-3xl font-extrabold tracking-tight text-white mb-2">Bonjour,
                            {{ Auth::user()->name ?? 'Vendeur' }} 👋</h2>
                        <p class="text-zinc-400 text-sm sm:text-base max-w-xl leading-relaxed">Bienvenue sur votre
                            espace vendeur Kelbom. Suivez vos performances, gérez vos produits et développez votre
                            activité en toute simplicité.</p>
                    </div>
                    <div class="flex flex-wrap items-center gap-3 shrink-0">
                        <a href="#"
                            class="px-5 py-3 bg-white text-zinc-950 hover:bg-zinc-100 font-bold rounded-xl text-sm transition-all shadow-sm hover:scale-105 active:scale-95">
                            Personnaliser mon stand
                        </a>
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
                <!-- Card 1 -->
                <div
                    class="bg-white p-6 rounded-3xl border border-zinc-200/60 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
                    <div
                        class="absolute right-0 top-0 w-24 h-24 bg-blue-50/50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110">
                    </div>
                    <div class="relative z-10">
                        <div
                            class="w-12 h-12 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                </path>
                            </svg>
                        </div>
                        <p class="text-zinc-500 text-sm font-medium mb-1">Vues des Produits</p>
                        <div class="flex items-end gap-3">
                            <h3 class="text-3xl font-extrabold text-zinc-900 tracking-tight font-mono">
                                {{ number_format($stats['views'], 0, ',', ' ') }}</h3>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div
                    class="bg-white p-6 rounded-3xl border border-zinc-200/60 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
                    <div
                        class="absolute right-0 top-0 w-24 h-24 bg-emerald-50/50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110">
                    </div>
                    <div class="relative z-10">
                        <div
                            class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <p class="text-zinc-500 text-sm font-medium mb-1">Contacts</p>
                        <div class="flex items-end gap-3">
                            <h3 class="text-3xl font-extrabold text-zinc-900 tracking-tight font-mono">
                                {{ number_format($stats['inquiries'], 0, ',', ' ') }}</h3>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div
                    class="bg-white p-6 rounded-3xl border border-zinc-200/60 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
                    <div
                        class="absolute right-0 top-0 w-24 h-24 bg-fuchsia-50/50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110">
                    </div>
                    <div class="relative z-10">
                        <div
                            class="w-12 h-12 bg-fuchsia-100 text-fuchsia-600 rounded-2xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                        <p class="text-zinc-500 text-sm font-medium mb-1">Produits Actifs</p>
                        <div class="flex items-end gap-3">
                            <h3 class="text-3xl font-extrabold text-zinc-900 tracking-tight font-mono">
                                {{ number_format($stats['active_products'], 0, ',', ' ') }}</h3>
                        </div>
                    </div>
                </div>

                <!-- Card 4 -->
                <div
                    class="bg-white p-6 rounded-3xl border border-zinc-200/60 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
                    <div
                        class="absolute right-0 top-0 w-24 h-24 bg-amber-50/50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110">
                    </div>
                    <div class="relative z-10">
                        <div
                            class="w-12 h-12 bg-amber-100 text-amber-600 rounded-2xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <p class="text-zinc-500 text-sm font-medium mb-1">Crédits Lead</p>
                        <div class="flex items-end justify-between w-full">
                            <h3 class="text-3xl font-extrabold text-zinc-900 tracking-tight font-mono">
                                {{ number_format($stats['credits'], 0, ',', ' ') }}</h3>
                            <a href="#" class="text-amber-600 text-xs font-bold hover:underline mb-2">Recharger</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

                <!-- Left: Recent Orders -->
                <div class="xl:col-span-2 space-y-8">
                    <!-- Recent Products -->
                    <div class="bg-white rounded-[2rem] border border-zinc-200/60 shadow-sm overflow-hidden">
                        <div class="p-6 sm:px-8 sm:py-6 border-b border-zinc-100 flex items-center justify-between">
                            <h3 class="text-lg font-bold text-zinc-900">Produits Récents</h3>
                            <a href="#"
                                class="text-sm font-bold text-indigo-600 hover:text-indigo-700 transition-colors bg-indigo-50 px-3 py-1.5 rounded-lg">Tous
                                les produits</a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-zinc-50/50">
                                        <th
                                            class="px-8 py-4 text-xs font-semibold text-zinc-500 uppercase tracking-wider">
                                            Produit</th>
                                        <th
                                            class="px-8 py-4 text-xs font-semibold text-zinc-500 uppercase tracking-wider">
                                            Ajouté le</th>
                                        <th
                                            class="px-8 py-4 text-xs font-semibold text-zinc-500 uppercase tracking-wider">
                                            Prix</th>
                                        <th
                                            class="px-8 py-4 text-xs font-semibold text-zinc-500 uppercase tracking-wider">
                                            Statut</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-zinc-100">
                                    @forelse($recentProducts as $product)
                                        <tr class="hover:bg-zinc-50 transition-colors">
                                            <td class="px-8 py-4">
                                                <div class="flex items-center gap-3">
                                                    @if($product->main_image_url)
                                                        <div
                                                            class="w-10 h-10 rounded-xl bg-zinc-100 flex-shrink-0 overflow-hidden border border-zinc-200/60">
                                                            <img src="{{ Storage::url($product->main_image_url)}}"
                                                                alt="{{ $product->name }}" class="w-full h-full object-cover">
                                                        </div>
                                                    @else
                                                        <div
                                                            class="w-10 h-10 rounded-xl bg-zinc-100 flex items-center justify-center text-zinc-400 flex-shrink-0 border border-zinc-200/60">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                                </path>
                                                            </svg>
                                                        </div>
                                                    @endif
                                                    <span
                                                        class="text-sm font-semibold text-zinc-900 line-clamp-1">{{ $product->name }}</span>
                                                </div>
                                            </td>
                                            <td class="px-8 py-4 text-sm text-zinc-500">
                                                {{ $product->created_at->format('d/m/Y') }}</td>
                                            <td class="px-8 py-4 text-sm font-bold text-zinc-900">
                                                {{ $product->formatted_price }}</td>
                                            <td class="px-8 py-4">
                                                @if($product->status === 'active')
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700 border border-emerald-200">Actif</span>
                                                @else
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-zinc-100 text-zinc-700 border border-zinc-200">Inactif</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-8 py-8 text-center text-sm text-zinc-500">
                                                Aucun produit récent trouvé.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Right Sidebar -->
                <div class="space-y-6">
                    <!-- Promo Card -->
                    <div
                        class="bg-gradient-to-br from-indigo-950 via-[#0A2E65] to-zinc-900 rounded-[2rem] p-8 text-white relative overflow-hidden shadow-xl shadow-[#0A2E65]/10">
                        <!-- Abstract shapes -->
                        <div
                            class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full blur-2xl -mr-10 -mt-10 pointer-events-none">
                        </div>
                        <div class="relative z-10">
                            <div
                                class="w-12 h-12 bg-white/10 backdrop-blur-md rounded-2xl flex items-center justify-center mb-6 shadow-sm border border-white/10">
                                <svg class="w-6 h-6 text-indigo-200" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z">
                                    </path>
                                </svg>
                            </div>
                            <h4 class="text-xl font-bold mb-3">Boostez vos ventes</h4>
                            <p class="text-indigo-100/80 text-sm mb-8 leading-relaxed font-medium">Passez au plan
                                Premium pour apparaître en tête des résultats et attirer plus de clients sur votre
                                stand.</p>
                            <a href="#"
                                class="inline-flex items-center justify-center w-full gap-2 py-3.5 bg-white text-zinc-950 rounded-xl font-bold hover:bg-zinc-100 transition-all active:scale-[0.98] shadow-sm">
                                Découvrir les offres
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Quick Help -->
                    <div class="bg-white rounded-[2rem] border border-zinc-200/60 p-8 shadow-sm">
                        <h4 class="text-lg font-bold text-zinc-900 mb-6">Besoin d'aide ?</h4>
                        <div class="space-y-2">
                            <a href="#"
                                class="flex items-center gap-4 p-3 rounded-2xl hover:bg-zinc-50 transition-colors group">
                                <div
                                    class="w-10 h-10 bg-zinc-100 text-zinc-600 rounded-xl flex items-center justify-center group-hover:bg-indigo-50 group-hover:text-indigo-600 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-zinc-900">Centre d'aide</p>
                                    <p class="text-xs text-zinc-500 font-medium">Tutoriels et FAQ</p>
                                </div>
                            </a>
                            <a href="#"
                                class="flex items-center gap-4 p-3 rounded-2xl hover:bg-zinc-50 transition-colors group">
                                <div
                                    class="w-10 h-10 bg-zinc-100 text-zinc-600 rounded-xl flex items-center justify-center group-hover:bg-indigo-50 group-hover:text-indigo-600 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-zinc-900">Support Chat</p>
                                    <p class="text-xs text-zinc-500 font-medium">Nous sommes en ligne</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>

</html>