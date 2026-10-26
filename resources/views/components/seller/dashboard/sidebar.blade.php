<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    class="fixed inset-y-0 left-0 z-50 flex w-72 flex-col border-r border-[#e7e2d8] bg-white transition-transform duration-300 ease-in-out lg:translate-x-0">

    <div class="flex h-16 shrink-0 items-center border-b border-[#eee8de] px-6">
        <a href="{{ route('seller.dashboard') }}" class="flex items-center gap-2.5">
            <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-indigo text-sm font-bold text-shea">K</span>
            <span class="text-lg font-semibold tracking-tight text-indigo-deep">Kelbom<span class="text-kola">.</span></span>
        </a>
    </div>

    <nav class="flex-1 space-y-1 overflow-y-auto px-3 py-5">
        <a href="{{ route('seller.dashboard') }}"
            class="{{ request()->routeIs('seller.dashboard') ? 'bg-indigo text-shea' : 'text-bark hover:bg-[#faf8f4]' }} flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
            Tableau de bord
        </a>
        <a href="{{ route('seller.products.index') }}"
            class="{{ request()->routeIs('seller.products.*') ? 'bg-indigo text-shea' : 'text-bark hover:bg-[#faf8f4]' }} flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            Produits
        </a>
        <a href="{{ route('seller.stand.edit') }}"
            class="{{ request()->routeIs('seller.stand.edit') ? 'bg-indigo text-shea' : 'text-bark hover:bg-[#faf8f4]' }} flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            Modifier le stand
        </a>
        <a href="{{ route('seller.stand.preview') }}"
            class="{{ request()->routeIs('seller.stand.preview') ? 'bg-indigo text-shea' : 'text-bark hover:bg-[#faf8f4]' }} flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
            Voir la vitrine
        </a>
    </nav>

    <div class="border-t border-[#eee8de] p-4">
        <div class="mb-3 flex items-center gap-3 rounded-xl bg-[#faf8f4] px-3 py-2.5">
            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-indigo text-sm font-semibold text-shea">
                {{ mb_substr(Auth::user()->name ?? 'V', 0, 1) }}
            </span>
            <div class="min-w-0">
                <p class="truncate text-sm font-semibold text-bark">{{ Auth::user()->name ?? 'Vendeur' }}</p>
                <p class="truncate text-xs text-harmattan">{{ Auth::user()->stand?->stand_name ?? 'Mon stand' }}</p>
            </div>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-xl px-3 py-2 text-sm font-semibold text-harmattan hover:bg-[#faf8f4] hover:text-bark">
                Déconnexion
            </button>
        </form>
    </div>
</aside>
