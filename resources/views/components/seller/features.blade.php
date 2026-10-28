<section class="py-24 md:py-32 bg-[#FDFBF4] relative overflow-hidden">
    <!-- Subtle Top Border / Divider -->
    <div
        class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-[1px] bg-gradient-to-r from-transparent via-zinc-200 to-transparent">
    </div>

    <div class="max-w-7xl mx-auto px-6 relative z-10 flex flex-col items-center">

        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-20 animate-in fade-in slide-in-from-bottom-4 duration-700">
            <h2 class="text-sm font-bold tracking-widest text-[#0A2E65] uppercase mb-4">{{ __('seller.features.eyebrow') }}</h2>
            <h3 class="text-4xl md:text-5xl font-extrabold text-zinc-900 tracking-tight mb-6">
                {{ __('seller.features.title') }}
            </h3>
            <p class="text-lg text-zinc-500 leading-relaxed">
                {{ __('seller.features.subtitle') }}
            </p>
        </div>

        <!-- Features Grid -->
        <div
            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-8 gap-y-12 w-full animate-in fade-in slide-in-from-bottom-8 duration-1000 delay-100">

            <!-- Feature 1 -->
            <div class="flex flex-col group">
                <div
                    class="w-14 h-14 rounded-2xl bg-zinc-50 border border-zinc-100 flex items-center justify-center mb-6 text-[#0A2E65] transition-transform duration-300 group-hover:scale-110 group-hover:shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <h4 class="text-xl font-bold text-zinc-900 mb-3 tracking-tight">{{ __('seller.features.performance_title') }}</h4>
                <p class="text-zinc-500 text-sm leading-relaxed flex-grow">
                    {{ __('seller.features.performance_body') }}
                </p>
            </div>

            <!-- Feature 2 -->
            <div class="flex flex-col group">
                <div
                    class="w-14 h-14 rounded-2xl bg-zinc-50 border border-zinc-100 flex items-center justify-center mb-6 text-[#0A2E65] transition-transform duration-300 group-hover:scale-110 group-hover:shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <h4 class="text-xl font-bold text-zinc-900 mb-3 tracking-tight">{{ __('seller.features.security_title') }}</h4>
                <p class="text-zinc-500 text-sm leading-relaxed flex-grow">
                    {{ __('seller.features.security_body') }}
                </p>
            </div>

            <!-- Feature 3 -->
            <div class="flex flex-col group">
                <div
                    class="w-14 h-14 rounded-2xl bg-zinc-50 border border-zinc-100 flex items-center justify-center mb-6 text-[#0A2E65] transition-transform duration-300 group-hover:scale-110 group-hover:shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                    </svg>
                </div>
                <h4 class="text-xl font-bold text-zinc-900 mb-3 tracking-tight">{{ __('seller.features.management_title') }}</h4>
                <p class="text-zinc-500 text-sm leading-relaxed flex-grow">
                    {{ __('seller.features.management_body') }}
                </p>
            </div>

            <!-- Feature 4 -->
            <div class="flex flex-col group">
                <div
                    class="w-14 h-14 rounded-2xl bg-zinc-50 border border-zinc-100 flex items-center justify-center mb-6 text-[#0A2E65] transition-transform duration-300 group-hover:scale-110 group-hover:shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <h4 class="text-xl font-bold text-zinc-900 mb-3 tracking-tight">{{ __('seller.features.support_title') }}</h4>
                <p class="text-zinc-500 text-sm leading-relaxed flex-grow">
                    {{ __('seller.features.support_body') }}
                </p>
            </div>

        </div>

        <!-- Call To Action -->
        <div class="mt-20 animate-in fade-in slide-in-from-bottom-8 duration-1000 delay-200">
            <a href=""
                class="group relative flex items-center gap-3 bg-[#0A2E65] text-white px-8 py-4 rounded-full text-base font-bold shadow-xl shadow-[#0A2E65]/20 hover:bg-[#0A2E65]/90 transition-all active:scale-[0.98]">
                <span>{{ __('seller.features.cta') }}</span>
                <span class="bg-white/10 p-1.5 rounded-full group-hover:bg-white/20 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-0.5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </span>
            </a>
        </div>

    </div>
</section>