<header class="flex items-center justify-between w-full h-16 px-6 bg-white border-b border-slate-200 z-20 shrink-0">
    <div class="flex items-center gap-4 flex-1">
        <!-- Mobile Sidebar Toggle -->
        <button @click="sidebarOpen = true" class="md:hidden text-slate-400 hover:text-slate-600 focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
        </button>

        <!-- Search Bar -->
        <div class="hidden sm:flex items-center w-full max-w-sm bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 focus-within:border-blue-500 focus-within:bg-white focus-within:ring-2 focus-within:ring-blue-100 transition-all">
            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            <input type="text" placeholder="Search" class="w-full bg-transparent border-none focus:outline-none ml-2 text-[14px] text-slate-800 placeholder-slate-400">
            <div class="flex items-center gap-1 shrink-0 ml-2">
                <span class="text-[10px] font-bold text-slate-400 border border-slate-200 bg-white rounded px-1.5 py-0.5">⌘</span>
                <span class="text-[10px] font-bold text-slate-400 border border-slate-200 bg-white rounded px-1.5 py-0.5">F</span>
            </div>
        </div>
    </div>

    <!-- Right side (Actions & Profile) -->
    <div class="flex items-center gap-5 shrink-0">
        <!-- Icon Actions -->
        <div class="flex items-center gap-3">
            <button class="text-slate-400 hover:text-slate-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
            </button>
            <button class="relative text-slate-400 hover:text-slate-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 border-2 border-white rounded-full"></span>
            </button>
        </div>

        <div class="w-px h-6 bg-slate-200"></div>

        <!-- Profile Avatar (Dynamic) -->
        <div class="relative" x-data="{ userMenuOpen: false }">
            <button @click="userMenuOpen = !userMenuOpen" class="flex items-center gap-3 focus:outline-none group">
                <div class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center text-white font-bold text-xs ring-2 ring-transparent group-hover:ring-slate-200 transition-all">
                    {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                </div>
                <div class="hidden sm:flex flex-col items-start text-left">
                    <span class="text-[13px] font-bold text-slate-800 leading-tight">{{ auth()->user()->name ?? 'Administrateur' }}</span>
                    <span class="text-[11px] font-medium text-slate-500">Business</span>
                </div>
            </button>

            <!-- Dropdown Profile Menu -->
            <div x-show="userMenuOpen" @click.away="userMenuOpen = false" x-transition 
                 class="absolute right-0 top-full mt-3 w-56 bg-white border border-slate-100 rounded-xl shadow-xl py-2 z-50 origin-top-right" style="display: none;">
                <div class="px-4 py-2 mb-1 border-b border-slate-50">
                    <p class="text-[11px] text-slate-400 font-medium uppercase tracking-wider mb-1">Connecté en tant que</p>
                    <p class="text-[14px] font-bold text-slate-800 truncate">{{ auth()->user()->email ?? 'admin@kelbom.com' }}</p>
                </div>
                
                <a href="#" class="block px-4 py-2 text-[13px] font-medium text-slate-600 hover:bg-slate-50 hover:text-blue-600 transition-colors">Mon Profil</a>
                <a href="#" class="block px-4 py-2 text-[13px] font-medium text-slate-600 hover:bg-slate-50 hover:text-blue-600 transition-colors">Paramètres du compte</a>
                
                <div class="mt-1 pt-1 border-t border-slate-50">
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left block px-4 py-2 text-[13px] font-bold text-red-600 hover:bg-red-50 transition-colors">
                            Se déconnecter
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
