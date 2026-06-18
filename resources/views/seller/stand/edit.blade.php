<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personnaliser mon Stand | Kelbom</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
        .liquid-glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body class="bg-[#f9fafb] text-zinc-900 font-sans antialiased" x-data="{ sidebarOpen: false }">
    
    <x-seller.dashboard.sidebar />

    <div class="lg:pl-72 flex flex-col min-h-[100dvh]">
        <x-seller.dashboard.header />

        <main class="flex-1 p-6 md:p-10 w-full max-w-[1400px] mx-auto">
            <form action="{{ route('seller.stand.update') }}" method="POST" enctype="multipart/form-data" 
                x-data="{ 
                    logoPreview: '{{ $stand->logo_url }}',
                    coverPreview: '{{ $stand->cover_url }}',
                    handleLogo(e) {
                        const file = e.target.files[0];
                        if (file) this.logoPreview = URL.createObjectURL(file);
                    },
                    handleCover(e) {
                        const file = e.target.files[0];
                        if (file) this.coverPreview = URL.createObjectURL(file);
                    }
                }">
                @csrf
                @method('PUT')

                <!-- Header Section: Asymmetric -->
                <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6 mb-12">
                    <div class="max-w-2xl">
                        <h1 class="text-4xl md:text-5xl font-extrabold tracking-tighter leading-none mb-4">Personnaliser votre identité.</h1>
                        <p class="text-lg text-zinc-500 font-medium leading-relaxed">Votre stand est votre vitrine. Soignez votre présentation pour attirer plus de clients et renforcer votre crédibilité.</p>
                    </div>
                    <div class="flex items-center gap-4 w-full md:w-auto">
                        <a href="{{ route('seller.stand.preview') }}" class="flex-1 md:flex-none px-6 py-3 bg-white border border-zinc-200 text-zinc-700 font-bold rounded-2xl text-sm hover:bg-zinc-50 transition-all shadow-sm active:scale-[0.98] text-center">
                            Aperçu live
                        </a>
                        <button type="submit" class="flex-1 md:flex-none px-8 py-3 bg-[#0A2E65] hover:bg-zinc-900 text-white font-bold rounded-2xl text-sm transition-all shadow-lg active:scale-[0.98]">
                            Enregistrer les modifications
                        </button>
                    </div>
                </div>

                @if (session('success'))
                    <div class="mb-8 p-5 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-[2rem] font-bold text-sm shadow-sm flex items-center gap-3 animate-in fade-in slide-in-from-top-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        {{ session('success') }}
                    </div>
                @endif

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    
                    <!-- Left: Branding & Visuals (Bento Style) -->
                    <div class="lg:col-span-8 space-y-8">
                        
                        <!-- Visual Identity Card -->
                        <div class="bg-white rounded-[2.5rem] border border-slate-200/50 p-8 md:p-10 shadow-[0_20px_40px_-15px_rgba(0,0,0,0.05)] overflow-hidden relative">
                            <h2 class="text-xl font-bold text-zinc-900 mb-8 flex items-center gap-3">
                                <span class="w-2 h-8 bg-indigo-600 rounded-full"></span>
                                Identité visuelle
                            </h2>

                            <!-- Cover Upload -->
                            <div class="relative mb-12 group cursor-pointer">
                                <div class="w-full aspect-[21/9] rounded-3xl overflow-hidden bg-zinc-100 border border-zinc-200 relative shadow-inner">
                                    <template x-if="coverPreview">
                                        <img :src="coverPreview" class="w-full h-full object-cover">
                                    </template>
                                    <template x-if="!coverPreview">
                                        <div class="w-full h-full flex items-center justify-center">
                                            <svg class="w-12 h-12 text-zinc-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                    </template>
                                    <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                        <span class="px-5 py-2.5 bg-white/90 backdrop-blur text-zinc-900 font-bold rounded-xl text-xs shadow-xl">Changer la bannière</span>
                                    </div>
                                </div>
                                <input type="file" name="cover" @change="handleCover" class="absolute inset-0 opacity-0 cursor-pointer" accept="image/*">

                                <!-- Logo Overlay -->
                                <div class="absolute -bottom-6 left-10 group/logo cursor-pointer">
                                    <div class="w-24 h-24 rounded-[2rem] bg-white p-1.5 shadow-2xl border border-white relative">
                                        <div class="w-full h-full rounded-[1.7rem] bg-zinc-50 border border-zinc-100 overflow-hidden relative">
                                            <template x-if="logoPreview">
                                                <img :src="logoPreview" class="w-full h-full object-cover">
                                            </template>
                                            <template x-if="!logoPreview">
                                                <div class="w-full h-full flex items-center justify-center">
                                                    <svg class="w-8 h-8 text-zinc-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                                </div>
                                            </template>
                                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover/logo:opacity-100 transition-opacity flex items-center justify-center">
                                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path></svg>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="file" name="logo" @change="handleLogo" class="absolute inset-0 opacity-0 cursor-pointer" accept="image/*">
                                </div>
                            </div>

                            <div class="pt-10 grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-2">
                                    <label class="text-sm font-bold text-zinc-700 ml-1">Nom du Stand</label>
                                    <input type="text" name="stand_name" value="{{ old('stand_name', $stand->stand_name) }}" class="w-full px-5 py-4 bg-zinc-50 border border-zinc-200 rounded-2xl text-zinc-900 font-bold focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all outline-none" placeholder="Ex: Boutique Elegance">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-sm font-bold text-zinc-700 ml-1">Slogan ou Courte Description</label>
                                    <input type="text" name="short_desc_placeholder" value="{{ old('description', $stand->description) }}" class="w-full px-5 py-4 bg-zinc-50 border border-zinc-200 rounded-2xl text-zinc-900 font-medium focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all outline-none" placeholder="Votre promesse client en une phrase">
                                </div>
                            </div>
                        </div>

                        <!-- Full Description Card -->
                        <div class="bg-white rounded-[2.5rem] border border-slate-200/50 p-8 md:p-10 shadow-[0_20px_40px_-15px_rgba(0,0,0,0.05)]">
                             <h2 class="text-xl font-bold text-zinc-900 mb-8 flex items-center gap-3">
                                <span class="w-2 h-8 bg-amber-500 rounded-full"></span>
                                À propos de nous
                            </h2>
                            <textarea name="description" rows="8" class="w-full px-6 py-5 bg-zinc-50 border border-zinc-200 rounded-3xl text-zinc-900 font-medium leading-relaxed focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all outline-none resize-none" placeholder="Racontez votre histoire, vos valeurs et ce qui vous rend unique...">{{ old('description', $stand->description) }}</textarea>
                            <p class="text-[11px] text-zinc-400 mt-4 font-medium italic">Une description riche améliore votre référencement sur la plateforme.</p>
                        </div>
                    </div>

                    <!-- Right: Info & Contact (Sidebar Style) -->
                    <div class="lg:col-span-4 space-y-8">
                        
                        <!-- Contact Info Card -->
                        <div class="bg-[#0A2E65] text-white rounded-[2.5rem] p-8 shadow-xl relative overflow-hidden group">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16 blur-3xl group-hover:bg-white/20 transition-colors"></div>
                            
                            <h2 class="text-xl font-bold mb-8 relative z-10">Coordonnées</h2>
                            
                            <div class="space-y-6 relative z-10">
                                <div class="space-y-2">
                                    <label class="text-[10px] uppercase tracking-widest font-extrabold text-white/50 ml-1">Téléphone Commercial</label>
                                    <input type="text" name="contact_phone" value="{{ old('contact_phone', $stand->contact_phone) }}" class="w-full px-4 py-3 bg-white/10 border border-white/10 rounded-xl text-white font-mono font-bold placeholder-white/30 focus:bg-white/20 outline-none transition-all">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[10px] uppercase tracking-widest font-extrabold text-white/50 ml-1">WhatsApp</label>
                                    <input type="text" name="whatsapp_number" value="{{ old('whatsapp_number', $stand->whatsapp_number) }}" class="w-full px-4 py-3 bg-white/10 border border-white/10 rounded-xl text-white font-mono font-bold placeholder-white/30 focus:bg-white/20 outline-none transition-all">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[10px] uppercase tracking-widest font-extrabold text-white/50 ml-1">Email de contact</label>
                                    <input type="email" name="contact_email" value="{{ old('contact_email', $stand->contact_email) }}" class="w-full px-4 py-3 bg-white/10 border border-white/10 rounded-xl text-white font-medium placeholder-white/30 focus:bg-white/20 outline-none transition-all">
                                </div>
                            </div>
                        </div>

                        <!-- Location Card -->
                        <div class="bg-white rounded-[2.5rem] border border-slate-200/50 p-8 shadow-[0_20px_40px_-15px_rgba(0,0,0,0.05)]">
                            <h2 class="text-xl font-bold text-zinc-900 mb-8 flex items-center gap-3">
                                <span class="w-2 h-8 bg-emerald-500 rounded-full"></span>
                                Localisation
                            </h2>
                            <div class="space-y-5">
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="space-y-2">
                                        <label class="text-xs font-bold text-zinc-500 ml-1">Ville</label>
                                        <input type="text" name="city" value="{{ old('city', $stand->city) }}" class="w-full px-4 py-3 bg-zinc-50 border border-zinc-200 rounded-xl text-zinc-900 font-bold focus:border-indigo-500 outline-none transition-all">
                                    </div>
                                    <div class="space-y-2">
                                        <label class="text-xs font-bold text-zinc-500 ml-1">Pays</label>
                                        <input type="text" name="country" value="{{ old('country', $stand->country) }}" class="w-full px-4 py-3 bg-zinc-50 border border-zinc-200 rounded-xl text-zinc-900 font-bold focus:border-indigo-500 outline-none transition-all">
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <label class="text-xs font-bold text-zinc-500 ml-1">Adresse précise</label>
                                    <input type="text" name="address" value="{{ old('address', $stand->address) }}" class="w-full px-4 py-3 bg-zinc-50 border border-zinc-200 rounded-xl text-zinc-900 font-medium focus:border-indigo-500 outline-none transition-all" placeholder="Rue, Quartier, Repères...">
                                </div>
                            </div>
                        </div>

                        <!-- Web Presence Card -->
                        <div class="bg-zinc-900 text-white rounded-[2.5rem] p-8 shadow-xl">
                            <h2 class="text-xl font-bold mb-6">Présence Web</h2>
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-zinc-500 ml-1">Site Web (Optionnel)</label>
                                <div class="relative">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-zinc-600 font-bold text-sm">https://</span>
                                    <input type="text" name="website_url" value="{{ old('website_url', str_replace(['http://', 'https://'], '', $stand->website_url)) }}" class="w-full pl-20 pr-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white font-medium focus:bg-white/10 outline-none transition-all" placeholder="votre-site.com">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </main>
    </div>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
