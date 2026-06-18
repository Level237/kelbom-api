@props([
    'transparent' => true,
])

<header 
    x-data="{ 
        mobileMenuOpen: false,
        scrolled: false,
        init() {
            window.addEventListener('scroll', () => {
                this.scrolled = window.scrollY > 10;
            });
            // check initial state
            this.scrolled = window.scrollY > 10;
        }
    }"
    :class="{ 
        'bg-white text-zinc-900 shadow-sm border-b border-zinc-200': scrolled,
        'bg-transparent text-white': !scrolled,
    }"
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 ease-out"
>
    <div class="max-w-[1400px] mx-auto flex items-center justify-between px-4 md:px-8 py-3 md:py-4">
        <!-- Logo & Left Nav -->
        <div class="flex items-center gap-8">
            <a href="/" class="flex items-center gap-2 group transition-transform duration-300 active:scale-95 shrink-0">
                <img src="{{ asset('assets/img/kelbom-Photoroom.png') }}" alt="Kelbom" 
                     class="h-8 md:h-10 w-auto transition-all"
                     :class="!scrolled ? 'brightness-0 invert' : ''">
                <h1 class="text-2xl font-extrabold tracking-tight lowercase hidden sm:block transition-colors" :class="scrolled ? 'text-zinc-950' : 'text-white'">kelbom.</h1>
            </a>
            
            <nav class="hidden lg:flex items-center gap-6">
                <a href="#" class="text-sm font-medium transition-colors" :class="scrolled ? 'text-zinc-600 hover:text-zinc-900' : 'text-white/90 hover:text-white'">Centre d'aide</a>
                <a href="#" class="text-sm font-medium transition-colors" :class="scrolled ? 'text-zinc-600 hover:text-zinc-900' : 'text-white/90 hover:text-white'">Règles</a>
            </nav>
        </div>

        <!-- Right Actions -->
        <div class="flex items-center gap-4">
            <div class="hidden sm:flex items-center gap-2">
                <button class="flex items-center gap-1 text-sm font-medium transition-colors" :class="scrolled ? 'text-zinc-600 hover:text-zinc-900' : 'text-white hover:text-zinc-200'">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                    FR
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
            </div>
            
            <a href="" class="hidden sm:block px-4 py-1.5 text-sm font-medium border rounded-full transition-all"
               :class="scrolled ? 'border-zinc-300 text-zinc-700 hover:bg-zinc-50' : 'border-white/50 text-white hover:bg-white/10'">
                Connexion
            </a>
            
            <a href="/register" 
               class="flex items-center gap-2 px-5 py-2 rounded-full text-sm font-bold transition-all active:scale-[0.98]"
               :class="scrolled ? 'bg-zinc-900 text-white hover:bg-zinc-800 shadow-md' : 'bg-white text-zinc-900 hover:bg-zinc-100'">
                <span>Ouvrir mon stand</span>
                <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>

            <!-- Mobile Menu Toggle -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden p-2 rounded-full transition-all" :class="scrolled ? 'text-zinc-900 hover:bg-zinc-100' : 'text-white hover:bg-white/10'">
                <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                <svg x-show="mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen" 
         x-transition
         class="lg:hidden absolute top-full left-0 w-full bg-white shadow-xl border-t border-zinc-100 py-4 px-4 flex flex-col gap-4 text-zinc-900"
         style="display: none;">
         <a href="#" class="text-zinc-600 font-medium py-2 border-b border-zinc-100">Centre d'aide</a>
         <a href="#" class="text-zinc-600 font-medium py-2 border-b border-zinc-100">Règles</a>
         <a href="#" class="text-zinc-600 font-medium py-2 border-b border-zinc-100">Connexion</a>
    </div>
</header>
