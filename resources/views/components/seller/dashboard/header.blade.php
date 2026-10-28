<header class="sticky top-0 z-40 flex h-16 items-center justify-between border-b border-[#e7e2d8] bg-[#f4f1ea]/90 px-4 backdrop-blur-md sm:px-6 lg:px-8">
    <div class="flex min-w-0 flex-1 items-center gap-3">
        <button type="button" @click="sidebarOpen = true" aria-label="{{ __('seller.dashboard.open_menu') }}"
            class="rounded-xl p-2 text-bark hover:bg-white lg:hidden">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
        <p class="truncate text-sm font-semibold text-indigo-deep">
            {{ Auth::user()->stand?->stand_name ?? __('seller.dashboard.space') }}
        </p>
    </div>

    <div class="flex items-center gap-2">
        <x-locale-switch />
        @unless(request()->routeIs('seller.products.create'))
            <a href="{{ route('seller.products.create') }}"
                class="inline-flex h-10 items-center gap-2 rounded-xl bg-indigo px-3.5 text-sm font-semibold text-shea hover:bg-indigo-deep">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                </svg>
                <span class="hidden sm:inline">{{ __('seller.dashboard.create_product') }}</span>
            </a>
        @endunless
        <span class="flex h-9 w-9 items-center justify-center rounded-full bg-indigo text-sm font-semibold text-shea">
            {{ mb_substr(Auth::user()->name ?? 'V', 0, 1) }}
        </span>
    </div>
</header>
