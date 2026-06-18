<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    class="fixed inset-y-0 left-0 z-50 w-72 bg-white border-r border-slate-200 transform transition-transform duration-300 ease-in-out lg:translate-x-0 flex flex-col shadow-sm">

    <!-- Logo Area -->
    <div class="h-20 flex items-center px-8 border-b border-slate-100 shrink-0">
        <a href="/" class="flex items-center gap-2 group transition-transform duration-300 active:scale-95 shrink-0">
            <img src="{{ asset('assets/img/kelbom-Photoroom.png') }}" alt="Kelbom"
                class="h-8 md:h-10 w-auto transition-all" :class="!scrolled ? 'brightness-0 invert' : ''">
            <h1 class="text-2xl font-extrabold tracking-tight lowercase hidden sm:block transition-colors"
                :class="scrolled ? 'text-zinc-950' : 'text-white'">kelbom.</h1>
        </a>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
        <!-- Vue d'ensemble -->
        <a href="{{ route('seller.dashboard') ?? '#' }}"
            class="{{ request()->routeIs('seller.dashboard') ? 'bg-zinc-100/80 text-zinc-900 font-bold' : 'text-zinc-600 hover:text-zinc-900 hover:bg-zinc-50 font-medium' }} flex items-center gap-3 px-4 py-2.5 rounded-xl transition-colors group">
            <svg class="w-5 h-5 {{ request()->routeIs('seller.dashboard') ? 'text-zinc-900' : 'text-zinc-400 group-hover:text-zinc-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
            </svg>
            Vue d'ensemble
        </a>

        <!-- Mes produits -->
        <a href="{{ route('seller.products.index') ?? '#' }}"
            class="{{ request()->routeIs('seller.products.*') ? 'bg-zinc-100/80 text-zinc-900 font-bold' : 'text-zinc-600 hover:text-zinc-900 hover:bg-zinc-50 font-medium' }} flex items-center gap-3 px-4 py-2.5 rounded-xl transition-colors group">
            <svg class="w-5 h-5 {{ request()->routeIs('seller.products.*') ? 'text-zinc-900' : 'text-zinc-400 group-hover:text-zinc-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
            </svg>
            Mes produits
        </a>

        <!-- Mon stand -->
        <div x-data="{ open: {{ request()->routeIs('seller.stand.*') ? 'true' : 'false' }} }">
            <button @click="open = !open"
                class="{{ request()->routeIs('seller.stand.*') ? 'text-zinc-900 font-bold' : 'text-zinc-600 hover:text-zinc-900 hover:bg-zinc-50 font-medium' }} flex items-center justify-between w-full px-4 py-2.5 rounded-xl transition-all group">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 {{ request()->routeIs('seller.stand.*') ? 'text-zinc-900' : 'text-zinc-400 group-hover:text-zinc-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    Mon stand
                </div>
                <svg class="w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            
            <div x-show="open" 
                 x-transition:enter="transition ease-out duration-100"
                 x-transition:enter-start="transform opacity-0 scale-95"
                 x-transition:enter-end="transform opacity-100 scale-100"
                 class="mt-1 ml-4 pl-4 border-l border-zinc-100 space-y-1">
                <a href="{{ route('seller.stand.edit') }}" 
                   class="{{ request()->routeIs('seller.stand.edit') ? 'text-indigo-600 font-bold' : 'text-zinc-500 hover:text-zinc-900 hover:bg-zinc-50 font-medium' }} flex items-center gap-2 px-3 py-2 rounded-lg text-sm transition-colors">
                    <span class="w-1.5 h-1.5 rounded-full {{ request()->routeIs('seller.stand.edit') ? 'bg-indigo-600' : 'bg-zinc-300' }}"></span>
                    Éditer mon stand
                </a>
                <a href="{{ route('seller.stand.preview') }}" 
                   class="{{ request()->routeIs('seller.stand.preview') ? 'text-indigo-600 font-bold' : 'text-zinc-500 hover:text-zinc-900 hover:bg-zinc-50 font-medium' }} flex items-center gap-2 px-3 py-2 rounded-lg text-sm transition-colors">
                    <span class="w-1.5 h-1.5 rounded-full {{ request()->routeIs('seller.stand.preview') ? 'bg-indigo-600' : 'bg-zinc-300' }}"></span>
                    Visualiser mon stand
                </a>
            </div>
        </div>

        <!-- Credits -->
        <a href="#"
            class="text-zinc-600 hover:text-zinc-900 hover:bg-zinc-50 font-medium flex items-center justify-between px-4 py-2.5 rounded-xl transition-colors group">
            <div class="flex items-center gap-3">
                <svg class="w-5 h-5 text-zinc-400 group-hover:text-zinc-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Credits
            </div>
            <span class="bg-amber-100 text-amber-700 text-xs font-bold px-2 py-0.5 rounded-md">245</span>
        </a>

        <!-- Abonnement -->
        <a href="#"
            class="text-zinc-600 hover:text-zinc-900 hover:bg-zinc-50 font-medium flex items-center gap-3 px-4 py-2.5 rounded-xl transition-colors group">
            <svg class="w-5 h-5 text-zinc-400 group-hover:text-zinc-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.95 11.95 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
            </svg>
            Abonnement
        </a>

        <div class="my-4 border-t border-slate-100"></div>

        <!-- Parametres -->
        <a href="#"
            class="text-zinc-600 hover:text-zinc-900 hover:bg-zinc-50 font-medium flex items-center gap-3 px-4 py-2.5 rounded-xl transition-colors group">
            <svg class="w-5 h-5 text-zinc-400 group-hover:text-zinc-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            Paramètres
        </a>
    </nav>

    <!-- User Profile Footer -->
    <div class="p-4 border-t border-slate-100">
        <div class="flex items-center gap-3 px-3 py-2 bg-zinc-50 rounded-xl border border-zinc-100 mb-3 shadow-sm">
            <div
                class="w-10 h-10 rounded-full bg-indigo-600 flex items-center justify-center text-white font-bold text-sm shadow-sm shrink-0">
                {{ substr(Auth::user()->name ?? 'V', 0, 1) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-bold text-zinc-900 truncate">{{ Auth::user()->name ?? 'Mon Stand' }}</p>
                <p class="text-xs text-zinc-500 font-medium truncate">Plan Premium</p>
            </div>
        </div>
        <form action="{{ route('logout') ?? '#' }}" method="POST">
            @csrf
            <button type="submit"
                class="w-full flex items-center justify-center gap-2 px-4 py-2.5 text-zinc-600 hover:text-white hover:bg-zinc-900 rounded-xl transition-all group text-sm font-bold shadow-sm border border-zinc-200 hover:border-zinc-900 active:scale-[0.98]">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                    </path>
                </svg>
                Déconnexion
            </button>
        </form>
    </div>
</aside>