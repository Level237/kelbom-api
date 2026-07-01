@extends('layouts.admin')

@section('content')

    @if(session('success'))
        <div class="bg-emerald-50 text-emerald-600 border border-emerald-200 p-4 rounded-lg mb-6 text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    <!-- Cinematic Header / Cover -->
    <div class="relative -mt-6 -mx-6 bg-zinc-900 border-b border-zinc-200 mb-8">
        <div class="h-48 md:h-64 w-full relative overflow-hidden">
            @if($stand->cover_url)
                <img src="{{ Storage::url($stand->cover_url) }}" class="w-full h-full object-cover opacity-90">
            @else
                <div class="w-full h-full bg-gradient-to-br from-slate-800 to-slate-900 flex items-center justify-center">
                    <svg class="w-12 h-12 text-slate-700/60" fill="none" stroke="currentColor" stroke-width="1.5"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z">
                        </path>
                    </svg>
                </div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-zinc-950 via-zinc-900/40 to-transparent"></div>
        </div>

        <div class="max-w-6xl mx-auto px-6 relative -mt-16 pb-6">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">

                <div class="flex flex-col sm:flex-row items-start sm:items-end gap-5">
                    <!-- Logo Block -->
                    <div
                        class="w-24 h-24 md:w-32 md:h-32 rounded-2xl bg-white p-1.5 shadow-xl border border-slate-200/50 shrink-0 relative z-10 flex items-center justify-center">
                        <div
                            class="w-full h-full rounded-xl bg-slate-50 border border-slate-100 overflow-hidden flex items-center justify-center text-slate-400 text-3xl font-black">
                            @if($stand->logo_url)
                                <img src="{{ Storage::url($stand->logo_url) }}" class="w-full h-full object-cover">
                            @else
                                {{ substr($stand->stand_name, 0, 1) }}
                            @endif
                        </div>
                    </div>

                    <!-- Info Block -->
                    <div class="mb-1 text-white relative z-10">
                        <div class="flex items-center gap-3 mb-2">
                            <h1 class="text-2xl md:text-3xl font-bold tracking-tight">{{ $stand->stand_name }}</h1>
                            @if($stand->is_verified)
                                <span
                                    class="bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"></path>
                                    </svg>
                                    Actif (Vérifié)
                                </span>
                            @else
                                <span
                                    class="bg-amber-500/20 text-amber-300 border border-amber-500/30 px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider">
                                    Désactivé
                                </span>
                            @endif
                        </div>
                        <div class="flex flex-wrap items-center gap-4 text-xs text-zinc-300 font-medium">
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25s-7.5-4.108-7.5-11.25a7.5 7.5 0 1115 0z">
                                    </path>
                                </svg>
                                {{ $stand->city }}, {{ $stand->country }}
                            </span>
                            <span class="w-1 h-1 bg-zinc-600 rounded-full"></span>
                            <span class="flex items-center gap-1 text-amber-400">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <span class="font-bold text-white">{{ $stand->rating_avg ?? '5.0' }}</span>
                                <span class="text-zinc-400">({{ $stand->total_reviews ?? '0' }})</span>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Actions Buttons -->
                <div class="flex items-center gap-3 relative z-10 md:mb-2 w-full sm:w-auto">
                    <form action="{{ route('admin.stands.toggle-status', $stand) }}" method="POST"
                        class="flex-1 sm:flex-none">
                        @csrf
                        @method('PATCH')
                        @if($stand->is_verified)
                            <button type="submit"
                                class="w-full px-5 py-2.5 bg-red-500 hover:bg-red-600 text-white text-sm font-bold rounded-xl shadow-sm transition-colors active:scale-95"
                                onclick="return confirm('Voulez-vous vraiment désactiver ce stand ? Le vendeur ne pourra plus vendre.');">
                                Désactiver le Stand
                            </button>
                        @else
                            <button type="submit"
                                class="w-full px-5 py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white text-sm font-bold rounded-xl shadow-[0_0_15px_rgba(16,185,129,0.4)] transition-all active:scale-95">
                                Activer le Stand
                            </button>
                        @endif
                    </form>
                    <a href="{{ route('admin.stands.edit', $stand) }}"
                        class="flex-1 sm:flex-none text-center px-5 py-2.5 bg-zinc-800 hover:bg-zinc-700 text-white border border-zinc-700 text-sm font-bold rounded-xl shadow-sm transition-colors active:scale-95">
                        Éditer
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

        <!-- Left: Products Catalog -->
        <div class="lg:col-span-8">
            <div class="flex items-center justify-between border-b border-slate-200 pb-4 mb-6">
                <h2 class="text-sm font-bold uppercase tracking-wider text-slate-800">Catalogue des produits</h2>
                <span
                    class="text-xs font-mono font-medium text-slate-500 bg-slate-100 border border-slate-200 px-2.5 py-1 rounded-md">
                    {{ $stand->products->count() }} articles
                </span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                @forelse($stand->products as $product)
                    <div
                        class="bg-white border border-slate-200 rounded-xl overflow-hidden hover:shadow-lg transition-shadow group">
                        <div class="aspect-square bg-slate-50 relative overflow-hidden border-b border-slate-100">
                            @if($product->main_image_url || $product->image)
                                <img src="{{ Storage::url($product->image ?? $product->main_image_url) }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-300">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-4 space-y-1">
                            <h3 class="text-sm font-bold text-slate-900 truncate" title="{{ $product->name }}">
                                {{ $product->name }}
                            </h3>
                            <p class="text-[11px] text-slate-500 font-medium">{{ $product->category?->name ?? 'Non classé' }}
                            </p>
                            <p class="text-[13px] font-black text-blue-600 pt-1">
                                {{ number_format($product->price, 0, ',', ' ') }} XAF
                            </p>
                        </div>
                    </div>
                @empty
                    <div
                        class="col-span-full py-16 flex flex-col items-center justify-center text-center bg-white rounded-xl border border-dashed border-slate-300">
                        <svg class="w-8 h-8 text-slate-300 mb-3" fill="none" stroke="currentColor" stroke-width="1.5"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 5.197m0 0A7.5 7.5 0 105.196 12m5.004-6.804A7.5 7.5 0 0012 21.75a7.5 7.5 0 006.804-10.5M12 7.5V12l3 3">
                            </path>
                        </svg>
                        <p class="text-sm font-medium text-slate-500">Aucun produit pour le moment.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Right: Informations & Vendeur -->
        <div class="lg:col-span-4 space-y-6">

            <!-- Description -->
            <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-sm">
                <h2 class="text-[11px] font-bold uppercase tracking-widest text-slate-400 mb-3">À propos du stand</h2>
                <p class="text-sm text-slate-700 leading-relaxed">
                    {{ $stand->description ?? 'Aucune description fournie.' }}
                </p>
            </div>

            <!-- Contact & Location -->
            <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-sm space-y-4">
                <h2 class="text-[11px] font-bold uppercase tracking-widest text-slate-400 mb-2">Informations & Contact</h2>

                <div class="flex items-start gap-3 text-sm">
                    <svg class="w-5 h-5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25s-7.5-4.108-7.5-11.25a7.5 7.5 0 1115 0z"></path>
                    </svg>
                    <div>
                        <p class="font-semibold text-slate-800">{{ $stand->city }}, {{ $stand->country }}</p>
                        <p class="text-slate-500 text-xs">{{ $stand->address ?? 'Adresse non spécifiée' }}</p>
                    </div>
                </div>

                @if($stand->whatsapp_number)
                    <div class="flex items-center gap-3 text-sm pt-2">
                        <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z">
                            </path>
                        </svg>
                        <span class="font-medium text-slate-700">{{ $stand->whatsapp_number }}</span>
                    </div>
                @endif

                @if($stand->contact_email)
                    <div class="flex items-center gap-3 text-sm pt-2 border-t border-slate-100">
                        <svg class="w-5 h-5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75">
                            </path>
                        </svg>
                        <a href="mailto:{{ $stand->contact_email }}"
                            class="font-medium text-blue-600 hover:underline">{{ $stand->contact_email }}</a>
                    </div>
                @endif
            </div>

            <!-- Utilisateur (Propriétaire) -->
            <div class="bg-blue-50 border border-blue-100 rounded-xl p-5 shadow-sm">
                <h2 class="text-[11px] font-bold uppercase tracking-widest text-blue-500 mb-4">Responsable du compte
                    (Vendeur)</h2>
                <div class="flex items-center gap-4">
                    <div
                        class="w-12 h-12 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-lg shrink-0 shadow-sm">
                        {{ substr($stand->user->name ?? 'V', 0, 1) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-bold text-slate-900 truncate">
                            {{ $stand->user->name ?? 'Utilisateur inconnu' }}
                        </p>
                        <p class="text-xs text-slate-600 truncate mb-1">{{ $stand->user->email ?? 'N/A' }}</p>
                        @if(isset($stand->user->phone_number))
                            <p class="text-[11px] font-mono text-slate-500">Tél: {{ $stand->user->phone_number }}</p>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection