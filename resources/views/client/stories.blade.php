<div x-data="{ 
    open: false, 
    activeStoryIndex: 0,
    progress: 0,
    interval: null,
    stands: {{ Js::from($premiumStands ?? []) }},
    
    openStory(index) {
        this.activeStoryIndex = index;
        this.open = true;
        this.startTimer();
    },
    
    closeStory() {
        this.open = false;
        clearInterval(this.interval);
        this.progress = 0;
    },
    
    nextStory() {
        if (this.activeStoryIndex < this.stands.length - 1) {
            this.activeStoryIndex++;
            this.startTimer();
        } else {
            this.closeStory();
        }
    },
    
    prevStory() {
        if (this.activeStoryIndex > 0) {
            this.activeStoryIndex--;
            this.startTimer();
        }
    },
    
    startTimer() {
        clearInterval(this.interval);
        this.progress = 0;
        this.interval = setInterval(() => {
            this.progress += 2; // 50 * 2 = 100% over 5 seconds
            if (this.progress >= 100) {
                this.nextStory();
            }
        }, 100);
    },
    
    getLogoUrl(url) {
        if (!url) return null;
        return url.startsWith('http') ? url : '/storage/' + url;
    },
    
    getCoverUrl(url) {
        if (!url) return null;
        return url.startsWith('http') ? url : '/storage/' + url;
    }
}" class="w-full bg-white border-b border-zinc-100 py-4 shadow-sm relative z-10 md:hidden">

    <!-- Stories Carousel -->
    <div class="max-w-[1400px]  mx-auto px-4 md:px-8">
        <div class="flex gap-4 overflow-x-auto no-scrollbar pb-2 items-center">

            <template x-for="(stand, index) in stands" :key="stand.id">
                <div class="flex flex-col items-center gap-2 shrink-0 cursor-pointer group" @click="openStory(index)">
                    <!-- Avatar Ring -->
                    <div
                        class="w-[72px] h-[72px] rounded-full p-[3px] bg-gradient-to-tr from-[#0A2E65] via-[#5B1FE3] to-[#E35BAD] group-hover:scale-105 transition-transform duration-300">
                        <div
                            class="w-full h-full rounded-full border-[3px] border-white bg-white overflow-hidden flex items-center justify-center font-bold text-xl text-blue-600">
                            <template x-if="stand.logo_url">
                                <img :src="getLogoUrl(stand.logo_url)" :alt="stand.stand_name"
                                    class="w-full h-full object-cover">
                            </template>
                            <template x-if="!stand.logo_url">
                                <span x-text="stand.stand_name.charAt(0).toUpperCase()"></span>
                            </template>
                        </div>
                    </div>
                    <!-- Stand Name -->
                    <span class="text-[11px] font-semibold text-zinc-700 w-[74px] truncate text-center"
                        x-text="stand.stand_name"></span>
                </div>
            </template>

        </div>
    </div>

    <!-- Story Modal -->
    <template x-teleport="body">
        <div x-show="open" x-cloak
            class="fixed inset-0 z-[9999] bg-black/95 flex items-center justify-center backdrop-blur-sm"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">

            <template x-if="stands.length > 0 && stands[activeStoryIndex]">
                <div
                    class="relative w-full max-w-[450px] h-[100dvh] md:h-[85dvh] md:rounded-[32px] overflow-hidden bg-zinc-900 shadow-2xl flex flex-col">

                    <!-- Background Image -->
                    <div class="absolute inset-0 z-0">
                        <template x-if="stands[activeStoryIndex].cover_url">
                            <img :src="getCoverUrl(stands[activeStoryIndex].cover_url)"
                                class="w-full h-full object-cover opacity-80">
                        </template>
                        <template x-if="!stands[activeStoryIndex].cover_url">
                            <div class="w-full h-full bg-gradient-to-b from-blue-900 to-[#0A2E65]"></div>
                        </template>
                        <!-- Gradient overlays for text readability -->
                        <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-transparent to-black/80"></div>
                    </div>

                    <!-- Content Overlay -->
                    <div class="relative z-10 w-full h-full flex flex-col pt-4 pb-6 px-4">

                        <!-- Progress Bars -->
                        <div class="flex gap-1 mb-4">
                            <template x-for="(s, i) in stands" :key="i">
                                <div class="h-1 flex-1 bg-white/30 rounded-full overflow-hidden">
                                    <div class="h-full bg-white rounded-full transition-all duration-100"
                                        :style="i === activeStoryIndex ? `width: ${progress}%` : (i < activeStoryIndex ? 'width: 100%' : 'width: 0%')">
                                    </div>
                                </div>
                            </template>
                        </div>

                        <!-- Header -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-full border border-white/50 bg-white overflow-hidden flex items-center justify-center font-bold text-blue-600">
                                    <template x-if="stands[activeStoryIndex].logo_url">
                                        <img :src="getLogoUrl(stands[activeStoryIndex].logo_url)"
                                            class="w-full h-full object-cover">
                                    </template>
                                    <template x-if="!stands[activeStoryIndex].logo_url">
                                        <span
                                            x-text="stands[activeStoryIndex].stand_name.charAt(0).toUpperCase()"></span>
                                    </template>
                                </div>
                                <div>
                                    <h3 class="text-white font-bold text-[15px] drop-shadow-md"
                                        x-text="stands[activeStoryIndex].stand_name"></h3>
                                    <p class="text-white/80 text-[12px] font-medium drop-shadow-md">Sponsorisé</p>
                                </div>
                            </div>
                            <button @click="closeStory()"
                                class="w-8 h-8 flex items-center justify-center text-white hover:bg-white/20 rounded-full backdrop-blur-md transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>

                        <!-- Invisible Click Areas for Navigation -->
                        <div class="flex-1 flex mt-4">
                            <div class="w-1/3 h-full cursor-pointer" @click="prevStory()"></div>
                            <div class="w-2/3 h-full cursor-pointer" @click="nextStory()"></div>
                        </div>

                        <!-- Bottom Area (WhatsApp Style) -->
                        <div class="mt-auto flex flex-col gap-4">
                            <!-- Description bubble -->
                            <div
                                class="bg-black/40 backdrop-blur-md border border-white/10 rounded-2xl p-4 shadow-lg self-start max-w-[85%]">
                                <p class="text-white text-[15px] leading-relaxed drop-shadow-md font-medium"
                                    x-text="stands[activeStoryIndex].description || 'Découvrez nos meilleurs produits et offres du moment.'">
                                </p>
                            </div>

                            <!-- CTA Button -->
                            <a :href="'/stand/' + stands[activeStoryIndex].slug"
                                class="w-full flex items-center justify-center gap-3 bg-white hover:bg-zinc-100 text-[#0A2E65] font-black py-4 rounded-2xl shadow-xl transition-transform active:scale-95">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                                Voir la Boutique
                            </a>
                        </div>

                    </div>
                </div>
            </template>

            <!-- Desktop Navigation Arrows -->
            <button @click="prevStory()"
                class="hidden md:flex absolute left-8 top-1/2 -translate-y-1/2 w-14 h-14 bg-white/10 hover:bg-white/20 backdrop-blur-lg border border-white/20 rounded-full items-center justify-center text-white transition-colors"
                x-show="activeStoryIndex > 0">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            <button @click="nextStory()"
                class="hidden md:flex absolute right-8 top-1/2 -translate-y-1/2 w-14 h-14 bg-white/10 hover:bg-white/20 backdrop-blur-lg border border-white/20 rounded-full items-center justify-center text-white transition-colors"
                x-show="activeStoryIndex < stands.length - 1">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>

        </div>
    </template>
</div>