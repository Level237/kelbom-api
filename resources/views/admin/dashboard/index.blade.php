@extends('layouts.admin')

@section('content')
<!-- Page Header -->
<div class="flex items-center justify-between mb-8">
    <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Vue d'ensemble</h1>
    <div class="flex items-center gap-3">
        <button class="flex items-center gap-2 bg-white border border-slate-200 hover:bg-slate-50 px-3 py-2 rounded-lg text-[13px] text-slate-700 shadow-sm font-semibold transition-colors">
            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
            Filtrer
        </button>
        <button class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 px-3 py-2 rounded-lg text-[13px] text-white shadow-sm font-semibold transition-colors">
            <svg class="w-4 h-4 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
            Exporter
        </button>
    </div>
</div>

<!-- Key Metrics Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Card Visiteurs -->
    <div class="bg-white rounded-xl border border-slate-200 p-5 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center gap-2 text-slate-500 font-semibold text-[13px]">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                Visiteurs Uniques
            </div>
        </div>
        <div class="flex items-end gap-3">
            <h2 class="text-3xl font-black text-slate-800 tracking-tight">{{ number_format($visitorCount, 0, ',', ' ') }}</h2>
            <span class="flex items-center text-[12px] font-bold text-emerald-600 bg-emerald-50 px-1.5 py-0.5 rounded mb-1">
                +15.8% <svg class="w-3 h-3 ml-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
            </span>
        </div>
    </div>

    <!-- Card Stands -->
    <div class="bg-white rounded-xl border border-slate-200 p-5 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center gap-2 text-slate-500 font-semibold text-[13px]">
                <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                Stands Actifs
            </div>
        </div>
        <div class="flex items-end gap-3">
            <h2 class="text-3xl font-black text-slate-800 tracking-tight">{{ number_format($standsCount, 0, ',', ' ') }}</h2>
        </div>
    </div>

    <!-- Card Produits -->
    <div class="bg-white rounded-xl border border-slate-200 p-5 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center gap-2 text-slate-500 font-semibold text-[13px]">
                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                Produits Ajoutés
            </div>
        </div>
        <div class="flex items-end gap-3">
            <h2 class="text-3xl font-black text-slate-800 tracking-tight">{{ number_format($productsCount, 0, ',', ' ') }}</h2>
        </div>
    </div>
</div>

<!-- Last Items Section -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- 8 Derniers Stands -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden flex flex-col">
        <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
            <h3 class="text-[15px] font-bold text-slate-800">Derniers Stands inscrits</h3>
            <a href="{{ route('admin.stands.index') }}" class="text-[13px] font-bold text-blue-600 hover:text-blue-700">Voir tout</a>
        </div>
        
        <div class="flex-1">
            @if($latestStands->isEmpty())
                <div class="flex flex-col items-center justify-center h-full p-8 text-center">
                    <svg class="w-12 h-12 text-slate-200 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    <p class="text-sm font-medium text-slate-500">Aucun Stand</p>
                    <p class="text-[12px] text-slate-400 mt-1">Il n'y a pas encore de stand enregistré.</p>
                </div>
            @else
                <ul class="divide-y divide-slate-100">
                    @foreach($latestStands as $stand)
                        <a href="{{ route('admin.stands.show', $stand) }}" class="px-5 py-3 flex items-center gap-4 hover:bg-slate-50/80 transition-colors block">
                            <div class="flex items-center w-full">
                                <div class="w-10 h-10 rounded-lg bg-blue-50 border border-blue-100 flex items-center justify-center shrink-0 overflow-hidden text-blue-600 font-bold mr-4">
                                    @if($stand->logo)
                                        <img src="{{ Storage::url($stand->logo) }}" alt="{{ $stand->stand_name }}" class="w-full h-full object-cover">
                                    @else
                                        {{ strtoupper(substr($stand->stand_name, 0, 1)) }}
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-[14px] font-bold text-slate-900 truncate">{{ $stand->stand_name }}</p>
                                    <p class="text-[12px] text-slate-500 truncate">{{ $stand->created_at->diffForHumans() }}</p>
                                </div>
                                <div>
                                    <span class="inline-flex items-center px-2 py-1 rounded bg-emerald-100 text-emerald-700 text-[10px] font-bold uppercase tracking-wider">
                                        Actif
                                    </span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    <!-- 8 Derniers Produits -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden flex flex-col">
        <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
            <h3 class="text-[15px] font-bold text-slate-800">Derniers Produits ajoutés</h3>
            <a href="{{ route("admin.products.index") }}" class="text-[13px] font-bold text-blue-600 hover:text-blue-700">Voir tout</a>
        </div>
        
        <div class="flex-1">
            @if($latestProducts->isEmpty())
                <div class="flex flex-col items-center justify-center h-full p-8 text-center">
                    <svg class="w-12 h-12 text-slate-200 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    <p class="text-sm font-medium text-slate-500">Aucun Produit</p>
                    <p class="text-[12px] text-slate-400 mt-1">Aucun produit n'a été publié pour le moment.</p>
                </div>
            @else
                <ul class="divide-y divide-slate-100">
                    @foreach($latestProducts as $product)
                        <li class="px-5 py-3 flex items-center gap-4 hover:bg-slate-50/80 transition-colors">
                            <div class="w-10 h-10 rounded-lg bg-slate-100 border border-slate-200 flex items-center justify-center shrink-0 overflow-hidden text-slate-400">
                                @if($product->main_image_url)
                                    <img src="{{ Storage::url($product->main_image_url) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                @else
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-[14px] font-bold text-slate-900 truncate">{{ $product->name }}</p>
                                <p class="text-[12px] font-medium text-blue-600 truncate">Par {{ $product->stand->stand_name ?? 'Stand Inconnu' }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-[13px] font-bold text-slate-800">{{ number_format($product->price, 0, ',', ' ') }} XAF</p>
                                <p class="text-[11px] text-slate-500">{{ $product->created_at->diffForHumans() }}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
@endsection
