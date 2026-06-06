@php
    $steps = [
        [
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m2 7 4.41-4.41A2 2 0 0 1 7.83 2h8.34a2 2 0 0 1 1.42.59L22 7"/><path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"/><path d="M15 22v-4a2 2 0 0 0-2-2h-2a2 2 0 0 0-2 2v4"/><path d="M2 7h20"/><path d="M22 7v3a2 2 0 0 1-2 2v0a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 16 12a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 12 12a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 8 12a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 4 12v0a2 2 0 0 1-2-2V7"/></svg>',
            'title' => 'Créez votre stand',
            'description' => 'Choisissez un nom, ajoutez votre logo, décrivez votre activité et votre localisation.'
        ],
        [
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m7.5 4.27 9 5.15"/><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="m3.3 7 8.7 5 8.7-5"/><path d="M12 22V12"/></svg>',
            'title' => 'Ajoutez vos produits ou services',
            'description' => 'Ajoutez vos produits et services avec photos, prix, descriptions et spécifications techniques.'
        ],
        [
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>',
            'title' => 'Achetez des crédits',
            'description' => 'Les crédits BuyLeads vous donnent accès aux demandes d\'acheteurs qualifiés.'
        ],
        [
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>',
            'title' => 'Contactez les acheteurs',
            'description' => 'Consultez les leads, envoyez vos devis et concluez vos ventes hors plateforme.'
        ]
    ];
@endphp

<section id="how" class="py-24 md:py-32 bg-[#FDFBF4] relative overflow-hidden border-t border-zinc-200/50">
    <!-- Subtle Background Elements -->


    <div class="max-w-7xl mx-auto px-6 relative z-10">

        <!-- Header -->
        <div class="text-center max-w-3xl mx-auto mb-20">
            <span
                class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#0A2E65]/10 text-[#0A2E65] text-xs font-bold tracking-widest uppercase mb-4">
                <span class="w-1.5 h-1.5 rounded-full bg-[#0A2E65] animate-pulse"></span>
                Simple et rapide
            </span>
            <h2 class="text-4xl md:text-5xl font-extrabold text-zinc-900 tracking-tight mb-6">
                Lancez-vous en <span class="text-[#0A2E65] relative inline-block">4 Etapes</span>
            </h2>
            <p class="text-lg text-zinc-500">
                Un processus fluide et transparent pour mettre en valeur votre activité et attirer de nouveaux clients
                rapidement.
            </p>
        </div>

        <!-- Steps Wrapper -->
        <div class="relative">
            <!-- Connecting Line (Desktop) -->
            <div
                class="hidden lg:block absolute top-[45px] left-[12%] right-[12%] h-[2px] bg-gradient-to-r from-[#0A2E65]/10 via-[#0A2E65]/10 to-[#0A2E65]/10 z-0">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-8 relative z-10">
                @foreach($steps as $i => $step)
                    <div class="relative flex flex-col items-center text-center group">

                        <!-- Step Indicator & Icon Container -->
                        <div class="relative mb-8">
                            <!-- Background glow on hover -->
                            <div
                                class="absolute inset-0 bg-[#0A2E65] rounded-[2rem] blur-xl opacity-0 group-hover:opacity-50 transition-opacity duration-500">
                            </div>

                            <!-- Icon Box -->
                            <div
                                class="relative w-24 h-24 bg-white rounded-[2rem] shadow-xl shadow-zinc-200/50 border border-zinc-100 flex items-center justify-center text-[#0A2E65] transform transition-transform duration-500 group-hover:-translate-y-2 group-hover:shadow-2xl">
                                <div class="w-10 h-10">
                                    {!! $step['icon'] !!}
                                </div>
                            </div>

                            <!-- Number Badge -->
                            <div
                                class="absolute -top-3 -right-3 w-8 h-8 bg-[#0A2E65] text-white rounded-full flex items-center justify-center text-sm font-bold shadow-md shadow-emerald-500/30 border-2 border-white">
                                {{ $i + 1 }}
                            </div>
                        </div>

                        <!-- Content -->
                        <h3
                            class="text-xl font-bold text-zinc-900 mb-3 tracking-tight group-hover:text-[#0A2E65] transition-colors">
                            {{ $step['title'] }}
                        </h3>
                        <p class="text-zinc-500 text-sm leading-relaxed px-2">
                            {{ $step['description'] }}
                        </p>

                    </div>
                @endforeach
            </div>
        </div>

    </div>
</section>