<header
    class="sticky top-0 z-40 bg-white/80 backdrop-blur-md border-b border-slate-200 h-20 flex items-center justify-between px-6 lg:px-10 transition-all">
    <!-- Left side: Mobile Toggle & Search -->
    <div class="flex items-center gap-4 flex-1">
        <button @click="sidebarOpen = true"
            class="p-2 -ml-2 text-zinc-500 hover:bg-zinc-100 rounded-xl lg:hidden transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                </path>
            </svg>
        </button>

        <!-- Global Search Bar -->
        <div class="hidden md:flex items-center max-w-md w-full relative group">
            <svg class="w-5 h-5 absolute left-3.5 text-zinc-400 group-focus-within:text-indigo-500 transition-colors"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            <input type="text" placeholder="Rechercher (Produits, Commandes...)"
                class="w-full pl-11 pr-4 py-2.5 bg-zinc-50 border border-zinc-200/80 rounded-2xl text-sm font-medium focus:outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all text-zinc-900 placeholder-zinc-400">
            <!-- Shortcut Hint -->
            <div class="absolute right-3 hidden lg:flex items-center gap-1">
                <kbd
                    class="px-2 py-1 text-[10px] font-bold text-zinc-500 bg-white border border-zinc-200 rounded-md">Ctrl</kbd>
                <kbd
                    class="px-2 py-1 text-[10px] font-bold text-zinc-500 bg-white border border-zinc-200 rounded-md">K</kbd>
            </div>
        </div>
    </div>

    <!-- Right side: Actions & Profile -->
    <div class="flex items-center gap-3">
        <!-- Add Product Quick Button -->
        <a href="#"
            class="hidden sm:flex items-center gap-2 px-5 py-2.5 bg-[#0A2E65] hover:bg-zinc-800 text-white text-sm font-bold rounded-full transition-all active:scale-95 shadow-md">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Nouveau Produit
        </a>

        <!-- Notifications -->
        <button
            class="relative p-2.5 text-zinc-500 hover:bg-zinc-100 rounded-full transition-colors border border-transparent hover:border-zinc-200">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                </path>
            </svg>
            <span class="absolute top-2 right-2 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-white"></span>
        </button>

        <div class="w-px h-6 bg-zinc-200 mx-1 hidden sm:block"></div>

        <!-- User Dropdown Area -->
        <button
            class="flex items-center gap-2 pl-1 pr-2 py-1 hover:bg-zinc-50 rounded-full transition-colors border border-transparent hover:border-zinc-200">
            <div
                class="h-8 w-8 rounded-full bg-indigo-100 border border-indigo-200 flex items-center justify-center text-indigo-700 font-bold overflow-hidden shadow-sm">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'V') }}&background=4f46e5&color=fff&rounded=true&bold=true"
                    alt="User" class="w-full h-full object-cover">
            </div>
            <svg class="w-4 h-4 text-zinc-400 hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>
    </div>
</header>