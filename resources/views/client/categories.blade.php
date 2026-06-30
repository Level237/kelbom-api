<section class="max-w-[1400px] mx-auto px-4 md:px-8 py-10">
    <!-- Header -->
    <div class="flex items-end justify-between mb-6">
        <h2 class="text-2xl md:text-[28px] font-black text-[#0A2E65] tracking-tight">Catégories Principales</h2>
        <a href="#" class="text-[14px] font-bold text-[#0A2E65] hover:text-blue-800 flex items-center gap-1.5 transition-colors group">
            Voir tout 
            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
        </a>
    </div>

    <div class="flex flex-col lg:flex-row gap-5">
        <!-- Highlight Card (Left) -->
        <div class="lg:w-1/4 rounded-xl bg-gradient-to-b from-[#132A5A] to-[#061021] text-white p-6 relative overflow-hidden flex flex-col shadow-md">
            
            <!-- Abstract background shape -->
            <div class="absolute top-10 left-1/2 -translate-x-1/2 w-32 h-32 bg-blue-500/20 rounded-full blur-2xl"></div>
            
            <div class="absolute inset-0 flex justify-center items-start pt-12 opacity-80 pointer-events-none">
                <svg width="120" height="120" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M50 10 L85 30 L85 70 L50 90 L15 70 L15 30 Z" stroke="url(#paint0_linear)" stroke-width="2" fill="url(#paint1_linear)"/>
                    <path d="M50 10 L50 50 L85 70 M15 70 L50 50 M15 30 L50 50 M85 30 L50 50" stroke="url(#paint0_linear)" stroke-width="1.5" stroke-dasharray="2 2" opacity="0.5"/>
                    <defs>
                        <linearGradient id="paint0_linear" x1="50" y1="10" x2="50" y2="90" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#4F46E5"/>
                            <stop offset="1" stop-color="#F59E0B"/>
                        </linearGradient>
                        <linearGradient id="paint1_linear" x1="50" y1="10" x2="50" y2="90" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#4F46E5" stop-opacity="0.2"/>
                            <stop offset="1" stop-color="#F59E0B" stop-opacity="0.1"/>
                        </linearGradient>
                    </defs>
                </svg>
            </div>
            
            <div class="relative z-10 mt-auto pt-44">
                <ul class="space-y-2.5 mb-5 text-[14px] text-blue-100 font-medium">
                    <li class="hover:text-white cursor-pointer transition-colors flex items-center gap-2">
                        <span class="w-1 h-1 rounded-full bg-blue-400"></span> Produits Populaires
                    </li>
                    <li class="hover:text-white cursor-pointer transition-colors flex items-center gap-2">
                        <span class="w-1 h-1 rounded-full bg-blue-400"></span> Nouvelles Tendances
                    </li>
                    <li class="hover:text-white cursor-pointer transition-colors flex items-center gap-2">
                        <span class="w-1 h-1 rounded-full bg-blue-400"></span> Ventes Flash
                    </li>
                    <li class="hover:text-white cursor-pointer transition-colors flex items-center gap-2">
                        <span class="w-1 h-1 rounded-full bg-blue-400"></span> Offres Spéciales
                    </li>
                </ul>
                <a href="#" class="block w-full py-2.5 bg-white text-[#132A5A] text-center font-bold rounded-lg hover:bg-zinc-100 transition-colors shadow-sm text-sm">
                    Tout voir
                </a>
            </div>
        </div>

        <!-- Grid of Categories (Right) -->
        <div class="lg:w-3/4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($categories as $category)
            <div class="bg-white rounded-xl border border-zinc-200 p-5 shadow-sm hover:shadow-md hover:border-zinc-300 transition-all group">
                <h3 class="font-bold text-zinc-900 mb-3 text-[15px] group-hover:text-[#0A2E65] transition-colors">{{ $category->name }}</h3>
                <ul class="space-y-2.5">
                    @foreach($category->children as $child)
                    <li>
                        <a href="#" class="text-[14px] text-zinc-600 hover:text-[#0A2E65] transition-colors line-clamp-1">
                            {{ $child->name }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endforeach
        </div>
    </div>
</section>
