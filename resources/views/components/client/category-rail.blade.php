@props(['categories' => null, 'stands' => null])

<style>[x-cloak]{display:none !important}</style>

@php
    $parents = collect($categories ?? ($parentCategories ?? []))->values();
    $standCards = collect($stands ?? ($homeStands ?? []))->values();
    $categoryUrls = $parents->mapWithKeys(fn ($category) => [
        $category->id => route('client.category.show', $category->slug),
    ]);
@endphp

<section class="mx-auto max-w-[1400px] px-4 py-4 md:px-8"
    x-data="{
        selected: 'all',
        stands: @js($standCards),
        marketplaceUrl: @js(route('client.marketplace')),
        categoryUrls: @js($categoryUrls),
        get filtered() {
            if (this.selected === 'all') {
                return this.stands
            }
            const id = Number(this.selected)
            return this.stands.filter((stand) => stand.category_ids.includes(id))
        },
        get preview() {
            return this.filtered.slice(0, 4)
        },
        get moreUrl() {
            if (this.selected === 'all') {
                return this.marketplaceUrl
            }
            return this.categoryUrls[this.selected] || this.categoryUrls[Number(this.selected)] || this.marketplaceUrl
        },
        scrollRail(direction) {
            this.$refs.rail.scrollBy({ left: direction * 240, behavior: 'smooth' })
        }
    }">
    <div class="flex items-center gap-3">
        

        <div class="relative min-w-0 flex-1">
            <div x-ref="rail" class="flex gap-2.5 overflow-x-auto px-1 py-2 md:px-11 [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
                <button type="button" @click="selected = 'all'"
            :class="selected === 'all' ? 'border-kola bg-kola text-white' : 'border-zinc-200 bg-white text-bark hover:border-kola'"
            class="inline-flex h-11 shrink-0 items-center rounded-full border px-5 text-sm font-semibold whitespace-nowrap">
            Tout
        </button>
                @foreach ($parents as $category)
                    <button type="button" @click="selected = '{{ $category->id }}'"
                        :class="selected === '{{ $category->id }}' ? 'border-kola bg-kola text-white' : 'border-zinc-200 bg-white text-bark hover:border-kola'"
                        class="inline-flex h-11 shrink-0 items-center rounded-full border px-5 text-sm font-semibold whitespace-nowrap">
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>

            <button type="button" @click="scrollRail(-1)"
                class="absolute top-1/2 left-0 z-10 hidden h-9 w-9 -translate-y-1/2 items-center justify-center rounded-full border border-zinc-200 bg-white text-bark shadow-sm hover:border-kola md:inline-flex"
                aria-label="Catégories précédentes">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </button>
            <button type="button" @click="scrollRail(1)"
                class="absolute top-1/2 right-0 z-10 hidden h-9 w-9 -translate-y-1/2 items-center justify-center rounded-full border border-zinc-200 bg-white text-bark shadow-sm hover:border-kola md:inline-flex"
                aria-label="Catégories suivantes">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </button>
        </div>
    </div>

    <div class="mt-4 flex min-h-[460px] flex-col rounded-[28px] border border-[#e2e4e8] bg-[#faf8f4] p-4 sm:p-5">
        <div x-show="preview.length > 0" class="grid flex-1 grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <template x-for="stand in preview" :key="stand.slug">
                <a :href="stand.url" class="flex h-[380px] flex-col overflow-hidden rounded-2xl border border-[#ece7df] bg-white shadow-sm hover:border-kola">
                    <div class="flex h-40 shrink-0 items-center justify-center overflow-hidden bg-[#e8eaed]">
                        <template x-if="stand.logo">
                            <img :src="stand.logo" alt="" class="h-full w-full object-cover">
                        </template>
                        <template x-if="!stand.logo">
                            <span class="text-2xl font-semibold text-indigo" x-text="stand.initial"></span>
                        </template>
                    </div>
                    <span class="flex min-h-0 flex-1 flex-col px-4 pt-4 pb-4">
                        <span class="truncate text-[15px] font-semibold text-bark" x-text="stand.name"></span>
                        <span class="mt-1 truncate text-xs text-harmattan">
                            <span x-text="stand.city"></span>
                            <template x-if="stand.country">
                                <span> · <span x-text="stand.country"></span></span>
                            </template>
                        </span>
                        <span class="mt-2 line-clamp-2 text-[13px] leading-relaxed text-harmattan" x-text="stand.description"></span>
                        <span class="mt-auto flex items-center justify-between pt-3 text-xs font-semibold">
                            <span class="text-kola-deep">★ <span x-text="stand.rating"></span></span>
                            <span class="text-indigo">Voir le stand</span>
                        </span>
                    </span>
                </a>
            </template>
        </div>

        <div x-show="preview.length === 0" x-cloak class="flex flex-1 items-center justify-center rounded-2xl border border-dashed border-zinc-300 bg-white px-6 text-center">
            <p class="text-sm text-harmattan">Aucun stand dans cette catégorie pour le moment.</p>
        </div>

        <div class="mt-4 flex justify-center">
            <a :href="moreUrl" class="inline-flex h-11 items-center rounded-full bg-kola px-5 text-sm font-semibold text-white hover:bg-kola-deep">
                Voir plus
            </a>
        </div>
    </div>
</section>
