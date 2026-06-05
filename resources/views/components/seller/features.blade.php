<section class="relative py-24 md:py-32 bg-gradient-to-br from-[#0B3A36] to-[#0A2E65] overflow-hidden flex items-center">
    
    <!-- Background Artistic Grid -->
    <div class="absolute inset-0 pointer-events-none opacity-20">
        <div class="absolute top-[-10%] left-[-5%] w-[60%] h-[120%] grid grid-cols-3 grid-rows-5 gap-4 rotate-[-5deg]">
            @for ($i = 0; $i < 15; $i++)
                <div class="w-full h-full bg-white/5 rounded-3xl backdrop-blur-sm border border-white/10"></div>
            @endfor
        </div>
    </div>
    
    <div class="absolute top-0 right-0 w-full h-full bg-gradient-to-l from-transparent via-[#0B3A36]/50 to-transparent pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10 w-full grid grid-cols-1 lg:grid-cols-12 gap-16 lg:gap-8 items-center">
        
        <!-- Left Side: Staggered Images -->
        <div class="lg:col-span-5 relative min-h-[500px] md:min-h-[600px] flex justify-center lg:justify-start">
            
            <!-- Image 1 (Top Right) -->
            <div class="absolute top-0 right-[10%] w-[55%] aspect-[3/4] rounded-[2rem] overflow-hidden shadow-2xl shadow-black/40 border border-white/10 animate-float-slow z-20">
                <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&q=80&w=600" alt="Vendeur" class="w-full h-full object-cover">
            </div>
            
            <!-- Image 2 (Middle Left) -->
            <div class="absolute top-[25%] left-[5%] w-[55%] aspect-square rounded-[2rem] overflow-hidden shadow-2xl shadow-black/40 border border-white/10 animate-float-slow" style="animation-delay: 1.5s;">
                <img src="https://images.unsplash.com/photo-1556740758-90de374c12ad?auto=format&fit=crop&q=80&w=600" alt="Artisan" class="w-full h-full object-cover grayscale-[20%] sepia-[10%]">
            </div>
            
            <!-- Image 3 (Bottom Right) -->
            <div class="absolute bottom-[-5%] right-[15%] w-[50%] aspect-[4/5] rounded-[2rem] overflow-hidden shadow-2xl shadow-black/40 border border-white/10 animate-float-slow z-30" style="animation-delay: 3s;">
                <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&q=80&w=600" alt="Créatrice" class="w-full h-full object-cover">
            </div>

            <!-- Floating Decoration -->
            <div class="absolute top-[45%] left-0 w-16 h-16 bg-emerald-500/20 backdrop-blur-xl rounded-full border border-emerald-500/30 flex items-center justify-center animate-pulse">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                </svg>
            </div>
        </div>

        <!-- Right Side: Content -->
        <div class="lg:col-span-7 lg:pl-10 text-white flex flex-col justify-center">
            
            <h2 class="text-4xl md:text-5xl lg:text-6xl font-light tracking-tight mb-6" style="font-family: 'Playfair Display', Georgia, serif;">
                Pourquoi choisir Kelbom
            </h2>
            
            <p class="text-white/70 text-lg leading-relaxed mb-16 max-w-2xl">
                Votre partenaire de confiance pour le succès de vos ventes en ligne. Forts d'une technologie robuste et d'un accompagnement personnalisé, nous sommes là pour vous guider vers la réussite de votre stand.
            </p>

            <!-- Features Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-12 gap-y-12">
                
                <!-- Feature 1 -->
                <div class="group relative">
                    <div class="mb-5 text-emerald-400 transform transition-transform duration-300 group-hover:-translate-y-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-medium mb-3 border-b border-white/10 pb-3 group-hover:border-white/30 transition-colors">Technologie de pointe</h3>
                    <p class="text-sm text-white/60 leading-relaxed group-hover:text-white/80 transition-colors">
                        Bénéficiez de notre infrastructure moderne et ultra-rapide pour garantir une expérience sans faille à vos clients, du catalogue au paiement.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="group relative">
                    <div class="mb-5 text-emerald-400 transform transition-transform duration-300 group-hover:-translate-y-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-medium mb-3 border-b border-white/10 pb-3 group-hover:border-white/30 transition-colors">Service Personnalisé</h3>
                    <p class="text-sm text-white/60 leading-relaxed group-hover:text-white/80 transition-colors">
                        Profitez de solutions sur-mesure adaptées à vos besoins uniques. Notre équipe garantit une attention individuelle pour atteindre vos objectifs.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="group relative">
                    <div class="mb-5 text-emerald-400 transform transition-transform duration-300 group-hover:-translate-y-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-medium mb-3 border-b border-white/10 pb-3 group-hover:border-white/30 transition-colors">Vision d'Avenir</h3>
                    <p class="text-sm text-white/60 leading-relaxed group-hover:text-white/80 transition-colors">
                        Accédez à des stratégies novatrices qui maximisent votre potentiel de vente. Gardez une longueur d'avance dans un marché en constante évolution.
                    </p>
                </div>

                <!-- Feature 4 -->
                <div class="group relative">
                    <div class="mb-5 text-emerald-400 transform transition-transform duration-300 group-hover:-translate-y-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-medium mb-3 border-b border-white/10 pb-3 group-hover:border-white/30 transition-colors">Résultats Prouvés</h3>
                    <p class="text-sm text-white/60 leading-relaxed group-hover:text-white/80 transition-colors">
                        Faites confiance à notre historique de succès. Nous avons aidé de nombreux vendeurs à atteindre et dépasser leurs aspirations financières.
                    </p>
                </div>

            </div>

            <!-- Call To Action -->
            <div class="mt-16">
                <a href="#" class="inline-flex items-center gap-3 bg-white text-[#0A2E65] px-8 py-4 rounded-full text-base font-bold shadow-xl shadow-black/20 hover:scale-105 hover:bg-zinc-50 transition-all group">
                    <span>Créer mon stand gratuitement</span>
                    <span class="bg-[#0A2E65]/10 p-1.5 rounded-full group-hover:bg-[#0A2E65]/20 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </span>
                </a>
            </div>

        </div>
    </div>
</section>
