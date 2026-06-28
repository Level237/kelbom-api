<section class="relative w-full min-h-[600px] md:min-h-[85vh] flex items-center bg-zinc-900 overflow-hidden">
    <!-- Slider Image Background (Prepared for multiple slides later) -->
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('assets/img/slider.jpg') }}" alt="Slider Background"
            class="w-full h-full object-cover object-center opacity-90" />
        <!-- Dark gradient overlay for text readability -->
        <div class="absolute inset-0 bg-gradient-to-r from-zinc-950/80 via-zinc-900/50 to-transparent"></div>
    </div>

    <!-- Hero Content -->
    <div class="relative z-10 max-w-[1400px] mx-auto px-6 md:px-12 w-full mt-24 md:mt-0">
        <div class="max-w-3xl space-y-8 animate-in fade-in slide-in-from-bottom-8 duration-1000">
            <h1
                class="text-5xl max-sm:text-4xl md:text-6xl lg:text-[4rem] font-extrabold text-white leading-[1.1] tracking-tight">
                Des milliers de vendeurs ont déjà ouvert leur stand

            </h1>

            <p class="text-md md:text-xl text-zinc-300 max-w-xl font-medium leading-relaxed">
                Les nouveaux vendeurs peuvent bénéficier de nombreux avantages et soutiens promotionnels de la part de
                Kelbom. Démarrez dès maintenant.
            </p>

            <div class="pt-4 flex flex-col sm:flex-row items-start gap-4">
                <a href="{{ route('seller.access-route') ?? '/register' }}"
                    class="group inline-flex items-center justify-center gap-3 px-8 py-4 text-base font-bold text-[#FDFBF4] bg-black  rounded-full transition-all border border-white/10 active:scale-[0.98]">
                    <span>Commencer à vendre</span>
                    <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Pagination dots placeholder for future slider -->
    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex gap-2.5 z-10">
        <button class="w-8 h-1.5 bg-white rounded-full transition-all" aria-label="Slide 1"></button>
        <button class="w-2 h-1.5 bg-white/40 hover:bg-white/60 rounded-full transition-all"
            aria-label="Slide 2"></button>
        <button class="w-2 h-1.5 bg-white/40 hover:bg-white/60 rounded-full transition-all"
            aria-label="Slide 3"></button>
    </div>
</section>