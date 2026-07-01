@extends('layouts.admin')

@section('content')
<div class="mb-8 flex items-center gap-4">
    <a href="{{ route('admin.stands.index') }}" class="p-2 bg-white border border-slate-200 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-50 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
    </a>
    <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Modifier le stand : {{ $stand->stand_name }}</h1>
</div>

<div class="bg-white rounded-xl border border-slate-200 shadow-sm max-w-3xl">
    <div class="px-6 py-5 border-b border-slate-100">
        <h3 class="text-sm font-bold text-slate-800">Mettre à jour les informations</h3>
    </div>
    
    <div class="p-6">
        <form action="{{ route('admin.stands.update', $stand) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Propriétaire (Non modifiable ici pour la logique de sécurité, ou modifiable si besoin) -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Vendeur propriétaire</label>
                <div class="w-full rounded-lg border border-slate-200 bg-slate-50 text-slate-600 text-sm py-2.5 px-3 cursor-not-allowed">
                    {{ $stand->user->name ?? 'Utilisateur inconnu' }} ({{ $stand->user->email ?? 'N/A' }})
                </div>
                <p class="text-xs text-slate-400 mt-1">Le transfert de propriété n'est pas autorisé depuis cet écran.</p>
            </div>

            <!-- Nom du stand -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Nom du stand <span class="text-red-500">*</span></label>
                <input type="text" name="stand_name" value="{{ old('stand_name', $stand->stand_name) }}" required class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 text-sm py-2.5">
                @error('stand_name') <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Description <span class="text-red-500">*</span></label>
                <textarea name="description" rows="4" required class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 text-sm py-2.5">{{ old('description', $stand->description) }}</textarea>
                @error('description') <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Pays -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Pays <span class="text-red-500">*</span></label>
                    <input type="text" name="country" value="{{ old('country', $stand->country) }}" required class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 text-sm py-2.5">
                    @error('country') <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                </div>
                <!-- Ville -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Ville <span class="text-red-500">*</span></label>
                    <input type="text" name="city" value="{{ old('city', $stand->city) }}" required class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 text-sm py-2.5">
                    @error('city') <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- WhatsApp -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Numéro WhatsApp</label>
                    <input type="text" name="whatsapp_number" value="{{ old('whatsapp_number', $stand->whatsapp_number) }}" class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 text-sm py-2.5">
                    @error('whatsapp_number') <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                </div>
                <!-- Email Contact -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Email de contact</label>
                    <input type="email" name="contact_email" value="{{ old('contact_email', $stand->contact_email) }}" class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 text-sm py-2.5">
                    @error('contact_email') <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Verified Checkbox -->
            <div class="flex items-center pt-2">
                <input type="checkbox" id="is_verified" name="is_verified" value="1" {{ old('is_verified', $stand->is_verified) ? 'checked' : '' }} class="w-4 h-4 text-blue-600 bg-white border-slate-300 rounded focus:ring-blue-500">
                <label for="is_verified" class="ml-2 text-sm font-semibold text-slate-700">Marquer ce stand comme Vérifié (Premium)</label>
            </div>

            <div class="pt-4 flex justify-end gap-3 border-t border-slate-100">
                <a href="{{ route('admin.stands.index') }}" class="px-5 py-2.5 bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 font-semibold rounded-lg text-sm transition-colors">Annuler</a>
                <button type="submit" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg text-sm shadow-sm transition-colors">Enregistrer les modifications</button>
            </div>
        </form>
    </div>
</div>
@endsection
