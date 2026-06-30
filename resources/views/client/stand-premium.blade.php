<section class="max-w-[1400px] mx-auto px-4 md:px-8 py-16">
    <!-- Section Header -->
    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-10">
        <div>

            <h2 class="text-3xl md:text-4xl font-black text-zinc-950 tracking-tight">Stands Premiums</h2>
        </div>
        <a href="#"
            class="inline-flex items-center gap-2 text-[15px] font-bold text-blue-600 hover:text-blue-800 transition-colors group">
            Voir tous les stands
            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3">
                </path>
            </svg>
        </a>
    </div>

    <!-- Stands Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 gap-6">
        @php
            $stands = [
                ['cover' => 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?q=80&w=600&auto=format&fit=crop', 'logo' => 'logo2.jpg', 'name' => 'Tech Universe', 'category' => 'Électronique', 'rating' => '4.9', 'desc' => 'Les derniers gadgets et accessoires high-tech.'],
                ['cover' => 'https://images.unsplash.com/photo-1556906781-9a412961c28c?q=80&w=600&auto=format&fit=crop', 'logo' => 'logo3.jpg', 'name' => 'Sneakers Pro', 'category' => 'Chaussures', 'rating' => '4.8', 'desc' => 'Éditions limitées et chaussures de sport.'],
                ['cover' => 'https://images.unsplash.com/photo-1558769132-cb1aea458c5e?q=80&w=600&auto=format&fit=crop', 'logo' => 'logo4.jpg', 'name' => 'Beauté & Soins', 'category' => 'Cosmétiques', 'rating' => '5.0', 'desc' => 'Produits de beauté naturels et soins haut de gamme.'],
                ['cover' => 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?q=80&w=600&auto=format&fit=crop', 'logo' => 'logo5.jpg', 'name' => 'Home Déco', 'category' => 'Maison', 'rating' => '4.7', 'desc' => 'Décoration d\'intérieur moderne.'],
                ['cover' => 'https://images.unsplash.com/photo-1558769132-cb1aea458c5e?q=80&w=600&auto=format&fit=crop', 'logo' => 'logo6.jpg', 'name' => 'Urban Style', 'category' => 'Vêtements', 'rating' => '4.9', 'desc' => 'Mode urbaine et streetwear tendance.'],
            ];
        @endphp

        @foreach($stands as $stand)
            <a href="#"
                class="group bg-white rounded-2xl border border-zinc-200/80 overflow-hidden shadow-sm hover:shadow-xl hover:shadow-[#0A2E65]/5 hover:-translate-y-1 transition-all duration-300 flex flex-col">

                <!-- Top Section: Cover & Avatar -->
                <div class="relative">
                    <!-- Cover / Banner -->
                    <div class="h-28 bg-zinc-100 relative overflow-hidden">
                        <img src="{{ $stand['cover'] }}" alt="Cover {{ $stand['name'] }}"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors duration-300">
                        </div>
                    </div>

                    <!-- Logo Avatar -->
                    <div class="absolute -bottom-6 left-5 z-20">
                        <div
                            class="w-[60px] h-[60px] rounded-xl border-4 border-white bg-white shadow-sm overflow-hidden group-hover:scale-105 group-hover:shadow-md transition-all duration-300">
                            <img src="{{ asset('assets/img/client/' . $stand['logo']) }}" alt="{{ $stand['name'] }}"
                                class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>

                <!-- Details -->
                <div class="pt-9 pb-5 px-5 flex-1 flex flex-col">
                    <div class="flex justify-between items-start mb-3">
                        <div>
                            <h3
                                class="font-bold text-zinc-900 text-[17px] group-hover:text-[#0A2E65] transition-colors leading-tight">
                                {{ $stand['name'] }}
                            </h3>
                            <p class="text-[13px] text-zinc-500 font-medium mt-0.5">{{ $stand['category'] }}</p>
                        </div>
                        <!-- Rating Badge -->
                        <div
                            class="flex items-center gap-1 bg-amber-50 px-1.5 py-1 rounded-lg border border-amber-100/50 shrink-0">
                            <svg class="w-3.5 h-3.5 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                            <span class="text-xs font-bold text-amber-700">{{ $stand['rating'] }}</span>
                        </div>
                    </div>

                    <p class="text-[14px] text-zinc-600 mb-6 line-clamp-2 leading-relaxed flex-1">
                        {{ $stand['desc'] }}
                    </p>

                    <!-- Action Button -->
                    <div
                        class="w-full py-2.5 bg-zinc-50 border border-zinc-200 text-zinc-800 font-bold rounded-xl group-hover:bg-[#0A2E65] group-hover:border-[#0A2E65] group-hover:text-white transition-all duration-300 text-[14px] flex items-center justify-center gap-2">
                        Visiter le stand
                        <svg class="w-4 h-4 opacity-0 -ml-4 group-hover:opacity-100 group-hover:ml-0 transition-all duration-300"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</section>