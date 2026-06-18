@props(['data' => []])
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
                        3
                    </div>
                    <div>
                        <h2 class="text-sm font-bold text-zinc-500 uppercase tracking-wide">Étape 3 sur 4</h2>
                        <p class="text-base md:text-lg font-bold text-zinc-900">Contact</p>
                    </div>
                </div>
                <div class="hidden sm:flex items-center gap-2">
                    <div class="flex items-center">
                        <div class="w-8 h-1 bg-[#0A2E65] rounded-full"></div>
                        <div class="w-8 h-1 bg-[#0A2E65] rounded-full"></div>
                        <div class="w-8 h-1 bg-[#0A2E65] rounded-full"></div>
                        <div class="w-8 h-1 bg-zinc-200 rounded-full"></div>
                    </div>
                </div>
            </div>
            <!-- Mobile Progress Bar -->
            <div class="sm:hidden w-full h-1 bg-zinc-100 rounded-full overflow-hidden">
                <div class="h-full w-3/4 bg-gradient-to-r from-[#0A2E65] to-emerald-500 rounded-full transition-all duration-300"></div>
            </div>
        </div>

        <!-- Main Form Card -->
        <div class="bg-white rounded-[2rem] border border-zinc-100 shadow-[0_20px_40px_-15px_rgba(0,0,0,0.05)] overflow-hidden">
            <!-- Card Header -->
            <div class="p-8 md:p-10 border-b border-zinc-100/50 bg-gradient-to-br from-white to-zinc-50/50">
                <h3 class="text-2xl md:text-3xl font-bold text-zinc-900 mb-2">Vos coordonnées de contact</h3>
                <p class="text-base text-zinc-500 max-w-xl">Ajoutez vos informations de contact pour que vos clients et livreurs puissent vous joindre facilement.</p>
            </div>

            <!-- Form Content -->
            <form action="{{ route('seller.stand.storeStep') }}" method="POST" class="p-8 md:p-10 space-y-8">
                @csrf
                <input type="hidden" name="current_step" value="3">

                <!-- Field 1: Téléphone du stand -->
                <div class="space-y-3 animate-in fade-in slide-in-from-bottom-4 duration-500">
                    <label for="phone" class="block text-sm font-bold text-zinc-900">
                        Téléphone du stand <span class="text-red-500">*</span>
                    </label>
                    <div class="relative group">
                        <input
                            type="tel"
                            id="phone"
                            name="phone"
                            placeholder="ex: +228 90 00 00 00"
                            value="{{ old('phone', $data['phone'] ?? '') }}"
                            class="w-full px-5 py-3.5 text-base bg-white border-2 border-zinc-200 rounded-xl text-zinc-900 placeholder:text-zinc-400 transition-all duration-300 focus:outline-none focus:border-[#0A2E65] focus:ring-4 focus:ring-blue-50 hover:border-zinc-300 @error('phone') border-red-500 @enderror"
                        />
                        @error('phone')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                        <div class="absolute right-4 top-1/2 -translate-y-1/2 text-zinc-400 opacity-0 group-hover:opacity-100 group-focus-within:opacity-100 transition-opacity duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-xs text-zinc-500">Utilisé pour les appels et SMS des clients</p>
                </div>

                <!-- Field 2: WhatsApp (Optionnel) -->
                <div class="space-y-3 animate-in fade-in slide-in-from-bottom-4 duration-500 delay-100">
                    <label for="whatsapp" class="block text-sm font-bold text-zinc-900">
                        WhatsApp (optionnel)
                    </label>
                    <div class="relative group">
                        <input
                            type="tel"
                            id="whatsapp"
                            name="whatsapp"
                            placeholder="ex: +228 90 00 00 01"
                            value="{{ old('whatsapp', $data['whatsapp'] ?? '') }}"
                            class="w-full px-5 py-3.5 text-base bg-white border-2 border-zinc-200 rounded-xl text-zinc-900 placeholder:text-zinc-400 transition-all duration-300 focus:outline-none focus:border-[#0A2E65] focus:ring-4 focus:ring-blue-50 hover:border-zinc-300 @error('whatsapp') border-red-500 @enderror"
                        />
                        @error('whatsapp')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                        <div class="absolute right-4 top-1/2 -translate-y-1/2 text-zinc-400 opacity-0 group-hover:opacity-100 group-focus-within:opacity-100 transition-opacity duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-xs text-zinc-500">Permet aux clients de vous contacter via WhatsApp</p>
                </div>

                <!-- Field 3: Email de contact -->
                <div class="space-y-3 animate-in fade-in slide-in-from-bottom-4 duration-500 delay-200">
                    <label for="email" class="block text-sm font-bold text-zinc-900">
                        Email de contact
                    </label>
                    <div class="relative group">
                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="ex: aminata@kelbom.com"
                            value="{{ old('email', $data['email'] ?? '') }}"
                            class="w-full px-5 py-3.5 text-base bg-white border-2 border-zinc-200 rounded-xl text-zinc-900 placeholder:text-zinc-400 transition-all duration-300 focus:outline-none focus:border-[#0A2E65] focus:ring-4 focus:ring-blue-50 hover:border-zinc-300 @error('email') border-red-500 @enderror"
                        />
                        @error('email')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                        <div class="absolute right-4 top-1/2 -translate-y-1/2 text-zinc-400 opacity-0 group-hover:opacity-100 group-focus-within:opacity-100 transition-opacity duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-xs text-zinc-500">Pour les communications officielles et confirmations de commandes</p>
                </div>

                <!-- Field 4: Site web (Optionnel) -->
                <div class="space-y-3 animate-in fade-in slide-in-from-bottom-4 duration-500 delay-300">
                    <label for="website" class="block text-sm font-bold text-zinc-900">
                        Site web (optionnel)
                    </label>
                    <div class="relative group">
                        <input
                            type="url"
                            id="website"
                            name="website"
                            placeholder="ex: https://..."
                            value="{{ old('website', $data['website'] ?? '') }}"
                            class="w-full px-5 py-3.5 text-base bg-white border-2 border-zinc-200 rounded-xl text-zinc-900 placeholder:text-zinc-400 transition-all duration-300 focus:outline-none focus:border-[#0A2E65] focus:ring-4 focus:ring-blue-50 hover:border-zinc-300 @error('website') border-red-500 @enderror"
                        />
                        @error('website')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                        <div class="absolute right-4 top-1/2 -translate-y-1/2 text-zinc-400 opacity-0 group-hover:opacity-100 group-focus-within:opacity-100 transition-opacity duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.658 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-xs text-zinc-500">Mettez un lien vers votre site officiel ou profil en ligne</p>
                </div>

                <!-- Info Note -->
                <div class="pt-4 px-5 py-4 bg-gradient-to-r from-blue-50 to-emerald-50 rounded-xl border border-blue-100/50 flex items-start gap-3">
                    <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <p class="text-sm font-semibold text-zinc-900">Informations de contact essentielles</p>
                        <p class="text-xs text-zinc-600 mt-1">Le téléphone et l'email sont indispensables pour que les clients et livreurs puissent vous contacter rapidement.</p>
                    </div>
                </div>

            

            <!-- Form Footer / Actions -->
            <div class="px-8 md:px-10 py-8 border-t border-zinc-100/50 bg-gradient-to-r from-zinc-50 to-white flex flex-col sm:flex-row items-center justify-between gap-4">
                <a
                    href="?step=2"
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
            </form>
        </div>

        <!-- Support Section -->
        <div class="mt-8 md:mt-12 text-center">
            <p class="text-sm text-zinc-600">
                Besoin de précisions sur les informations de contact ?
                <a href="#" class="font-bold text-[#0A2E65] hover:text-[#0A2E65]/80 transition-colors duration-300">
                    Consultez nos conseils
                </a>
            </p>
        </div>
    </div>
</section>
