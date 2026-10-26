@php
    $navCategories = \App\Models\Category::whereNull('parent_id')
        ->where('is_active', true)
        ->with([
            'children' => function ($q) {
                $q->where('is_active', true);
            },
        ])
        ->take(8)
        ->get();

    $standsActive = request()->routeIs('client.marketplace', 'client.stand.show');
@endphp

<header class="sticky top-0 z-50 border-t-[3px] border-kola border-b border-zinc-200 bg-white" x-data="{ mobileMenuOpen: false }">
    <div class="mx-auto flex h-16 max-w-[1400px] items-center gap-3 px-4 md:gap-4 md:px-8">

        <button type="button" @click="mobileMenuOpen = true" class="text-bark focus:outline-none" aria-label="Ouvrir le menu">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

        <a href="{{ route('client.home') }}" class="shrink-0 text-[22px] font-extrabold tracking-tight text-kola-deep">
            Kelbom
        </a>

        <div class="hidden items-center gap-1 sm:flex">
            <a href="{{ route('client.products') }}"
                class="inline-flex h-9 items-center rounded-full px-4 text-sm font-semibold {{ $standsActive ? 'text-bark hover:bg-zinc-100' : 'bg-kola text-white hover:bg-kola-deep' }}">
                Produits
            </a>
            <a href="{{ route('client.marketplace') }}"
                class="inline-flex h-9 items-center rounded-full px-3 text-sm font-semibold {{ $standsActive ? 'bg-kola text-white hover:bg-kola-deep' : 'text-bark hover:bg-zinc-100' }}">
                Stands
            </a>
        </div>

        <form action="{{ route('client.products') }}" method="GET" class="hidden min-w-0 flex-1 md:block">
            <label class="flex h-10 items-center gap-2 rounded-full border border-zinc-200 bg-white px-3 focus-within:border-kola">
                <svg class="h-[18px] w-[18px] shrink-0 text-kola" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <input type="search" name="search" value="{{ request('search') }}" placeholder="Rechercher sur Kelbom"
                    class="w-full border-none bg-transparent text-sm text-bark placeholder:text-zinc-400 focus:outline-none">
            </label>
        </form>

        <div class="ml-auto flex shrink-0 items-center gap-2 sm:gap-3">
            <a href="{{ route('seller.create') }}" class="hidden text-sm font-semibold text-bark hover:text-kola-deep sm:inline">
                Créer un stand
            </a>

            <a href="{{ route('client.stands.nearby') }}"
                class="inline-flex h-10 items-center rounded-full bg-kola px-4 text-sm font-semibold text-white hover:bg-kola-deep">
                Près de moi
            </a>
        </div>
    </div>

    <div x-show="mobileMenuOpen"
        x-transition:enter="transition-opacity ease-linear duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-[900] bg-black/60 backdrop-blur-sm"
        style="display: none;">

        <div x-show="mobileMenuOpen"
            x-transition:enter="transition ease-in-out duration-300 transform"
            x-transition:enter-start="-translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in-out duration-300 transform"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full"
            @click.away="mobileMenuOpen = false"
            class="relative flex h-full w-4/5 max-w-sm flex-col overflow-y-auto bg-white shadow-2xl">

            <div class="sticky top-0 z-10 flex items-center justify-between border-b border-zinc-100 bg-white p-4">
                <span class="text-xl font-extrabold text-kola-deep">Kelbom</span>
                <button type="button" @click="mobileMenuOpen = false" class="rounded-full bg-zinc-100 p-2 text-zinc-500 hover:text-zinc-800" aria-label="Fermer le menu">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <form action="{{ route('client.products') }}" method="GET" class="border-b border-zinc-100 p-4 md:hidden">
                <label class="flex h-11 items-center rounded-full bg-zinc-100 px-3">
                    <svg class="h-5 w-5 text-kola" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <input type="search" name="search" value="{{ request('search') }}" placeholder="Rechercher sur Kelbom" class="h-full w-full border-none bg-transparent px-3 text-[15px] text-bark placeholder:text-zinc-500 focus:outline-none">
                </label>
            </form>

            <div class="flex gap-2 border-b border-zinc-100 p-4 sm:hidden">
                <a href="{{ route('client.products') }}" class="inline-flex h-9 items-center rounded-full bg-kola px-4 text-sm font-semibold text-white">Produits</a>
                <a href="{{ route('client.marketplace') }}" class="inline-flex h-9 items-center rounded-full px-3 text-sm font-semibold text-bark">Stands</a>
            </div>

            <nav class="flex-1 p-4 pb-10">
                <h3 class="mb-4 text-xs font-bold uppercase tracking-wider text-zinc-400">Parcourir</h3>
                <div class="space-y-1">
                    @foreach ($navCategories as $parent)
                        <div x-data="{ open: false }" class="border-b border-zinc-100 last:border-0">
                            <button type="button" @click="open = !open" class="flex w-full items-center justify-between py-3 text-[15px] font-semibold text-zinc-700 hover:text-indigo">
                                {{ $parent->name }}
                                @if ($parent->children->isNotEmpty())
                                    <svg class="h-4 w-4 transition-transform duration-200" :class="open ? 'rotate-180 text-kola-deep' : 'text-zinc-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                @endif
                            </button>
                            @if ($parent->children->isNotEmpty())
                                <div x-show="open" x-transition.opacity class="space-y-3 pb-3 pl-3" style="display: none;">
                                    @foreach ($parent->children as $child)
                                        <a href="{{ route('client.category.show', $child->slug) }}" class="block text-[14px] text-zinc-500 hover:text-indigo">
                                            {{ $child->name }}
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </nav>

            <div class="mt-auto space-y-3 border-t border-zinc-100 bg-zinc-50 p-4">
                <a href="{{ route('client.stands.nearby') }}" class="flex w-full items-center justify-center rounded-full bg-kola py-2.5 text-[15px] font-semibold text-white">
                    Près de moi
                </a>
                <a href="{{ route('seller.create') }}" class="flex w-full items-center justify-center rounded-full border border-zinc-300 bg-white py-2.5 text-[15px] font-semibold text-bark">
                    Créer un stand
                </a>
                @auth
                    <a href="{{ route('seller.dashboard') }}" class="flex w-full items-center justify-center rounded-full bg-kola py-2.5 text-[15px] font-semibold text-white">
                        Mon espace
                    </a>
                @else
                    <a href="{{ route('seller.register') }}" class="flex w-full items-center justify-center rounded-full bg-kola py-2.5 text-[15px] font-semibold text-white">
                        S'inscrire
                    </a>
                @endauth
            </div>
        </div>
    </div>
</header>
