@extends('layouts.admin')

@section('content')
<div class="mb-8 flex items-center gap-4">
    <a href="{{ route('admin.users.index') }}" class="p-2 bg-white border border-slate-200 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-50 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
    </a>
    <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Ajouter un utilisateur</h1>
</div>

<div class="bg-white rounded-xl border border-slate-200 shadow-sm max-w-2xl">
    <div class="px-6 py-5 border-b border-slate-100">
        <h3 class="text-sm font-bold text-slate-800">Informations de l'utilisateur</h3>
    </div>
    
    <div class="p-6">
        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Nom -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Nom complet</label>
                <input type="text" name="name" value="{{ old('name') }}" required placeholder="Ex: John Doe" class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 text-sm py-2.5">
                @error('name') <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Adresse Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required placeholder="john@example.com" class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 text-sm py-2.5">
                @error('email') <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
            </div>

            <!-- Mot de passe -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Mot de passe</label>
                <input type="password" name="password" required placeholder="Minimum 6 caractères" class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 text-sm py-2.5">
                @error('password') <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
            </div>

            <!-- Role -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Rôle</label>
                <select name="role" required class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 text-sm py-2.5 bg-white">
                    <option value="" disabled selected>Sélectionnez un rôle</option>
                    @foreach($roles as $role)
                        <option value="{{ $role }}" {{ old('role') == $role ? 'selected' : '' }}>
                            {{ ucfirst($role) }} {{ $role === 'admin' ? '(Administrateur)' : '(Vendeur)' }}
                        </option>
                    @endforeach
                </select>
                @error('role') <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
            </div>

            <div class="pt-4 flex justify-end gap-3">
                <a href="{{ route('admin.users.index') }}" class="px-5 py-2.5 bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 font-semibold rounded-lg text-sm transition-colors">Annuler</a>
                <button type="submit" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg text-sm shadow-sm transition-colors">Enregistrer l'utilisateur</button>
            </div>
        </form>
    </div>
</div>
@endsection
