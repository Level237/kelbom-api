<aside
    class="flex flex-col w-64 h-full bg-white border-r border-slate-200 transition-transform duration-300 z-40 fixed md:relative shrink-0"
    :class="sidebarOpen ? 'translate-x-0 shadow-2xl' : '-translate-x-full md:translate-x-0'">

    <!-- Sidebar Header (Logo) -->
    <div class="flex items-center justify-between h-16 px-6 border-b border-slate-100">
        <a href="/" class="flex items-center gap-2.5 group transition-transform duration-300 active:scale-95 shrink-0">
            <!-- Logo mark -->
            <div
                class="relative flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-br from-[#0A2E65] to-blue-700 text-white shadow-lg shadow-blue-900/20 overflow-hidden">
                <div class="absolute inset-0 bg-white/10 group-hover:bg-transparent transition-colors duration-300">
                </div>
                <span class="relative z-10 font-black text-2xl tracking-tighter">K</span>
            </div>
            <!-- Text -->
            <span class="text-2xl font-black tracking-tight sm:block transition-colors duration-300"
                :class="scrolled ? 'text-zinc-950' : 'text-white'">
                Kelbom<span class="text-blue-500">.</span>
            </span>
        </a>
        <button @click="sidebarOpen = false" class="md:hidden text-slate-400 hover:text-slate-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <!-- Navigation Links -->
    <div class="flex flex-col flex-1 overflow-y-auto scrollbar-hide py-6 px-4">

        <!-- GENERAL -->
        <div class="mb-8">
            <h3 class="px-2 text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-3">Général</h3>
            <div class="space-y-1">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 px-3 py-2.5 {{ request()->routeIs('admin.dashboard') ? 'text-blue-700 bg-blue-50 font-semibold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50 font-medium' }} rounded-lg text-[14px] transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                        </path>
                    </svg>
                    Tableau de bord
                </a>
                <a href="{{ route('admin.users.index') }}"
                    class="flex items-center gap-3 px-3 py-2.5 {{ request()->routeIs('admin.users.*') ? 'text-blue-700 bg-blue-50 font-semibold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50 font-medium' }} rounded-lg text-[14px] transition-colors">
                    <svg class="w-5 h-5 {{ request()->routeIs('admin.users.*') ? 'text-blue-600' : 'text-slate-400' }}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                        </path>
                    </svg>
                    Utilisateurs
                </a>
                <a href="{{ route('admin.contacts.index') }}"
                    class="flex items-center gap-3 px-3 py-2.5 {{ request()->routeIs('admin.contacts.*') ? 'text-blue-700 bg-blue-50 font-semibold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50 font-medium' }} rounded-lg text-[14px] transition-colors">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                            </path>
                        </svg>
                        Messages
                    </div>
            </div>

            <!-- OUTILS / TOOLS -->
            <div class="mb-8">
                <h3 class="px-2 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Catalogue & Stands
                </h3>
                <div class="space-y-1">
                    <a href="{{ route('admin.stands.index') }}"
                        class="flex items-center gap-3 px-3 py-2.5 {{ request()->routeIs('admin.stands.*') ? 'text-blue-700 bg-blue-50 font-semibold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50 font-medium' }} rounded-lg text-[14px] transition-colors">
                        <svg class="w-5 h-5 {{ request()->routeIs('admin.stands.*') ? 'text-blue-600' : 'text-slate-400' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                        Boutiques (Stands)
                    </a>
                    <a href="{{ route('admin.products.index') }}"
                        class="flex items-center gap-3 px-3 py-2.5 {{ request()->routeIs('admin.products.*') ? 'text-blue-700 bg-blue-50 font-semibold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50 font-medium' }} rounded-lg text-[14px] transition-colors">
                        <svg class="w-5 h-5 {{ request()->routeIs('admin.products.*') ? 'text-blue-600' : 'text-slate-400' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                        Produits
                    </a>
                    <a href="{{ route('admin.requests.index') }}"
                        class="flex items-center justify-between px-3 py-2.5 {{ request()->routeIs('admin.requests.*') ? 'text-blue-700 bg-blue-50 font-semibold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50 font-medium' }} rounded-lg text-[14px] transition-colors">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 {{ request()->routeIs('admin.requests.*') ? 'text-blue-600' : 'text-slate-400' }}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            Demandes d'achat
                        </div>
                    </a>
                    <a href="{{ route('admin.categories.index') }}"
                        class="flex items-center gap-3 px-3 py-2.5 {{ request()->routeIs('admin.categories.*') ? 'text-blue-700 bg-blue-50 font-semibold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50 font-medium' }} rounded-lg text-[14px] transition-colors">
                        <svg class="w-5 h-5 {{ request()->routeIs('admin.categories.*') ? 'text-blue-600' : 'text-slate-400' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                        </svg>
                        Catégories
                    </a>
                </div>
                <!-- CRM & SUPPORT -->


                <!-- SUPPORT & SETTINGS -->
                <div class="mt-auto">
                    <h3 class="px-2 text-[11px] font-bold text-slate-400 uppercase tracking-widest mt-12 mb-3">Support &
                        Settings</h3>
                    <div class="space-y-1">
                        <a href="#"
                            class="flex items-center gap-3 px-3 py-2.5 text-slate-600 hover:text-slate-900 hover:bg-slate-50 rounded-lg font-medium text-[14px] transition-colors">
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Settings
                        </a>
                        <a href="#"
                            class="flex items-center gap-3 px-3 py-2.5 text-slate-600 hover:text-slate-900 hover:bg-slate-50 rounded-lg font-medium text-[14px] transition-colors">
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                </path>
                            </svg>
                            Security
                        </a>
                    </div>
                </div>
            </div>
</aside>

<!-- Overlay for mobile sidebar -->
<div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition.opacity
    class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-30 md:hidden" style="display: none;"></div>