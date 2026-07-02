<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelbom - Publier une Demande</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; -webkit-font-smoothing: antialiased; }
    </style>
</head>
<body class="bg-zinc-50 text-zinc-900 flex flex-col min-h-screen">

    <x-client.top-header />
    <x-client.header />

    <main class="flex-grow">
        <!-- Hero Section -->
        <section class="relative bg-[#0A2E65] py-16 md:py-24 overflow-hidden border-b border-zinc-200">
            <div class="absolute inset-0 w-full h-full">
                <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32d7?q=80&w=1920&auto=format&fit=crop" alt="Background" class="w-full h-full object-cover opacity-10">
                <div class="absolute inset-0 bg-gradient-to-t from-[#050B14] to-transparent opacity-90"></div>
            </div>
            
            <div class="relative z-10 max-w-4xl mx-auto px-4 md:px-8 text-center">
                <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-amber-400/10 text-amber-400 border border-amber-400/20 text-[13px] font-bold uppercase tracking-widest rounded-full mb-6">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    Service Gratuit
                </span>
                <h1 class="text-4xl md:text-5xl font-black text-white mb-6 tracking-tight">
                    Publiez votre demande d'achat
                </h1>
                <p class="text-[16px] md:text-lg text-blue-100/90 font-medium leading-relaxed max-w-2xl mx-auto">
                    Vous ne trouvez pas ce que vous cherchez ? Décrivez votre besoin et laissez nos meilleurs vendeurs vous proposer leurs offres directement.
                </p>
            </div>
        </section>

        <!-- Form Section -->
        <section class="max-w-[1000px] mx-auto px-4 md:px-8 py-12 -mt-10 relative z-20">
            @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-6 py-4 rounded-2xl mb-8 flex items-center gap-4 shadow-sm">
                    <svg class="w-6 h-6 text-emerald-500 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p class="font-medium text-sm md:text-base">{{ session('success') }}</p>
                </div>
            @endif

            <div class="bg-white rounded-3xl shadow-xl shadow-blue-900/5 border border-zinc-200 p-6 md:p-10">
                <form action="{{ route('client.request.store') }}" method="POST" enctype="multipart/form-data" class="space-y-12">
                    @csrf
                    
                    <!-- Section 1: Le Besoin -->
                    <div>
                        <div class="flex items-center gap-3 mb-6">
                            <span class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 text-blue-600 font-bold text-sm">1</span>
                            <h3 class="text-xl font-bold text-zinc-900">Que recherchez-vous ?</h3>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Catégorie -->
                            <div class="md:col-span-2">
                                <label class="block text-[14px] font-semibold text-zinc-700 mb-2">Catégorie du produit <span class="text-red-500">*</span></label>
                                <select name="category_id" required class="w-full rounded-xl border-zinc-300 focus:border-blue-500 focus:ring-blue-500 bg-zinc-50 py-3 px-4 transition-colors">
                                    <option value="">Sélectionnez une catégorie</option>
                                    @foreach($categories as $parent)
                                        <optgroup label="{{ $parent->name }}">
                                            @foreach($parent->children as $child)
                                                <option value="{{ $child->id }}">{{ $child->name }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                            
                            <!-- Description -->
                            <div class="md:col-span-2">
                                <label class="block text-[14px] font-semibold text-zinc-700 mb-2">Description détaillée <span class="text-red-500">*</span></label>
                                <textarea name="description" rows="4" required placeholder="Décrivez précisément votre besoin (matière, taille, spécificités...)" class="w-full rounded-xl border-zinc-300 focus:border-blue-500 focus:ring-blue-500 bg-zinc-50 py-3 px-4 transition-colors"></textarea>
                            </div>

                            <!-- Quantité -->
                            <div>
                                <label class="block text-[14px] font-semibold text-zinc-700 mb-2">Quantité requise <span class="text-red-500">*</span></label>
                                <input type="number" name="quantity" min="1" required placeholder="Ex: 50" class="w-full rounded-xl border-zinc-300 focus:border-blue-500 focus:ring-blue-500 bg-zinc-50 py-3 px-4 transition-colors">
                            </div>

                            <!-- Budget -->
                            <div>
                                <label class="block text-[14px] font-semibold text-zinc-700 mb-2">Budget estimé</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-zinc-500 font-medium">XAF</span>
                                    <input type="number" name="budget" placeholder="Ex: 150000" class="w-full rounded-xl border-zinc-300 focus:border-blue-500 focus:ring-blue-500 bg-zinc-50 py-3 pl-14 pr-4 transition-colors">
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="border-zinc-100">

                    <!-- Section 2: Détails Supplémentaires -->
                    <div>
                        <div class="flex items-center gap-3 mb-6">
                            <span class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 text-blue-600 font-bold text-sm">2</span>
                            <h3 class="text-xl font-bold text-zinc-900">Détails & Médias</h3>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Image de référence -->
                            <div>
                                <label class="block text-[14px] font-semibold text-zinc-700 mb-2">Image de référence <span class="text-zinc-400 font-normal">(Optionnel)</span></label>
                                <input type="file" name="reference_image" accept="image/*" class="w-full rounded-xl border border-zinc-300 bg-zinc-50 py-2.5 px-3 text-sm text-zinc-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-colors">
                            </div>

                            <!-- Urgence -->
                            <div>
                                <label class="block text-[14px] font-semibold text-zinc-700 mb-2">Niveau d'urgence <span class="text-red-500">*</span></label>
                                <select name="urgency" required class="w-full rounded-xl border-zinc-300 focus:border-blue-500 focus:ring-blue-500 bg-zinc-50 py-3 px-4 transition-colors">
                                    <option value="low">Faible (D\'ici un mois)</option>
                                    <option value="medium" selected>Moyenne (D\'ici 2 semaines)</option>
                                    <option value="high">Urgent (Le plus vite possible)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <hr class="border-zinc-100">

                    <!-- Section 3: Vos Coordonnées -->
                    <div>
                        <div class="flex items-center gap-3 mb-6">
                            <span class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 text-blue-600 font-bold text-sm">3</span>
                            <h3 class="text-xl font-bold text-zinc-900">Vos Coordonnées</h3>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nom -->
                            <div class="md:col-span-2">
                                <label class="block text-[14px] font-semibold text-zinc-700 mb-2">Votre nom complet <span class="text-red-500">*</span></label>
                                <input type="text" name="name" required placeholder="Ex: Jean Dupont" class="w-full rounded-xl border-zinc-300 focus:border-blue-500 focus:ring-blue-500 bg-zinc-50 py-3 px-4 transition-colors">
                            </div>

                            <!-- Pays -->
                            <div>
                                <label class="block text-[14px] font-semibold text-zinc-700 mb-2">Pays <span class="text-red-500">*</span></label>
                                <input type="text" name="country" required placeholder="Ex: Cameroun" class="w-full rounded-xl border-zinc-300 focus:border-blue-500 focus:ring-blue-500 bg-zinc-50 py-3 px-4 transition-colors">
                            </div>

                            <!-- Ville -->
                            <div>
                                <label class="block text-[14px] font-semibold text-zinc-700 mb-2">Ville <span class="text-red-500">*</span></label>
                                <input type="text" name="city" required placeholder="Ex: Douala" class="w-full rounded-xl border-zinc-300 focus:border-blue-500 focus:ring-blue-500 bg-zinc-50 py-3 px-4 transition-colors">
                            </div>

                            <!-- Contact -->
                            <div class="md:col-span-2">
                                <label class="block text-[14px] font-semibold text-zinc-700 mb-2">Contact (WhatsApp ou Email) <span class="text-red-500">*</span></label>
                                <input type="text" name="contact" required placeholder="Numéro WhatsApp (avec indicatif) ou Email valide" class="w-full rounded-xl border-zinc-300 focus:border-blue-500 focus:ring-blue-500 bg-zinc-50 py-3 px-4 transition-colors">
                            </div>
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="pt-4">
                        <button type="submit" class="w-full md:w-auto px-10 py-4 bg-[#0A2E65] hover:bg-blue-800 text-white font-bold rounded-xl shadow-lg shadow-blue-900/20 transition-all duration-300 hover:-translate-y-1 flex items-center justify-center gap-2">
                            Soumettre la demande
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                        <p class="text-[13px] text-zinc-500 mt-4 text-center md:text-left">
                            En soumettant cette demande, vous acceptez nos <a href="#" class="text-blue-600 underline">conditions d'utilisation</a>.
                        </p>
                    </div>
                    
                </form>
            </div>
        </section>

    </main>

    <x-client.footer />

</body>
</html>
