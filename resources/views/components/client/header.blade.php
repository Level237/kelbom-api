<header class="bg-white border-b border-zinc-200 sticky top-0 z-50 shadow-sm">
    <div class="max-w-[1400px] mx-auto px-4 md:px-8 h-[72px] flex items-center justify-between gap-8">
        
        <!-- Logo & Categories -->
        <div class="flex items-center gap-6 shrink-0">
            <a href="/" class="text-3xl font-black tracking-tighter text-zinc-950">
                KELBOM
            </a>
            
            <div class="relative group hidden lg:flex items-center cursor-pointer h-[72px]">
                <div class="flex items-center gap-1.5 text-zinc-600 hover:text-zinc-900 font-medium">
                    <span class="text-[15px]">Category</span>
                    <svg class="w-4 h-4 text-zinc-400 group-hover:text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="flex-1 max-w-2xl hidden md:block">
            <div class="relative flex items-center w-full h-11 rounded-full bg-zinc-100 border border-transparent focus-within:border-blue-500 focus-within:bg-white focus-within:ring-4 focus-within:ring-blue-50 transition-all overflow-hidden">
                <div class="pl-4 text-zinc-500">
                    <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input type="text" placeholder="Rechercher des produits, des stands ou des marques..." class="w-full h-full px-3 bg-transparent border-none focus:outline-none text-zinc-900 placeholder-zinc-500 text-[15px]">
            </div>
        </div>

        <!-- Right Actions -->
        <div class="flex items-center gap-5 shrink-0">
            <!-- Notifications -->
            <button class="relative text-zinc-700 hover:text-zinc-950 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                </svg>
                <!-- Pink dot -->
                <span class="absolute top-0 right-1 w-2.5 h-2.5 bg-pink-500 border-2 border-white rounded-full"></span>
            </button>

            <!-- Cart -->
            <button class="relative text-zinc-700 hover:text-zinc-950 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </button>

            <!-- Separator -->
            <div class="w-px h-5 bg-zinc-300 hidden sm:block mx-1"></div>

            <!-- Auth -->
            <div class="hidden sm:flex items-center gap-4">
                <a href="#" class="text-[15px] font-medium text-zinc-600 hover:text-zinc-900 transition-colors">Login</a>
                <a href="#" class="bg-[#0A2E65] hover:bg-[#0A2E65]/90 text-white px-5 py-2.5 rounded text-[15px] font-bold transition-colors shadow-sm">
                    Register
                </a>
            </div>
            
            <!-- Mobile Menu Toggle -->
            <button class="md:hidden text-zinc-900">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </div>
</header>
