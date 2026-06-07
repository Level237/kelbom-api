<section class="min-h-[100dvh] bg-gradient-to-br from-[#FDFBF4] via-white to-emerald-50/30 py-8 md:py-12 px-4">
    <!-- Background Texture -->
    <div class="fixed inset-0 opacity-[0.02] pointer-events-none"
        style="background-image: url('data:image/svg+xml,%3Csvg width=\'20\' height=\'20\' viewBox=\'0 0 20 20\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'%23000000\' fill-opacity=\'1\' fill-rule=\'evenodd\'%3E%3Ccircle cx=\'3\' cy=\'3\' r=\'1\'/%3E%3Ccircle cx=\'13\' cy=\'13\' r=\'1\'/%3E%3C/g%3E%3C/svg%3E');">
    </div>

    <!-- Background Blur Elements -->
    <div class="fixed top-1/4 -left-40 w-96 h-96 bg-emerald-200/20 blur-[120px] rounded-full pointer-events-none -z-10"></div>
    <div class="fixed bottom-1/3 -right-40 w-96 h-96 bg-blue-100/20 blur-[120px] rounded-full pointer-events-none -z-10"></div>

    <div class="max-w-3xl mx-auto relative z-10">
        <!-- Step Indicator -->
        <div class="mb-8 md:mb-12">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-[#0A2E65] text-white flex items-center justify-center text-sm font-bold shadow-lg shadow-blue-900/20">
                        2
                    </div>
                    <div>
                        <h2 class="text-sm font-bold text-zinc-500 uppercase tracking-wide">Étape 2 sur 4</h2>
                        <p class="text-base md:text-lg font-bold text-zinc-900">Localisation</p>
                    </div>
                </div>
                <div class="hidden sm:flex items-center gap-2">
                    <div class="flex items-center">
                        <div class="w-8 h-1 bg-[#0A2E65] rounded-full"></div>
                        <div class="w-8 h-1 bg-[#0A2E65] rounded-full"></div>
                        <div class="w-8 h-1 bg-zinc-200 rounded-full"></div>
                        <div class="w-8 h-1 bg-zinc-200 rounded-full"></div>
                    </div>
                </div>
            </div>
            <!-- Mobile Progress Bar -->
            <div class="sm:hidden w-full h-1 bg-zinc-100 rounded-full overflow-hidden">
                <div class="h-full w-2/4 bg-gradient-to-r from-[#0A2E65] to-emerald-500 rounded-full transition-all duration-300"></div>
            </div>
        </div>

        <!-- Main Form Card -->
        <div class="bg-white rounded-[2rem] border border-zinc-100 shadow-[0_20px_40px_-15px_rgba(0,0,0,0.05)] overflow-hidden">
            <!-- Card Header -->
            <div class="p-8 md:p-10 border-b border-zinc-100/50 bg-gradient-to-br from-white to-zinc-50/50">
                <h3 class="text-2xl md:text-3xl font-bold text-zinc-900 mb-2">Où se situe votre stand ?</h3>
                <p class="text-base text-zinc-500 max-w-xl">Indiquez la localisation précise de votre point de vente pour faciliter la livraison.</p>
            </div>

            <!-- Form Content -->
            <form class="p-8 md:p-10 space-y-8">

                <!-- Field 1: Pays -->
                <div class="space-y-3 animate-in fade-in slide-in-from-bottom-4 duration-500">
                    <label for="country" class="block text-sm font-bold text-zinc-900">
                        Pays <span class="text-red-500">*</span>
                    </label>
                    <div class="relative group">
                        <select
                            id="country"
                            name="country"
                            class="w-full px-5 py-3.5 text-base bg-white border-2 border-zinc-200 rounded-xl text-zinc-900 transition-all duration-300 focus:outline-none focus:border-[#0A2E65] focus:ring-4 focus:ring-blue-50 hover:border-zinc-300 appearance-none cursor-pointer"
                        >
                            <option value="">Sélectionnez un pays</option>
                            <option value="togo" selected>Togo</option>
                            <option value="benin">Bénin</option>
                            <option value="burkina">Burkina Faso</option>
                            <option value="cotedivoire">Côte d'Ivoire</option>
                            <option value="ghana">Ghana</option>
                            <option value="mali">Mali</option>
                            <option value="niger">Niger</option>
                            <option value="senegal">Sénégal</option>
                        </select>
                        <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-zinc-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Field 2: Ville -->
                <div class="space-y-3 animate-in fade-in slide-in-from-bottom-4 duration-500 delay-100">
                    <label for="city" class="block text-sm font-bold text-zinc-900">
                        Ville <span class="text-red-500">*</span>
                    </label>
                    <div class="relative group">
                        <select
                            id="city"
                            name="city"
                            class="w-full px-5 py-3.5 text-base bg-white border-2 border-zinc-200 rounded-xl text-zinc-900 transition-all duration-300 focus:outline-none focus:border-[#0A2E65] focus:ring-4 focus:ring-blue-50 hover:border-zinc-300 appearance-none cursor-pointer"
                        >
                            <option value="">Sélectionnez une ville</option>
                            <option value="lome" selected>Lomé</option>
                            <option value="sokode">Sokodé</option>
                            <option value="kara">Kara</option>
                            <option value="mango">Mango</option>
                            <option value="dapaong">Dapaong</option>
                        </select>
                        <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-zinc-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-xs text-zinc-500">Sélectionnez la ville principale où opère votre stand</p>
                </div>

                <!-- Field 3: Quartier / Zone -->
                <div class="space-y-3 animate-in fade-in slide-in-from-bottom-4 duration-500 delay-200">
                    <label for="zone" class="block text-sm font-bold text-zinc-900">
                        Quartier / Zone <span class="text-red-500">*</span>
                    </label>
                    <div class="relative group">
                        <input
                            type="text"
                            id="zone"
                            name="zone"
                            placeholder="ex: Tokoin"
                            value="Tokoin"
                            class="w-full px-5 py-3.5 text-base bg-white border-2 border-zinc-200 rounded-xl text-zinc-900 placeholder:text-zinc-400 transition-all duration-300 focus:outline-none focus:border-[#0A2E65] focus:ring-4 focus:ring-blue-50 hover:border-zinc-300"
                        />
                        <div class="absolute right-4 top-1/2 -translate-y-1/2 text-zinc-400 opacity-0 group-hover:opacity-100 group-focus-within:opacity-100 transition-opacity duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-xs text-zinc-500">Indiquez le quartier ou la zone géographique précise</p>
                </div>

                <!-- Field 4: Adresse complète -->
                <div class="space-y-3 animate-in fade-in slide-in-from-bottom-4 duration-500 delay-300">
                    <label for="address" class="block text-sm font-bold text-zinc-900">
                        Adresse complète
                    </label>
                    <div class="relative group">
                        <textarea
                            id="address"
                            name="address"
                            rows="3"
                            placeholder="ex: Derrière le marché de Tokoin, près de la station Total"
                            class="w-full px-5 py-3.5 text-base bg-white border-2 border-zinc-200 rounded-xl text-zinc-900 placeholder:text-zinc-400 transition-all duration-300 focus:outline-none focus:border-[#0A2E65] focus:ring-4 focus:ring-blue-50 hover:border-zinc-300 resize-none"
                        >Derrière le marché de Tokoin, près de la station Total</textarea>
                        <div class="absolute bottom-3 right-4 text-xs text-zinc-400">
                            <span class="char-count">50</span>/300
                        </div>
                    </div>
                    <p class="text-xs text-zinc-500">Donnez des repères visuels pour aider les clients et livreurs à vous localiser (maximum 300 caractères)</p>
                </div>

                <!-- Location Map Preview (Optional Visual) -->
                <div class="mt-8 pt-8 border-t border-zinc-100">
                    <div class="space-y-3">
                        <label class="block text-sm font-bold text-zinc-900">Aperçu de la localisation</label>
                        <div class="w-full h-64 bg-gradient-to-br from-zinc-100 to-zinc-50 rounded-xl border-2 border-dashed border-zinc-200 flex items-center justify-center">
                            <div class="text-center">
                                <svg class="w-12 h-12 mx-auto text-zinc-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <p class="text-sm font-semibold text-zinc-700">Carte interactive</p>
                                <p class="text-xs text-zinc-500 mt-1">Cliquez pour afficher votre localisation sur la carte</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Required Fields Note -->
                <div class="pt-4 px-5 py-4 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl border border-emerald-100/50 flex items-start gap-3">
                    <svg class="w-5 h-5 text-emerald-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <p class="text-sm font-semibold text-zinc-900">Informations géographiques précises</p>
                        <p class="text-xs text-zinc-600 mt-1">Une localisation exacte garantit des livraisons rapides et des clients satisfaits.</p>
                    </div>
                </div>

            </form>

            <!-- Form Footer / Actions -->
            <div class="px-8 md:px-10 py-8 border-t border-zinc-100/50 bg-gradient-to-r from-zinc-50 to-white flex flex-col sm:flex-row items-center justify-between gap-4">
                <a
                    href="?step=1"
                    class="hidden sm:flex items-center justify-center gap-2 px-8 py-3.5 text-sm font-bold text-zinc-700 bg-white border-2 border-zinc-200 rounded-full hover:border-zinc-300 hover:bg-zinc-50 transition-all duration-300 active:scale-95"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    <span>Précédent</span>
                </a>

                <div class="flex flex-col sm:flex-row items-center gap-3 w-full sm:w-auto">
                    <button
                        type="button"
                        data-action="cancel"
                        class="w-full sm:w-auto px-8 py-3.5 text-sm font-bold text-zinc-700 bg-white border-2 border-zinc-200 rounded-full hover:border-zinc-300 hover:bg-zinc-50 transition-all duration-300 active:scale-95 sm:hidden"
                    >
                        Annuler
                    </button>
                    <button
                        type="button"
                        data-action="next-step"
                        class="w-full sm:flex-1 px-8 py-3.5 text-sm font-bold text-white bg-gradient-to-r from-[#0A2E65] to-[#0A2E65]/80 rounded-full hover:from-[#0A2E65]/90 hover:to-[#0A2E65]/70 shadow-lg shadow-blue-900/20 transition-all duration-300 active:scale-95 flex items-center justify-center gap-2"
                    >
                        <span>Suivant</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Support Section -->
        <div class="mt-8 md:mt-12 text-center">
            <p class="text-sm text-zinc-600">
                Besoin de préciser votre localisation ?
                <a href="#" class="font-bold text-[#0A2E65] hover:text-[#0A2E65]/80 transition-colors duration-300">
                    Utiliser Google Maps
                </a>
            </p>
        </div>
    </div>

    <script>
        // Character counter for textareas
        document.querySelectorAll('textarea').forEach(textarea => {
            const updateCount = () => {
                const count = textarea.value.length;
                const container = textarea.closest('div');
                const counter = container.querySelector('.char-count');
                if (counter) counter.textContent = count;
            };
            textarea.addEventListener('input', updateCount);
        });

        // Dynamic city population based on country
        const countrySelect = document.getElementById('country');
        const citySelect = document.getElementById('city');

        const citiesByCountry = {
            'togo': ['Lomé', 'Sokodé', 'Kara', 'Mango', 'Dapaong'],
            'benin': ['Cotonou', 'Porto-Novo', 'Parakou', 'Djougou'],
            'burkina': ['Ouagadougou', 'Bobo-Dioulasso', 'Koudougou'],
            'cotedivoire': ['Abidjan', 'Yamoussoukro', 'Bouaké'],
            'ghana': ['Accra', 'Kumasi', 'Takoradi', 'Sekondi'],
            'mali': ['Bamako', 'Ségou', 'Kayes'],
            'niger': ['Niamey', 'Maradi', 'Zinder'],
            'senegal': ['Dakar', 'Thiès', 'Kaolack', 'Saint-Louis']
        };

        countrySelect.addEventListener('change', function() {
            const country = this.value;
            citySelect.innerHTML = '<option value="">Sélectionnez une ville</option>';
            
            if (country && citiesByCountry[country]) {
                citiesByCountry[country].forEach(city => {
                    const option = document.createElement('option');
                    option.value = city.toLowerCase().replace(/\s+/g, '-');
                    option.textContent = city;
                    citySelect.appendChild(option);
                });
            }
        });

        // Form validation feedback
        document.querySelectorAll('input[type="text"], select, textarea').forEach(field => {
            field.addEventListener('blur', function() {
                if (this.value.trim()) {
                    this.classList.remove('border-zinc-200');
                    this.classList.add('border-emerald-300');
                }
            });

            field.addEventListener('focus', function() {
                this.classList.remove('border-emerald-300');
                this.classList.add('border-zinc-200');
            });
        });
    </script>
</section>
