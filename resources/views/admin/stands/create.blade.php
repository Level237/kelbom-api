@extends('layouts.admin')

@section('content')
<div class="mb-8 flex items-center gap-4">
    <a href="{{ route('admin.stands.index') }}" class="p-2 bg-white border border-slate-200 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-50 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
    </a>
    <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Créer un stand</h1>
</div>

@if($users->isEmpty())
    <div class="bg-amber-50 text-amber-700 border border-amber-200 p-6 rounded-xl mb-6 flex items-start gap-4">
        <svg class="w-6 h-6 shrink-0 mt-0.5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
        <div>
            <h3 class="text-sm font-bold mb-1">Aucun vendeur disponible</h3>
            <p class="text-sm">Tous les utilisateurs ayant le rôle "vendeur" possèdent déjà un stand. Vous devez d'abord <a href="{{ route('admin.users.create') }}" class="underline font-bold hover:text-amber-800">créer un nouvel utilisateur vendeur</a> avant de pouvoir lui attribuer un stand.</p>
        </div>
    </div>
@else
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm max-w-3xl">
        <div class="px-6 py-5 border-b border-slate-100">
            <h3 class="text-sm font-bold text-slate-800">Informations du stand</h3>
        </div>
        
        <div class="p-6">
            <form action="{{ route('admin.stands.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Vendeur (User ID) -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Vendeur propriétaire <span class="text-red-500">*</span></label>
                    <select name="user_id" required class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 text-sm py-2.5 bg-white">
                        <option value="" disabled selected>Sélectionnez un vendeur</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('user_id') <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                </div>

                <!-- Nom du stand -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Nom du stand <span class="text-red-500">*</span></label>
                    <input type="text" name="stand_name" value="{{ old('stand_name') }}" required placeholder="Ex: Ma Super Boutique" class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 text-sm py-2.5">
                    @error('stand_name') <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Description <span class="text-red-500">*</span></label>
                    <textarea name="description" rows="4" required placeholder="Description détaillée du stand..." class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 text-sm py-2.5">{{ old('description') }}</textarea>
                    @error('description') <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Pays -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Pays <span class="text-red-500">*</span></label>
                        <input type="text" name="country" value="{{ old('country', 'Togo') }}" required class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 text-sm py-2.5">
                        @error('country') <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                    </div>
                    <!-- Ville -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Ville <span class="text-red-500">*</span></label>
                        <input type="text" name="city" value="{{ old('city') }}" required placeholder="Ex: Lomé" class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 text-sm py-2.5">
                        @error('city') <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- WhatsApp -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Numéro WhatsApp</label>
                        <input type="text" name="whatsapp_number" value="{{ old('whatsapp_number') }}" placeholder="Ex: +228 90 00 00 00" class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 text-sm py-2.5">
                        @error('whatsapp_number') <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                    </div>
                    <!-- Email Contact -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Email de contact</label>
                        <input type="email" name="contact_email" value="{{ old('contact_email') }}" placeholder="contact@stand.com" class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 text-sm py-2.5">
                        @error('contact_email') <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Verified Checkbox -->
                <div class="flex items-center pt-2">
                    <input type="checkbox" id="is_verified" name="is_verified" value="1" {{ old('is_verified') ? 'checked' : '' }} class="w-4 h-4 text-blue-600 bg-white border-slate-300 rounded focus:ring-blue-500">
                    <label for="is_verified" class="ml-2 text-sm font-semibold text-slate-700">Marquer ce stand comme Vérifié (Premium)</label>
                </div>

                <div class="pt-4 flex justify-end gap-3 border-t border-slate-100">
                    <a href="{{ route('admin.stands.index') }}" class="px-5 py-2.5 bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 font-semibold rounded-lg text-sm transition-colors">Annuler</a>
                    <button type="submit" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg text-sm shadow-sm transition-colors">Créer le stand</button>
                </div>
            </form>
        </div>
    </div>
@endif
@endsection
