@extends('layouts.admin')

@section('content')
<div class="mb-8 flex items-center gap-4">
    <a href="{{ route('admin.categories.index') }}" class="p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-lg transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
    </a>
    <div>
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Nouvelle Catégorie</h1>
        <p class="text-sm text-slate-500 mt-1">Créez une nouvelle catégorie pour organiser le catalogue.</p>
    </div>
</div>

<div class="max-w-3xl">
    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-xl border border-slate-200 shadow-sm p-6 md:p-8 space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">Nom de la catégorie <span class="text-red-500">*</span></label>
            <input type="text" name="name" value="{{ old('name') }}" required class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 @error('name') border-red-500 @enderror">
            @error('name') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
        </div>

        <!-- Parent Category -->
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">Catégorie Parente (Optionnel)</label>
            <select name="parent_id" class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 @error('parent_id') border-red-500 @enderror">
                <option value="">-- Aucune (Catégorie Principale) --</option>
                @foreach($parentCategories as $parent)
                    <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
                        {{ $parent->name }}
                    </option>
                @endforeach
            </select>
            @error('parent_id') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
        </div>

        <!-- Description -->
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">Description</label>
            <textarea name="description" rows="3" class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
            @error('description') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Order -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Ordre d'affichage</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500">
                <p class="mt-1 text-[11px] text-slate-500">Un nombre plus petit apparaîtra en premier.</p>
            </div>

            <!-- Icon -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Nom de l'icône (Optionnel)</label>
                <input type="text" name="icon" value="{{ old('icon') }}" placeholder="ex: tag, home, star..." class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500">
            </div>
        </div>

        <!-- Image -->
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">Image d'illustration</label>
            <input type="file" name="image" accept="image/*" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            @error('image') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
        </div>

        <!-- Is Active -->
        <div class="pt-4 border-t border-slate-100">
            <label class="flex items-center gap-3 cursor-pointer">
                <input type="checkbox" name="is_active" value="1" class="w-5 h-5 rounded border-slate-300 text-blue-600 focus:ring-blue-500" {{ old('is_active', true) ? 'checked' : '' }}>
                <span class="text-sm font-semibold text-slate-700">Activer la catégorie</span>
            </label>
        </div>

        <div class="pt-6 border-t border-slate-100 flex justify-end gap-3">
            <a href="{{ route('admin.categories.index') }}" class="px-5 py-2.5 text-sm font-semibold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-lg transition-colors">Annuler</a>
            <button type="submit" class="px-5 py-2.5 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm transition-colors">
                Enregistrer la catégorie
            </button>
        </div>

    </form>
</div>
@endsection
