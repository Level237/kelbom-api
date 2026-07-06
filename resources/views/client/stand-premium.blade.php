<section class="max-w-[1400px] mx-auto px-4 md:px-8 py-16" x-data="{
    intervalId: null,
    scroll(direction) {
        const carousel = $refs.carousel;
        const scrollAmount = carousel.clientWidth / 1.5;
        if (direction === 'left') {
            if (carousel.scrollLeft <= 0) {
                carousel.scrollBy({ left: carousel.scrollWidth, behavior: 'smooth' });
            } else {
                carousel.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
            }
        } else {
            if (carousel.scrollLeft >= carousel.scrollWidth - carousel.clientWidth - 10) {
                carousel.scrollTo({ left: 0, behavior: 'smooth' });
            } else {
                carousel.scrollBy({ left: scrollAmount, behavior: 'smooth' });
            }
        }
    },
    startAutoScroll() {
        this.intervalId = setInterval(() => {
            this.scroll('right');
        }, 4000);
    },
    stopAutoScroll() {
        if (this.intervalId) {
            clearInterval(this.intervalId);
        }
    }
}" x-init="startAutoScroll()" @mouseenter="stopAutoScroll()" @mouseleave="startAutoScroll()">
    <!-- Section Header -->
    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-10">
        <div>
            <h2 class="text-3xl md:text-4xl font-black text-zinc-950 tracking-tight">Stands Premiums</h2>
            <p class="text-zinc-500 mt-2 font-medium">Découvrez nos meilleurs vendeurs certifiés.</p>
        </div>

        <div class="flex items-center gap-4">
            <!-- Navigation Buttons -->
            <div class="hidden sm:flex items-center gap-2 mr-4">
                <button @click="scroll('left')"
                    class="w-10 h-10 rounded-full border border-zinc-200 bg-white flex items-center justify-center text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900 transition-colors shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                        </path>
                    </svg>
                </button>
                <button @click="scroll('right')"
                    class="w-10 h-10 rounded-full border border-zinc-200 bg-white flex items-center justify-center text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900 transition-colors shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>

            <a href="{{ route('client.marketplace') }}"
                class="inline-flex items-center gap-2 text-[15px] font-bold text-blue-600 hover:text-blue-800 transition-colors group">
                Voir tous les stands
                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M17 8l4 4m0 0l-4 4m4-4H3">
                    </path>
                </svg>
            </a>
        </div>
    </div>

    <!-- Stands Carousel -->
    <div x-ref="carousel" class="flex gap-6 overflow-x-auto snap-x snap-mandatory no-scrollbar pb-8 -mb-8">
        @forelse($premiumStands ?? [] as $stand)
            <a href="{{ route('client.stand.show', $stand->slug) }}"
                class="group bg-white rounded-2xl border border-zinc-200/80 overflow-hidden shadow-sm hover:shadow-xl hover:shadow-[#0A2E65]/5 hover:-translate-y-1 transition-all duration-300 flex flex-col shrink-0 w-[280px] sm:w-[320px] snap-start">

                <!-- Top Section: Cover & Avatar -->
                <div class="relative">
                    <!-- Cover / Banner -->
                    <div class="h-28 bg-zinc-100 relative overflow-hidden">
                        @if($stand->cover_url)
                            <img src="{{ str_starts_with($stand->cover_url, 'http') ? $stand->cover_url : Storage::url($stand->cover_url) }}"
                                alt="Cover {{ $stand->stand_name }}"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        @else
                            <div class="w-full h-full bg-blue-100"></div>
                        @endif
                        <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors duration-300">
                        </div>
                    </div>

                    <!-- Logo Avatar -->
                    <div class="absolute -bottom-6 left-5 z-20">
                        <div
                            class="w-[60px] h-[60px] rounded-xl border-4 border-white bg-white shadow-sm overflow-hidden group-hover:scale-105 group-hover:shadow-md transition-all duration-300 flex items-center justify-center text-blue-600 font-bold text-xl">
                            @if($stand->logo_url)
                                <img src="{{ str_starts_with($stand->logo_url, 'http') ? $stand->logo_url : Storage::url($stand->logo_url) }}"
                                    alt="{{ $stand->stand_name }}" class="w-full h-full object-cover">
                            @else
                                {{ strtoupper(substr($stand->stand_name, 0, 1)) }}
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Details -->
                <div class="pt-9 pb-5 px-5 flex-1 flex flex-col">
                    <div class="flex justify-between items-start mb-3">
                        <div>
                            <h3
                                class="font-bold text-zinc-900 text-[17px] group-hover:text-[#0A2E65] transition-colors leading-tight line-clamp-1">
                                {{ $stand->stand_name }}
                            </h3>
                            <p class="text-[13px] text-zinc-500 font-medium mt-0.5 line-clamp-1">{{ $stand->city }},
                                {{ $stand->country }}</p>
                        </div>
                        <!-- Rating Badge -->
                        <div
                            class="flex items-center gap-1 bg-amber-50 px-1.5 py-1 rounded-lg border border-amber-100/50 shrink-0">
                            <svg class="w-3.5 h-3.5 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                            <span class="text-xs font-bold text-amber-700">{{ $stand->rating_avg }}</span>
                        </div>
                    </div>

                    <p class="text-[14px] text-zinc-600 mb-6 line-clamp-2 leading-relaxed flex-1">
                        {{ $stand->description ?? 'Découvrez les produits incroyables de ' . $stand->stand_name . '.' }}
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
        @empty
            <div class="w-full text-center py-10 text-zinc-500">
                Aucun stand premium pour le moment.
            </div>
        @endforelse
    </div>
</section>