<header class="bg-white border-b border-zinc-200 sticky top-0 z-50 shadow-sm" x-data="{ mobileMenuOpen: false }">
    <div class="max-w-[1400px] mx-auto px-4 md:px-8 h-[72px] flex items-center justify-between gap-8">

        <!-- Logo & Categories -->
        <div class="flex items-center gap-8">
            <a href="/" class="flex items-center gap-2.5 group transition-transform duration-300 active:scale-95 shrink-0">
                <!-- Logo mark -->
                <div class="relative flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-br from-[#0A2E65] to-blue-700 text-white shadow-lg shadow-blue-900/20 overflow-hidden">
                    <div class="absolute inset-0 bg-white/10 group-hover:bg-transparent transition-colors duration-300"></div>
                    <span class="relative z-10 font-black text-2xl tracking-tighter">K</span>
                </div>
                <!-- Text -->
                <span class="text-2xl font-black tracking-tight sm:block transition-colors duration-300" 
                      :class="scrolled ? 'text-zinc-950' : 'text-white'">
                    Kelbom<span class="text-blue-500">.</span>
                </span>
            </a>
            
            
        </div>


        <!-- Search Bar -->
        <div class="flex-1 max-w-2xl hidden md:block">
            <div
                class="relative flex items-center w-full h-11 rounded-full bg-zinc-100 border border-transparent focus-within:border-blue-500 focus-within:bg-white focus-within:ring-4 focus-within:ring-blue-50 transition-all overflow-hidden">
                <div class="pl-4 text-zinc-500">
                    <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input type="text" placeholder="Rechercher des produits, des stands ou des marques..."
                    class="w-full h-full px-3 bg-transparent border-none focus:outline-none text-zinc-900 placeholder-zinc-500 text-[15px]">
            </div>
        </div>

        <!-- Right Actions -->
        <div class="flex items-center gap-5 shrink-0">
            <!-- Notifications -->
            <button class="relative text-zinc-700 hover:text-zinc-950 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                    </path>
                </svg>
                <!-- Pink dot -->
                <span class="absolute top-0 right-1 w-2.5 h-2.5 bg-pink-500 border-2 border-white rounded-full"></span>
            </button>

            <!-- Cart -->
            <button class="relative text-zinc-700 hover:text-zinc-950 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                    </path>
                </svg>
            </button>

            <!-- Separator -->
            <div class="w-px h-5 bg-zinc-300 hidden sm:block mx-1"></div>

            <!-- Auth -->
            <div class="hidden sm:flex items-center gap-4">
                <a href="#"
                    class="text-[15px] font-medium text-zinc-600 hover:text-zinc-900 transition-colors">Login</a>
                <a href="#"
                    class="bg-[#0A2E65] hover:bg-[#0A2E65]/90 text-white px-5 py-2.5 rounded text-[15px] font-bold transition-colors shadow-sm">
                    Register
                </a>
            </div>

            <!-- Mobile Menu Toggle -->
            <button @click="mobileMenuOpen = true" class="md:hidden text-zinc-900 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Navigation Menu (Categories) -->
    @php
        // Mise en cache des catégories pour des performances optimales (1 heure)
        $navCategories = \App\Models\Category::whereNull('parent_id')
            ->where('is_active', true)
            ->with([
                'children' => function ($q) {
                    $q->where('is_active', true);
                }
            ])
            ->take(8) // Limitation pour garder un affichage propre
            ->get();
    @endphp

    <div class="hidden lg:block border-t border-zinc-100">
        <div class="max-w-[1400px] mx-auto px-4 md:px-8">
            <nav class="flex items-center gap-8 h-12">
                @foreach($navCategories as $parent)
                    <div class="relative group h-full flex items-center">
                        <a href="#"
                            class="text-[14px] font-semibold text-zinc-600 hover:text-[#0A2E65] transition-colors flex items-center gap-1 h-full">
                            {{ $parent->name }}
                            @if($parent->children->isNotEmpty())
                                <svg class="w-3.5 h-3.5 text-zinc-400 group-hover:text-[#0A2E65] transition-transform duration-300 group-hover:-rotate-180"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                    </path>
                                </svg>
                            @endif
                        </a>

                        @if($parent->children->isNotEmpty())
                            <!-- Dropdown Menu -->
                            <div
                                class="absolute top-full left-0 min-w-[220px] bg-white border border-zinc-100 rounded-b-xl shadow-xl shadow-blue-900/5 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform translate-y-2 group-hover:translate-y-0 z-[60] py-2">
                                @foreach($parent->children as $child)
                                    <a href="#"
                                        class="block px-5 py-2.5 text-[14px] font-medium text-zinc-600 hover:text-[#0A2E65] hover:bg-blue-50/50 transition-colors">
                                        {{ $child->name }}
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach

                <a href="#"
                    class="text-[14px] font-bold text-[#0A2E65] hover:text-blue-800 transition-colors ml-auto flex items-center gap-1.5">
                    Toutes les offres
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </nav>
        </div>
    </div>

    <!-- Mobile Off-Canvas Menu -->
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-[900] bg-black/60 backdrop-blur-sm md:hidden" 
         style="display: none;">
         
         <!-- Drawer -->
         <div x-show="mobileMenuOpen"
              x-transition:enter="transition ease-in-out duration-300 transform"
              x-transition:enter-start="-translate-x-full"
              x-transition:enter-end="translate-x-0"
              x-transition:leave="transition ease-in-out duration-300 transform"
              x-transition:leave-start="translate-x-0"
              x-transition:leave-end="-translate-x-full"
              @click.away="mobileMenuOpen = false"
              class="relative w-4/5 z-100 max-w-sm h-full bg-white shadow-2xl flex flex-col overflow-y-auto">
              
              <!-- Menu Header -->
              <div class="p-4 border-b border-zinc-100 flex items-center justify-between sticky top-0 bg-white z-10">
                  <span class="text-2xl font-black text-[#0A2E65]">KELBOM</span>
                  <button @click="mobileMenuOpen = false" class="text-zinc-500 hover:text-zinc-800 bg-zinc-100 p-2 rounded-full focus:outline-none transition-colors">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                  </button>
              </div>

              <!-- Search Bar for Mobile -->
              <div class="p-4 border-b  border-zinc-100">
                  <div class="relative flex items-center w-full h-11 rounded-lg bg-zinc-100 focus-within:ring-2 focus-within:ring-blue-500 focus-within:bg-white overflow-hidden transition-all">
                      <div class="pl-3 text-zinc-400">
                          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                      </div>
                      <input type="text" placeholder="Rechercher..." class="w-full h-full px-3 bg-transparent border-none focus:outline-none text-zinc-900 placeholder-zinc-500 text-[15px]">
                  </div>
              </div>

              <!-- Categories Accordion -->
              <nav class="flex-1 p-4 pb-10">
                  <h3 class="text-xs font-bold text-zinc-400 uppercase tracking-wider mb-4">Parcourir</h3>
                  <div class="space-y-1">
                      @foreach($navCategories as $parent)
                          <div x-data="{ open: false }" class="border-b border-zinc-100 last:border-0">
                              <button @click="open = !open" class="w-full flex items-center justify-between py-3 text-[15px] font-semibold text-zinc-700 hover:text-[#0A2E65] transition-colors focus:outline-none">
                                  {{ $parent->name }}
                                  @if($parent->children->isNotEmpty())
                                      <svg class="w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180 text-[#0A2E65]' : 'text-zinc-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                  @endif
                              </button>
                              
                              @if($parent->children->isNotEmpty())
                                  <!-- Subcategories -->
                                  <div x-show="open" x-transition.opacity class="pl-3 pb-3 space-y-3" style="display: none;">
                                      @foreach($parent->children as $child)
                                          <a href="#" class="block text-[14px] text-zinc-500 hover:text-[#0A2E65] transition-colors">
                                              {{ $child->name }}
                                          </a>
                                      @endforeach
                                  </div>
                              @endif
                          </div>
                      @endforeach
                      <a href="#" class="block py-4 text-[15px] font-bold text-[#0A2E65] flex items-center gap-1">
                          Toutes les offres
                          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                      </a>
                  </div>
              </nav>

              <!-- Auth Actions for Mobile -->
              <div class="p-4 border-t border-zinc-100 bg-zinc-50 mt-auto space-y-3">
                  <a href="#" class="flex justify-center items-center w-full py-2.5 text-[15px] font-semibold text-zinc-700 bg-white border border-zinc-300 rounded-lg shadow-sm hover:bg-zinc-50 transition-colors">
                      Se connecter
                  </a>
                  <a href="#" class="flex justify-center items-center w-full py-2.5 text-[15px] font-semibold text-white bg-[#0A2E65] rounded-lg shadow-sm hover:bg-blue-900 transition-colors">
                      Créer un compte
                  </a>
              </div>
         </div>
    </div>
</header>