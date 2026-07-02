@extends('layouts.admin')

@section('content')
<div class="flex items-center justify-between mb-8">
    <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Catalogue de Produits</h1>
    <span class="bg-slate-100 text-slate-600 px-3 py-1.5 rounded-lg text-sm font-semibold border border-slate-200 shadow-sm">
        Total : {{ $products->total() }}
    </span>
</div>

@if(session('success'))
    <div class="bg-emerald-50 text-emerald-600 border border-emerald-200 p-4 rounded-lg mb-6 text-sm font-medium">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
    @if($products->isEmpty())
        <!-- Empty State -->
        <div class="flex flex-col items-center justify-center p-12 text-center">
            <svg class="w-16 h-16 text-slate-200 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            <h3 class="text-lg font-bold text-slate-800 mb-1">Aucun produit</h3>
            <p class="text-sm text-slate-500 mb-6">Il n'y a actuellement aucun produit enregistré par les vendeurs.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Produit</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Vendeur & Stand</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Prix (XAF)</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Statut</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($products as $product)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-lg bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-400 shrink-0 overflow-hidden">
                                        @if($product->main_image_url)
                                            <img src="{{ Storage::url($product->main_image_url) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                        @else
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        @endif
                                    </div>
                                    <div class="max-w-[200px]">
                                        <p class="text-sm font-bold text-slate-900 truncate" title="{{ $product->name }}">{{ $product->name }}</p>
                                        <p class="text-[12px] text-slate-500 truncate" title="{{ $product->category?->name }}">{{ $product->category?->name ?? 'Général' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-bold text-blue-600 block">{{ $product->stand?->stand_name ?? 'Inconnu' }}</span>
                                <span class="text-[12px] text-slate-500">{{ $product->stand?->user?->name ?? 'N/A' }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-black text-slate-800">{{ number_format($product->price, 0, ',', ' ') }}</span>
                            </td>
                            <td class="px-6 py-4">
                                @if($product->status === 'active')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-bold bg-emerald-100 text-emerald-700 uppercase tracking-wider">
                                        Actif
                                    </span>
                                @elseif($product->status === 'inactive')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-bold bg-red-100 text-red-700 uppercase tracking-wider">
                                        Inactif
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-bold bg-amber-100 text-amber-700 uppercase tracking-wider">
                                        Brouillon
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    
                                    <!-- Toggle Status Button -->
                                    <form action="{{ route('admin.products.toggle-status', $product) }}" method="POST" class="inline-block" onsubmit="return confirm('Voulez-vous vraiment changer le statut de ce produit ?');">
                                        @csrf
                                        @method('PATCH')
                                        @if($product->status === 'active')
                                            <button type="submit" class="px-3 py-1.5 text-[11px] font-bold bg-red-50 text-red-600 border border-red-100 hover:bg-red-100 rounded-md transition-colors uppercase tracking-wider" title="Désactiver">
                                                Désactiver
                                            </button>
                                        @else
                                            <button type="submit" class="px-3 py-1.5 text-[11px] font-bold bg-emerald-50 text-emerald-600 border border-emerald-100 hover:bg-emerald-100 rounded-md transition-colors uppercase tracking-wider" title="Activer">
                                                Activer
                                            </button>
                                        @endif
                                    </form>

                                    <!-- Delete Button -->
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline-block ml-1" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer définitivement ce produit ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded transition-colors" title="Supprimer">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        @if($products->hasPages())
            <div class="px-6 py-4 border-t border-slate-200">
                {{ $products->links() }}
            </div>
        @endif
    @endif
</div>
@endsection
