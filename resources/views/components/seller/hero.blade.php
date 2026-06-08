<section
    class="relative pt-32 pb-0 overflow-hidden bg-[#FDFBF4] min-h-[90dvh] flex flex-col items-center justify-start border-b border-zinc-200/50">
    <!-- Subtle Background Texture/Pattern -->
    <div class="absolute inset-0 opacity-[0.04] pointer-events-none"
        style="background-image: url('data:image/svg+xml,%3Csvg width=\'20\' height=\'20\' viewBox=\'0 0 20 20\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'%23000000\' fill-opacity=\'1\' fill-rule=\'evenodd\'%3E%3Ccircle cx=\'3\' cy=\'3\' r=\'1\'/%3E%3Ccircle cx=\'13\' cy=\'13\' r=\'1\'/%3E%3C/g%3E%3C/svg%3E');">
    </div>

    <!-- Background Gradient Glows -->
    <div
        class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-4xl h-[400px] bg-emerald-100/40 blur-[100px] rounded-full pointer-events-none -z-10">
    </div>

    <div class="max-w-6xl mx-auto px-6 relative z-10 flex flex-col items-center text-center mt-10 md:mt-16 w-full">

        <!-- Trust Badge -->
        <div
            class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-white border border-zinc-200 shadow-sm mb-8 animate-in fade-in slide-in-from-bottom-4 duration-700">
            <div class="flex text-amber-400 text-sm">
                ★★★★★
            </div>
            <span class="text-xs font-bold text-zinc-700">Plateforme choisie par +1,200 vendeurs</span>
        </div>

        <!-- Hero Content -->
        <div class="space-y-6 max-w-4xl animate-in fade-in slide-in-from-bottom-6 duration-1000 delay-100">
            <h1 class="text-5xl md:text-7xl lg:text-[5rem] font-bold tracking-tight text-zinc-900 leading-[1.05]">
                Le système complet <br class="hidden md:block" /> pour votre <span class="text-[#0A2E65]">Stand en
                    Ligne</span>
            </h1>

            <p class="text-lg md:text-xl text-zinc-500 max-w-2xl mx-auto leading-relaxed">
                Kelbom est l'écosystème sécurisé et performant qui propulse les ventes des commerçants, artisans et
                créateurs avec une simplicité instantanée.
            </p>
        </div>

        <!-- Call to Actions -->
        <div
            class="flex flex-col sm:flex-row items-center justify-center gap-4 mt-10 animate-in fade-in slide-in-from-bottom-8 duration-1000 delay-200">
            <a href="{{ route('seller.access-route') }}"
                class="group relative flex items-center justify-center gap-2 bg-[#0A2E65] text-white px-8 py-4 rounded-full text-base font-bold hover:bg-[#0A2E65]/80 transition-all shadow-lg shadow-emerald-900/20 active:scale-[0.98]">
                <span>Créer mon stand</span>
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </a>
            <a href="#"
                class="flex items-center justify-center gap-2 bg-white text-zinc-900 px-8 py-4 rounded-full text-base font-bold hover:bg-zinc-50 transition-all shadow-sm border border-zinc-200 active:scale-[0.98]">
                Explorer la plateforme
            </a>
        </div>

        <!-- Features Mini Cards -->
        <div class="flex flex-wrap items-center justify-center gap-3 mt-12 animate-in fade-in duration-1000 delay-300">
            <div class="flex items-center gap-3 bg-white px-5 py-3 rounded-2xl border border-zinc-100 shadow-sm">
                <div class="text-emerald-600 bg-emerald-50 p-2 rounded-xl"><svg class="w-5 h-5" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                        </path>
                    </svg></div>
                <div class="text-left text-sm font-bold text-zinc-800 leading-tight">Paiement Sécurisé <span
                        class="text-zinc-400 font-medium block text-[11px]">100% garanti</span></div>
            </div>
            <div class="flex items-center gap-3 bg-white px-5 py-3 rounded-2xl border border-zinc-100 shadow-sm">
                <div class="text-blue-600 bg-blue-50 p-2 rounded-xl"><svg class="w-5 h-5" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9">
                        </path>
                    </svg></div>
                <div class="text-left text-sm font-bold text-zinc-800 leading-tight">Support Global <span
                        class="text-zinc-400 font-medium block text-[11px]">24/7 Assistance</span></div>
            </div>
            <div class="flex items-center gap-3 bg-white px-5 py-3 rounded-2xl border border-zinc-100 shadow-sm">
                <div class="text-amber-500 bg-amber-50 p-2 rounded-xl"><svg class="w-5 h-5" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg></div>
                <div class="text-left text-sm font-bold text-zinc-800 leading-tight">Vente Rapide <span
                        class="text-zinc-400 font-medium block text-[11px]">En ligne en 2 min</span></div>
            </div>
        </div>

        <!-- Dashboard Mockup (Hero Visual) -->


    </div>
</section>