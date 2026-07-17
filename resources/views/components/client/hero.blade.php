<section class="max-w-[1400px] mx-auto px-4 md:px-8 py-6">
    <div class="flex flex-col lg:flex-row gap-6 h-auto lg:h-[520px]">

        <!-- Left Side: Hero Banner -->
        <div class="lg:flex-[7] relative rounded-3xl overflow-hidden shadow-sm bg-zinc-100">
            <a href="{{ route("client.marketplace") }}">
                <img src="{{ asset('assets/img/client/hero.png') }}" alt="Hero KELBOM"
                    class="absolute inset-0 w-full h-full object-contain">
            </a>
        </div>

        <!-- Right Side: Mini Carousel -->
        <div class="lg:flex-[3] h-[400px] lg:h-full" x-data="heroCarousel()">
            <div class="bg-white border border-zinc-200 rounded-3xl p-4 h-full flex flex-col shadow-sm">

                <!-- Carousel Container -->
                <div class="relative flex-1 rounded-2xl overflow-hidden mb-5 bg-zinc-900 group"
                    @mouseenter="stopAutoPlay()" @mouseleave="startAutoPlay()">

                    <!-- Slides -->
                    <template x-for="(slide, index) in slides" :key="index">
                        <div x-show="currentSlide === index" x-transition:enter="transition ease-out duration-700"
                            x-transition:enter-start="opacity-0 scale-105"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-500"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            class="absolute inset-0">

                            <img :src="slide.image" :alt="slide.title" class="w-full h-full object-cover opacity-80">

                            <div
                                class="absolute inset-0 bg-gradient-to-t from-[#0A2E65]/95 via-zinc-900/40 to-transparent">
                            </div>

                            <!-- Content inside slide -->
                            <div class="absolute bottom-6 left-6 right-6">
                                <h3 class="text-[26px] font-black text-white mb-4 tracking-tight leading-none"
                                    x-text="slide.title"></h3>

                                <!-- Progress Bars (Pagination) -->
                                <div class="flex items-center gap-1.5">
                                    <template x-for="(s, i) in slides" :key="'dot-'+i">
                                        <button @click="goTo(i)"
                                            class="h-1 rounded-full transition-all duration-300 focus:outline-none"
                                            :class="currentSlide === i ? 'w-8 bg-white' : 'w-2 bg-white/40 hover:bg-white/60'">
                                        </button>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>

                <!-- Footer of the right section -->
                <div class="flex items-center justify-between mt-auto px-2 pb-1">
                    <span class="text-[15px] font-semibold text-zinc-600">Explorez l'excellence</span>
                    <div class="flex items-center gap-2.5">
                        <button @click="prev()"
                            class="w-10 h-10 rounded-full border-2 border-zinc-100 flex items-center justify-center text-zinc-600 hover:text-zinc-950 hover:border-zinc-300 hover:bg-zinc-50 transition-all duration-200 focus:outline-none active:scale-95">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                        <button @click="next()"
                            class="w-10 h-10 rounded-full border-2 border-zinc-100 flex items-center justify-center text-zinc-600 hover:text-zinc-950 hover:border-zinc-300 hover:bg-zinc-50 transition-all duration-200 focus:outline-none active:scale-95">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('heroCarousel', () => ({
            currentSlide: 0,
            timer: null,
            slides: [
                {
                    title: 'Stands Premium',
                    image: '{{ asset('assets/img/client/logo1.jpeg') }}'
                },
                {
                    title: 'Nouvelles Collections',
                    image: '{{ asset('assets/img/client/logo2.jpg') }}'
                },
                {
                    title: 'Meilleures Ventes',
                    image: '{{ asset('assets/img/client/logo3.jpg') }}'
                }
            ],
            init() {
                this.startAutoPlay();
            },
            startAutoPlay() {
                this.stopAutoPlay(); // avoid multiple intervals
                this.timer = setInterval(() => {
                    this.next();
                }, 4000);
            },
            stopAutoPlay() {
                if (this.timer) clearInterval(this.timer);
            },
            next() {
                this.currentSlide = (this.currentSlide + 1) % this.slides.length;
            },
            prev() {
                this.currentSlide = (this.currentSlide - 1 + this.slides.length) % this.slides.length;
            },
            goTo(index) {
                this.currentSlide = index;
            }
        }));
    });
</script>