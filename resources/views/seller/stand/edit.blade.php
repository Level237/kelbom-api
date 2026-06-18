<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personnaliser mon Stand | Kelbom</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
        
        .premium-shadow {
            box-shadow: 0 24px 60px -15px rgba(0, 0, 0, 0.03), 0 4px 12px -4px rgba(0, 0, 0, 0.01);
        }
        
        .inner-refraction {
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 8px 32px -4px rgba(0, 0, 0, 0.05);
        }

        .input-transition {
            transition: all 250ms cubic-bezier(0.16, 1, 0.3, 1);
        }
    </style>
</head>
<body class="bg-[#f8f9fa] text-zinc-900 font-sans antialiased" x-data="{ sidebarOpen: false }">
    
    <x-seller.dashboard.sidebar />

    <div class="lg:pl-72 flex flex-col min-h-[100dvh]">
        <x-seller.dashboard.header />

        <main class="flex-1 p-6 md:p-10 w-full max-w-[1400px] mx-auto animate-in fade-in duration-500">
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

                <!-- Asymmetric Premium Header Panel -->
                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 mb-12 border-b border-zinc-200/60 pb-8">
                    <div class="max-w-2xl">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="px-2.5 py-1 bg-zinc-900 text-white text-[10px] font-mono tracking-widest uppercase rounded-md font-semibold">Studio</span>
                            <span class="text-zinc-400 text-xs font-medium">/ Configuration Vitrine</span>
                        </div>
                        <h1 class="text-3xl md:text-4xl font-semibold tracking-tighter text-zinc-950 mb-3">Personnaliser votre identité.</h1>
                        <p class="text-sm md:text-base text-zinc-500 leading-relaxed max-w-[60ch]">Votre stand est votre signature numérique. Structurez votre image de marque pour inspirer confiance et attirer de nouveaux acheteurs.</p>
                    </div>
                    <div class="flex items-center gap-3 w-full sm:w-auto self-stretch lg:self-auto">
                        <a href="{{ route('seller.stand.preview') }}" class="flex-1 sm:flex-none px-5 py-3 bg-white border border-zinc-200/80 text-zinc-700 font-medium rounded-xl text-xs uppercase tracking-wider hover:bg-zinc-50 hover:border-zinc-300 input-transition premium-shadow active:scale-[0.98] text-center">
                            Aperçu live
                        </a>
                        <button type="submit" class="flex-1 sm:flex-none px-6 py-3 bg-[#0A2E65] hover:bg-zinc-900 text-white font-medium rounded-xl text-xs uppercase tracking-wider input-transition shadow-[0_10px_20px_-5px_rgba(10,46,101,0.2)] hover:shadow-none active:scale-[0.98]">
                            Enregistrer les modifications
                        </button>
                    </div>
                </div>

                @if (session('success'))
                    <div class="mb-8 p-4 bg-zinc-900 text-white rounded-xl text-xs tracking-wide font-medium shadow-xl flex items-center justify-between animate-in fade-in slide-in-from-top-4 duration-300">
                        <div class="flex items-center gap-3">
                            <div class="w-5 h-5 bg-emerald-500 rounded-full flex items-center justify-center text-zinc-900 shrink-0">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <span>{{ session('success') }}</span>
                        </div>
                    </div>
                @endif

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    
                    <!-- Left Core Section: Design & Branding -->
                    <div class="lg:col-span-8 space-y-8">
                        
                        <!-- Visual Canvas Card -->
                        <div class="bg-white rounded-3xl border border-zinc-200/60 p-6 md:p-8 premium-shadow overflow-hidden relative">
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-1.5 h-5 bg-[#0A2E65] rounded-full"></div>
                                    <h2 class="text-sm font-semibold uppercase tracking-wider text-zinc-800">Identité Visuelle & Médias</h2>
                                </div>
                                <span class="text-[10px] font-mono text-zinc-400 bg-zinc-50 px-2 py-0.5 rounded border border-zinc-100">Ratio 21:9</span>
                            </div>

                            <!-- Interactive Banner Upload Slot -->
                            <div class="relative mb-14 group/cover cursor-pointer">
                                <div class="w-full aspect-[21/9] rounded-2xl overflow-hidden bg-zinc-50 border border-zinc-200/80 relative shadow-[inset_0_2px_4px_rgba(0,0,0,0.01)] transition-colors duration-300 group-hover/cover:border-zinc-300">
                                    <template x-if="coverPreview">
                                        <img :src="coverPreview" class="w-full h-full object-cover">
                                    </template>
                                    <template x-if="!coverPreview">
                                        <div class="w-full h-full flex flex-col items-center justify-center gap-2">
                                            <svg class="w-6 h-6 text-zinc-300 group-hover/cover:text-zinc-400 transition-colors" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"></path></svg>
                                            <span class="text-[11px] font-medium text-zinc-400">Aucune bannière configurée</span>
                                        </div>
                                    </template>
                                    <!-- Sleek Refraction Hover Overlay -->
                                    <div class="absolute inset-0 bg-zinc-950/20 opacity-0 group-hover/cover:opacity-100 input-transition flex items-center justify-center">
                                        <span class="px-4 py-2 bg-white text-zinc-900 font-medium rounded-lg text-xs tracking-wide shadow-xl uppercase border border-zinc-200">Remplacer la bannière</span>
                                    </div>
                                </div>
                                <input type="file" name="cover" @change="handleCover" class="absolute inset-0 opacity-0 cursor-pointer" accept="image/*">

                                <!-- Overlapping Grid Logo Slot -->
                                <div class="absolute -bottom-8 left-8 group/logo cursor-pointer z-10">
                                    <div class="w-24 h-24 rounded-2xl bg-white p-1 shadow-[0_16px_32px_-8px_rgba(0,0,0,0.08)] border border-zinc-200/60 relative">
                                        <div class="w-full h-full rounded-[1.1rem] bg-zinc-50 border border-zinc-100 overflow-hidden relative flex items-center justify-center">
                                            <template x-if="logoPreview">
                                                <img :src="logoPreview" class="w-full h-full object-cover">
                                            </template>
                                            <template x-if="!logoPreview">
                                                <svg class="w-5 h-5 text-zinc-300 group-hover/logo:text-zinc-400 transition-colors" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7 0 3.75 3.75 0 017 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"></path></svg>
                                            </template>
                                            <div class="absolute inset-0 bg-zinc-950/40 opacity-0 group-hover/logo:opacity-100 input-transition flex items-center justify-center">
                                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316A2.192 2.192 0 0014.512 3.75h-5.023c-.53 0-1.025.241-1.354.653l-.82 1.316z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z"></path></svg>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="file" name="logo" @change="handleLogo" class="absolute inset-0 opacity-0 cursor-pointer" accept="image/*">
                                </div>
                            </div>

                            <!-- Text Content Input Matrix -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-1">
                                    <label class="text-[10px] font-semibold text-zinc-400 uppercase tracking-widest block mb-1">Nom du Stand</label>
                                    <input type="text" name="stand_name" value="{{ old('stand_name', $stand->stand_name) }}" class="w-full px-4 py-3 bg-white border border-zinc-200/80 rounded-xl text-zinc-900 font-medium text-sm hover:border-zinc-300 focus:border-zinc-900 focus:ring-4 focus:ring-zinc-900/4 outline-none input-transition shadow-[0_1px_2px_rgba(0,0,0,0.01)]" placeholder="Ex: Maison d'Élégance">
                                </div>
                                <div class="space-y-1">
                                    <label class="text-[10px] font-semibold text-zinc-400 uppercase tracking-widest block mb-1">Slogan ou accroche</label>
                                    <input type="text" name="short_desc_placeholder" value="{{ old('description', $stand->description) }}" class="w-full px-4 py-3 bg-white border border-zinc-200/80 rounded-xl text-zinc-900 font-medium text-sm hover:border-zinc-300 focus:border-zinc-900 focus:ring-4 focus:ring-zinc-900/4 outline-none input-transition shadow-[0_1px_2px_rgba(0,0,0,0.01)]" placeholder="Votre promesse client en une phrase">
                                </div>
                            </div>
                        </div>

                        <!-- Narrative Profile Card -->
                        <div class="bg-white rounded-3xl border border-zinc-200/60 p-6 md:p-8 premium-shadow">
                             <div class="flex items-center gap-3 mb-6">
                                <div class="w-1.5 h-5 bg-zinc-900 rounded-full"></div>
                                <h2 class="text-sm font-semibold uppercase tracking-wider text-zinc-800">Histoire & Profil de l'entreprise</h2>
                            </div>
                            <textarea name="description" rows="6" class="w-full px-4 py-3.5 bg-white border border-zinc-200/80 rounded-2xl text-zinc-900 text-sm font-normal leading-relaxed hover:border-zinc-300 focus:border-zinc-900 focus:ring-4 focus:ring-zinc-900/4 outline-none input-transition resize-none shadow-[0_1px_2px_rgba(0,0,0,0.01)]" placeholder="Présentez votre entreprise, vos techniques artisanales, vos engagements et ce qui forge l'authenticité de vos produits...">{{ old('description', $stand->description) }}</textarea>
                            <div class="flex items-center gap-2 mt-3 text-zinc-400">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008h-.008v-.008z"></path></svg>
                                <p class="text-[11px] font-medium tracking-wide">Une biographie soignée augmente votre taux de conversion et votre référencement organique.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Right Sidebar Section: Metadata, Location & Presence -->
                    <div class="lg:col-span-4 space-y-8">
                        
                        <!-- Premium Minimalist Contact Card -->
                        <div class="bg-zinc-950 text-white rounded-3xl p-6 md:p-8 inner-refraction relative overflow-hidden">
                            <div class="absolute -right-16 -top-16 w-36 h-36 bg-zinc-800/20 rounded-full blur-2xl pointer-events-none"></div>
                            
                            <div class="flex items-center gap-2.5 mb-6 border-b border-zinc-800 pb-4">
                                <svg class="w-4 h-4 text-zinc-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.824-1.454-5.166-3.792-6.618-6.617l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"></path></svg>
                                <h2 class="text-xs font-semibold uppercase tracking-wider text-zinc-300">Canaux de Communication</h2>
                            </div>
                            
                            <div class="space-y-5">
                                <div class="space-y-1.5">
                                    <label class="text-[9px] uppercase tracking-widest font-bold text-zinc-500 block">Téléphone Fixe / Portable</label>
                                    <input type="text" name="contact_phone" value="{{ old('contact_phone', $stand->contact_phone) }}" class="w-full px-3.5 py-2.5 bg-zinc-900 border border-zinc-800 rounded-xl text-white font-mono text-xs tracking-wide focus:border-zinc-700 focus:bg-zinc-900 outline-none input-transition">
                                </div>
                                <div class="space-y-1.5">
                                    <label class="text-[9px] uppercase tracking-widest font-bold text-zinc-500 block">Ligne WhatsApp Business</label>
                                    <div class="relative">
                                        <input type="text" name="whatsapp_number" value="{{ old('whatsapp_number', $stand->whatsapp_number) }}" class="w-full pl-3.5 pr-8 py-2.5 bg-zinc-900 border border-zinc-800 rounded-xl text-white font-mono text-xs tracking-wide focus:border-zinc-700 focus:bg-zinc-900 outline-none input-transition">
                                        <div class="absolute right-3 top-1/2 -translate-y-1/2 w-2 h-2 bg-emerald-500 rounded-full shadow-[0_0_8px_rgba(16,185,129,0.6)]"></div>
                                    </div>
                                </div>
                                <div class="space-y-1.5">
                                    <label class="text-[9px] uppercase tracking-widest font-bold text-zinc-500 block">Courriel Commercial</label>
                                    <input type="email" name="contact_email" value="{{ old('contact_email', $stand->contact_email) }}" class="w-full px-3.5 py-2.5 bg-zinc-900 border border-zinc-800 rounded-xl text-zinc-300 text-xs font-normal focus:border-zinc-700 focus:bg-zinc-900 outline-none input-transition">
                                </div>
                            </div>
                        </div>

                        <!-- Geometric Localization Card -->
                        <div class="bg-white rounded-3xl border border-zinc-200/60 p-6 md:p-8 premium-shadow">
                            <div class="flex items-center gap-2.5 mb-6 border-b border-zinc-100 pb-4">
                                <svg class="w-4 h-4 text-zinc-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25s-7.5-4.108-7.5-11.25a7.5 7.5 0 1115 0z"></path></svg>
                                <h2 class="text-xs font-semibold uppercase tracking-wider text-zinc-800">Localisation Administrative</h2>
                            </div>
                            <div class="space-y-4">
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="space-y-1">
                                        <label class="text-[10px] font-semibold text-zinc-400 uppercase tracking-widest block">Ville</label>
                                        <input type="text" name="city" value="{{ old('city', $stand->city) }}" class="w-full px-3.5 py-2.5 bg-white border border-zinc-200/80 rounded-xl text-zinc-900 font-medium text-xs hover:border-zinc-300 focus:border-zinc-900 focus:ring-4 focus:ring-zinc-900/4 outline-none input-transition shadow-[0_1px_2px_rgba(0,0,0,0.01)]">
                                    </div>
                                    <div class="space-y-1">
                                        <label class="text-[10px] font-semibold text-zinc-400 uppercase tracking-widest block">Pays</label>
                                        <input type="text" name="country" value="{{ old('country', $stand->country) }}" class="w-full px-3.5 py-2.5 bg-white border border-zinc-200/80 rounded-xl text-zinc-900 font-medium text-xs hover:border-zinc-300 focus:border-zinc-900 focus:ring-4 focus:ring-zinc-900/4 outline-none input-transition shadow-[0_1px_2px_rgba(0,0,0,0.01)]">
                                    </div>
                                </div>
                                <div class="space-y-1">
                                    <label class="text-[10px] font-semibold text-zinc-400 uppercase tracking-widest block">Adresse physique précise</label>
                                    <input type="text" name="address" value="{{ old('address', $stand->address) }}" class="w-full px-3.5 py-2.5 bg-white border border-zinc-200/80 rounded-xl text-zinc-900 font-normal text-xs hover:border-zinc-300 focus:border-zinc-900 focus:ring-4 focus:ring-zinc-900/4 outline-none input-transition shadow-[0_1px_2px_rgba(0,0,0,0.01)]" placeholder="Rue, Quartier, Repères...">
                                </div>
                            </div>
                        </div>

                        <!-- Digital Ecosystem Node Card -->
                        <div class="bg-white rounded-3xl border border-zinc-200/60 p-6 md:p-8 premium-shadow">
                            <div class="flex items-center gap-2.5 mb-5">
                                <svg class="w-4 h-4 text-zinc-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9s2.015-9 4.5-9m0 18c-1.11 0-2.08-.402-2.799-1.066M11.25 3.75H12m0 0l.45.9a1.5 1.5 0 001.213.804l1.042.062a1.35 1.35 0 01.762 2.272l-.782.685a1.5 1.5 0 00-.493 1.488l.245 1.053a1.35 1.35 0 01-2.011 1.439l-.933-.538a1.5 1.5 0 00-1.484 0l-.933.538a1.35 1.35 0 01-2.011-1.439l.245-1.053a1.5 1.5 0 00-.493-1.488l-.782-.685a1.35 1.35 0 01.762-2.272l1.042-.062a1.5 1.5 0 001.213-.804l.45-.9z"></path></svg>
                                <h2 class="text-xs font-semibold uppercase tracking-wider text-zinc-800">Écosystème Digital</h2>
                            </div>
                            <div class="space-y-1.5">
                                <label class="text-[10px] font-semibold text-zinc-400 uppercase tracking-widest block">Site internet externe</label>
                                <div class="relative flex items-center">
                                    <span class="absolute left-3.5 text-zinc-400 font-mono text-xs select-none">https://</span>
                                    <input type="text" name="website_url" value="{{ old('website_url', str_replace(['http://', 'https://'], '', $stand->website_url)) }}" class="w-full pl-16 pr-4 py-2.5 bg-white border border-zinc-200/80 rounded-xl text-zinc-900 font-medium text-xs hover:border-zinc-300 focus:border-zinc-900 focus:ring-4 focus:ring-zinc-900/4 outline-none input-transition shadow-[0_1px_2px_rgba(0,0,0,0.01)]" placeholder="votre-marque.com">
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
