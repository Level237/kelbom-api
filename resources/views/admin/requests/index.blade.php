@extends('layouts.admin')

@section('content')
<div class="flex items-center justify-between mb-8">
    <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Demandes Clients (Requests)</h1>
    <span class="bg-blue-50 text-blue-700 px-3 py-1.5 rounded-lg text-sm font-semibold border border-blue-200 shadow-sm">
        Total : {{ $requests->total() }}
    </span>
</div>

@if(session('success'))
    <div class="bg-emerald-50 text-emerald-600 border border-emerald-200 p-4 rounded-lg mb-6 text-sm font-medium">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
    @if($requests->isEmpty())
        <!-- Empty State -->
        <div class="flex flex-col items-center justify-center p-12 text-center">
            <svg class="w-16 h-16 text-slate-200 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
            <h3 class="text-lg font-bold text-slate-800 mb-1">Aucune demande</h3>
            <p class="text-sm text-slate-500 mb-6">Il n'y a actuellement aucune demande soumise par les clients.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Client & Contact</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Demande</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Urgence</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Budget / Qté</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($requests as $req)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-bold text-slate-900">{{ $req->name }}</div>
                                <div class="text-[12px] text-slate-500 flex items-center gap-1 mt-0.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    {{ $req->city }}, {{ $req->country }}
                                </div>
                                <div class="text-[12px] font-medium text-blue-600 mt-1">{{ $req->contact }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-bold text-slate-800">{{ $req->category?->name ?? 'Général' }}</div>
                                <div class="text-xs text-slate-500 line-clamp-2 mt-1" title="{{ $req->description }}">
                                    {{ $req->description }}
                                </div>
                                @if($req->reference_image)
                                    <a href="{{ Storage::url($req->reference_image) }}" target="_blank" class="inline-flex items-center gap-1 mt-2 text-[11px] font-bold text-blue-600 hover:underline">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        Voir l'image jointe
                                    </a>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($req->urgency === 'high')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-bold bg-red-100 text-red-700 uppercase tracking-wider">
                                        Urgent
                                    </span>
                                @elseif($req->urgency === 'medium')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-bold bg-amber-100 text-amber-700 uppercase tracking-wider">
                                        Moyenne
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-bold bg-slate-100 text-slate-700 uppercase tracking-wider">
                                        Faible
                                    </span>
                                @endif
                                <div class="text-[11px] text-slate-400 mt-2">{{ $req->created_at->diffForHumans() }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-black text-slate-800">{{ $req->budget ? number_format($req->budget, 0, ',', ' ') . ' XAF' : 'Non défini' }}</div>
                                <div class="text-xs text-slate-500 mt-0.5">Quantité: {{ $req->quantity }}</div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <form action="{{ route('admin.requests.destroy', $req) }}" method="POST" class="inline-block" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette demande ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Supprimer">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        @if($requests->hasPages())
            <div class="px-6 py-4 border-t border-slate-200">
                {{ $requests->links() }}
            </div>
        @endif
    @endif
</div>
@endsection
