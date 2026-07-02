@extends('layouts.admin')

@section('content')
<div class="flex items-center justify-between mb-8">
    <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Messages de Contact</h1>
    <span class="bg-emerald-50 text-emerald-700 px-3 py-1.5 rounded-lg text-sm font-semibold border border-emerald-200 shadow-sm">
        Total : {{ $contacts->total() }}
    </span>
</div>

@if(session('success'))
    <div class="bg-emerald-50 text-emerald-600 border border-emerald-200 p-4 rounded-lg mb-6 text-sm font-medium">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
    @if($contacts->isEmpty())
        <!-- Empty State -->
        <div class="flex flex-col items-center justify-center p-12 text-center">
            <svg class="w-16 h-16 text-slate-200 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            <h3 class="text-lg font-bold text-slate-800 mb-1">Aucun message</h3>
            <p class="text-sm text-slate-500 mb-6">Vous n'avez reçu aucun message via le formulaire de contact.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Auteur</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Objet & Message</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($contacts as $msg)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-bold text-slate-900">{{ $msg->name }}</div>
                                <a href="mailto:{{ $msg->email }}" class="text-[12px] font-medium text-blue-600 hover:underline mt-0.5 inline-block">{{ $msg->email }}</a>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-bold text-slate-800">{{ $msg->subject }}</div>
                                <div class="text-xs text-slate-500 line-clamp-2 mt-1" title="{{ $msg->message }}">
                                    {{ $msg->message }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-[12px] text-slate-600 font-medium">{{ $msg->created_at->format('d/m/Y H:i') }}</div>
                                <div class="text-[11px] text-slate-400 mt-0.5">{{ $msg->created_at->diffForHumans() }}</div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <form action="{{ route('admin.contacts.destroy', $msg) }}" method="POST" class="inline-block" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce message ?');">
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
        
        @if($contacts->hasPages())
            <div class="px-6 py-4 border-t border-slate-200">
                {{ $contacts->links() }}
            </div>
        @endif
    @endif
</div>
@endsection
