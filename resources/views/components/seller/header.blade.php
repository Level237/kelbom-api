@props([
    'transparent' => false,
])

<header 
    x-data="{ 
        mobileMenuOpen: false,
        scrolled: false,
        init() {
            window.addEventListener('scroll', () => {
                this.scrolled = window.scrollY > 20;
            });
        }
    }"
    :class="{ 
        'py-6': !scrolled, 
        'py-3': scrolled,
        'bg-transparent': !scrolled && {{ $transparent ? 'true' : 'false' }},
    }"
    class="fixed top-0 left-0 right-0 z-50 px-4 md:px-8 transition-all duration-500 ease-out"
>
    <div 
        :class="{ 
            'bg-white/80 backdrop-blur-lg shadow-sm': scrolled || !{{ $transparent ? 'true' : 'false' }},
            'border-transparent': !scrolled && {{ $transparent ? 'true' : 'false' }},
            'border-zinc-200/50': scrolled || !{{ $transparent ? 'true' : 'false' }}
        }"
        class="max-w-7xl mx-auto flex items-center justify-between px-3 md:px-6 py-2.5 transition-all duration-500 rounded-full border"
    >
        <!-- Logo -->
        <div class="flex items-center gap-2 group transition-transform duration-300 active:scale-95 shrink-0 pl-2">
            <a href="/" class="flex items-center gap-3 group transition-transform duration-300 active:scale-95 shrink-0">
                <img src="{{ asset('assets/img/kelbom-Photoroom.png') }}" alt="Kelbom" class="h-15 md:h-12 w-auto">
                <h1 class="text-xl font-extrabold tracking-tight text-zinc-950 lowercase hidden sm:block">kelbom.</h1>
            </a>
        </div>
        
        <!-- Desktop Navigation (Centered Pill) -->
        <nav class="hidden lg:flex items-center p-1.5 bg-zinc-50/80 backdrop-blur-md border border-zinc-200/60 rounded-full shadow-sm">
            <a href="#" class="px-5 py-2 text-sm font-medium text-zinc-900 bg-white rounded-full shadow-sm transition-all duration-300">Vendre</a>
            <a href="#" class="px-5 py-2 text-sm font-medium text-zinc-500 hover:text-zinc-900 transition-all duration-300">Comment ça marche</a>
            <a href="#" class="px-5 py-2 text-sm font-medium text-zinc-500 hover:text-zinc-900 transition-all duration-300">Tarifs</a>
            <a href="#" class="px-5 py-2 text-sm font-medium text-zinc-500 hover:text-zinc-900 transition-all duration-300">FAQ</a>
        </nav>

        <!-- Actions -->
        <div class="flex items-center gap-2 md:gap-3 pr-1">
            <div class="hidden sm:flex items-center">
                <a href="" class="px-4 py-2 text-sm font-medium text-zinc-600 hover:text-zinc-900 transition-colors rounded-full hover:bg-zinc-50">
                    Connexion
                </a>
            </div>
            
            <a href="/create-stand" class="group relative flex items-center gap-2 bg-[#0A2E65] text-white pl-5 pr-1.5 py-1.5 rounded-full text-sm font-medium hover:bg-zinc-800 transition-all active:scale-[0.98]">
                <span>Ouvrir mon stand</span>
                <span class="bg-white text-zinc-950 rounded-full p-1.5 transition-transform duration-300 group-hover:rotate-45">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M7 17l9.2-9.2M17 17V7H7"/>
                    </svg>
                </span>
            </a>

            <!-- Mobile Menu Toggle -->
            <button 
                @click="mobileMenuOpen = !mobileMenuOpen"
                class="lg:hidden p-2 text-zinc-600 hover:text-zinc-950 hover:bg-zinc-100 rounded-full transition-all"
            >
                <svg x-show="!mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
                <svg x-show="mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu Overlay -->
    <template x-teleport="body">
        <div 
            x-show="mobileMenuOpen" 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 backdrop-blur-none"
            x-transition:enter-end="opacity-100 backdrop-blur-md"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 backdrop-blur-md"
            x-transition:leave-end="opacity-0 backdrop-blur-none"
            class="fixed inset-0 z-[60] bg-zinc-950/30 lg:hidden"
            @click="mobileMenuOpen = false"
            style="display: none;"
        >
            <div 
                x-show="mobileMenuOpen"
                x-transition:enter="transition ease-out duration-300 delay-75"
                x-transition:enter-start="opacity-0 translate-y-[-20px] scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                x-transition:leave-end="opacity-0 translate-y-[-20px] scale-95"
                class="absolute top-24 left-4 right-4 bg-white/95 backdrop-blur-xl rounded-[2rem] p-6 shadow-2xl border border-white/20 space-y-6"
                @click.stop
            >
                <nav class="flex flex-col gap-1.5">
                    <a href="#" class="px-5 py-4 text-lg font-semibold text-zinc-900 bg-white shadow-sm ring-1 ring-zinc-200/50 rounded-2xl transition-all">Vendre</a>
                    <a href="#" class="px-5 py-4 text-lg font-medium text-zinc-600 hover:text-zinc-900 hover:bg-zinc-50 rounded-2xl transition-all">Comment ça marche</a>
                    <a href="#" class="px-5 py-4 text-lg font-medium text-zinc-600 hover:text-zinc-900 hover:bg-zinc-50 rounded-2xl transition-all">Tarifs</a>
                    <a href="#" class="px-5 py-4 text-lg font-medium text-zinc-600 hover:text-zinc-900 hover:bg-zinc-50 rounded-2xl transition-all">FAQ</a>
                </nav>
                <hr class="border-zinc-200/60">
                <div class="flex flex-col gap-3">
                    <a href="" class="flex items-center justify-center py-4 text-lg font-semibold text-zinc-700 bg-zinc-100 hover:bg-zinc-200 rounded-2xl transition-colors">
                        Connexion
                    </a>
                    <a href="" class="group flex items-center justify-center gap-2 py-4 text-lg font-semibold text-white bg-zinc-950 rounded-2xl shadow-md hover:bg-zinc-800 transition-all active:scale-[0.98]">
                        <span>Ouvrir mon stand</span>
                        <span class="bg-white/20 text-white rounded-full p-1 transition-transform duration-300 group-hover:rotate-45">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M7 17l9.2-9.2M17 17V7H7"/>
                            </svg>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </template>
</header>
