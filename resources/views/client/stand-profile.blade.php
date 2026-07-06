<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $stand ? $stand->stand_name . ' - Kelbom' : 'Stand introuvable - Kelbom' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body class="bg-[#F4F5F7] text-zinc-900 flex flex-col min-h-screen">

    <x-client.top-header />
    <x-client.header />

    <main class="flex-grow pb-20">
        @if(!$stand)
            <div class="max-w-3xl mx-auto py-32 px-6 text-center">
                <svg class="w-20 h-20 text-zinc-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                <h1 class="text-3xl md:text-4xl font-black text-zinc-900 mb-4 tracking-tight">Stand non trouvé</h1>
                <p class="text-zinc-500 mb-10 text-lg">Ce stand n'existe pas ou a été désactivé par son propriétaire.</p>
                <a href="{{ route('client.marketplace') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-[#0A2E65] text-white font-bold rounded-xl shadow-lg shadow-blue-900/20 hover:bg-[#153e82] hover:-translate-y-0.5 transition-all">
                    Voir les autres stands
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>
        @else
            <!-- Header Profile Section -->
            <div class="bg-white shadow-sm mb-8" x-data="{ activeTab: 'products' }">
                <div class="max-w-[1100px] mx-auto">
                    <!-- Cover Photo -->
                    <div class="w-full h-[200px] md:h-[320px] relative rounded-b-2xl md:rounded-b-[32px] overflow-hidden group bg-zinc-200">
                        @if($stand->cover_url)
                            <img src="{{ str_starts_with($stand->cover_url, 'http') ? $stand->cover_url : Storage::url($stand->cover_url) }}" alt="Cover" class="w-full h-full object-cover">
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-80"></div>
                    </div>

                    <!-- Profile Info -->
                    <div class="px-4 md:px-8 pb-0 relative">
                        <div class="flex flex-col md:flex-row md:items-end justify-between gap-5 -mt-12 md:-mt-16 mb-6">
                            
                            <div class="flex flex-col md:flex-row items-center md:items-end gap-5">
                                <div class="w-[110px] h-[110px] md:w-[150px] md:h-[150px] rounded-full border-4 border-white bg-white shadow-md overflow-hidden relative z-10 shrink-0 flex items-center justify-center font-bold text-4xl text-blue-600">
                                    @if($stand->logo_url)
                                        <img src="{{ str_starts_with($stand->logo_url, 'http') ? $stand->logo_url : Storage::url($stand->logo_url) }}" alt="Logo" class="w-full h-full object-cover">
                                    @else
                                        {{ strtoupper(substr($stand->stand_name, 0, 1)) }}
                                    @endif
                                </div>

                                <div class="text-center md:text-left pb-1">
                                    <h1 class="text-2xl md:text-3xl font-black text-zinc-900 flex items-center justify-center md:justify-start gap-2 tracking-tight">
                                        {{ $stand->stand_name }}
                                        @if($stand->is_verified)
                                            <svg class="w-6 h-6 text-[#0A2E65]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path></svg>
                                        @endif
                                    </h1>
                                    <p class="text-zinc-500 font-medium text-[15px] mt-1.5 flex items-center justify-center md:justify-start gap-2">
                                        <span>{{ '@' . $stand->slug }}</span>
                                        <span class="w-1 h-1 rounded-full bg-zinc-300"></span>
                                        <span class="flex items-center text-amber-500 font-bold gap-1">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                            {{ $stand->rating_avg }}
                                        </span>
                                        <span class="text-zinc-400">({{ $stand->total_reviews }} avis)</span>
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center justify-center gap-3 pb-2 w-full md:w-auto">
                                @if($stand->whatsapp_number)
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $stand->whatsapp_number) }}" target="_blank" class="flex-1 md:flex-none px-5 py-2.5 bg-[#25D366] hover:bg-[#1DA851] text-white font-bold rounded-xl flex items-center justify-center gap-2 transition-colors shadow-sm text-[15px]">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.573-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.618-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.274.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.099.824z" /></svg>
                                        WhatsApp
                                    </a>
                                @endif
                            </div>
                        </div>

                        <hr class="border-zinc-100">

                        <!-- Navigation Tabs -->
                        <nav class="flex items-center gap-8 mt-1 overflow-x-auto no-scrollbar">
                            <button @click="activeTab = 'products'" :class="activeTab === 'products' ? 'text-[#0A2E65] border-b-[3px] border-[#0A2E65]' : 'text-zinc-500 hover:text-zinc-800'" class="py-4 font-bold transition-colors whitespace-nowrap text-[15px]">Produits</button>
                            <button @click="activeTab = 'reviews'" :class="activeTab === 'reviews' ? 'text-[#0A2E65] border-b-[3px] border-[#0A2E65]' : 'text-zinc-500 hover:text-zinc-800'" class="py-4 font-bold transition-colors whitespace-nowrap text-[15px]">Avis & Réputations ({{ $stand->total_reviews }})</button>
                        </nav>
                    </div>
                </div>

                <!-- Main Content Area -->
                <div class="max-w-[1100px] mx-auto px-4 md:px-8 grid grid-cols-1 lg:grid-cols-12 gap-6 pt-6">

                    <!-- Left Sidebar (Intro / Details) -->
                    <div class="lg:col-span-4 space-y-6">
                        <div class="bg-white rounded-2xl p-5 shadow-sm border border-zinc-200/60">
                            <h2 class="text-[17px] font-black text-zinc-900 mb-4">À propos</h2>
                            <p class="text-[14px] text-zinc-600 mb-5 leading-relaxed">{{ $stand->description }}</p>

                            <div class="space-y-3.5">
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-zinc-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    <div>
                                        <p class="text-[14px] text-zinc-900 font-medium">{{ $stand->address }}</p>
                                        <p class="text-[13px] text-zinc-500">{{ $stand->city }}, {{ $stand->country }}</p>
                                    </div>
                                </div>

                                @if($stand->contact_phone)
                                    <div class="flex items-center gap-3">
                                        <svg class="w-5 h-5 text-zinc-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                        <span class="text-[14px] text-zinc-900 font-medium">{{ $stand->contact_phone }}</span>
                                    </div>
                                @endif

                                @if($stand->contact_email)
                                    <div class="flex items-center gap-3">
                                        <svg class="w-5 h-5 text-zinc-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                        <a href="mailto:{{ $stand->contact_email }}" class="text-[14px] text-blue-600 hover:underline font-medium break-all">{{ $stand->contact_email }}</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Right Content -->
                    <div class="lg:col-span-8 space-y-6">
                        
                        <!-- PRODUCTS TAB -->
                        <div x-show="activeTab === 'products'" x-cloak>
                            <div class="bg-white rounded-2xl p-4 shadow-sm border border-zinc-200/60 mb-6 flex items-center justify-between gap-4">
                                <div class="relative flex-1 max-w-sm">
                                    <svg class="w-5 h-5 absolute left-3 top-1/2 -translate-y-1/2 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                    <input type="text" placeholder="Rechercher dans ce stand..." class="w-full bg-zinc-100 border-none rounded-xl pl-10 pr-4 py-2.5 text-[14px] font-medium focus:ring-2 focus:ring-[#0A2E65] outline-none">
                                </div>
                            </div>

                            <div class="grid grid-cols-2 md:grid-cols-3 gap-5">
                                @forelse($stand->activeProducts ?? [] as $product)
                                    <div class="bg-white border border-zinc-200/80 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group cursor-pointer flex flex-col">
                                        <div class="relative w-full h-40 md:h-48 bg-zinc-100 overflow-hidden">
                                            @if($product->main_image_url)
                                                <img src="{{ str_starts_with($product->main_image_url, 'http') ? $product->main_image_url : Storage::url($product->main_image_url) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                            @else
                                                <div class="flex items-center justify-center h-full text-zinc-400"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg></div>
                                            @endif
                                        </div>
                                        <div class="p-4 flex flex-col flex-1">
                                            <h3 class="text-[14px] font-bold text-zinc-900 leading-tight mb-3 group-hover:text-[#0A2E65] transition-colors line-clamp-2">{{ $product->name }}</h3>
                                            <div class="mt-auto">
                                                <p class="text-[15px] font-black text-amber-500">{{ number_format($product->price, 0, ',', ' ') }} FCFA</p>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-span-full py-12 text-center bg-white rounded-2xl border border-zinc-200/60 shadow-sm">
                                        <svg class="w-12 h-12 text-zinc-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                        <p class="text-zinc-500 font-medium">Ce stand n'a pas encore de produits actifs.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- REVIEWS TAB -->
                        <div x-show="activeTab === 'reviews'" x-cloak class="space-y-6">
                            
                            @if(session('success'))
                                <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 p-4 rounded-xl font-medium shadow-sm">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <!-- Submit Review Form -->
                            <div class="bg-white rounded-2xl p-6 shadow-sm border border-zinc-200/60">
                                <h3 class="text-[17px] font-black text-zinc-900 mb-4">Laisser un avis</h3>
                                <form action="{{ route('client.stand.review.store', $slug) }}" method="POST" class="space-y-4">
                                    @csrf
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-semibold text-zinc-700 mb-1.5">Votre Nom <span class="text-red-500">*</span></label>
                                            <input type="text" name="reviewer_name" required placeholder="Ex: Jean Dupont" class="w-full rounded-xl border-zinc-300 focus:border-[#0A2E65] focus:ring-[#0A2E65] bg-zinc-50">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-semibold text-zinc-700 mb-1.5">Note (sur 5) <span class="text-red-500">*</span></label>
                                            <select name="rating" required class="w-full rounded-xl border-zinc-300 focus:border-[#0A2E65] focus:ring-[#0A2E65] bg-zinc-50">
                                                <option value="5">5 - Excellent</option>
                                                <option value="4">4 - Très bien</option>
                                                <option value="3">3 - Correct</option>
                                                <option value="2">2 - Décevant</option>
                                                <option value="1">1 - Mauvais</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-zinc-700 mb-1.5">Votre commentaire (Optionnel)</label>
                                        <textarea name="comment" rows="3" placeholder="Partagez votre expérience avec ce stand..." class="w-full rounded-xl border-zinc-300 focus:border-[#0A2E65] focus:ring-[#0A2E65] bg-zinc-50"></textarea>
                                    </div>
                                    <div class="flex justify-end">
                                        <button type="submit" class="px-6 py-2.5 bg-[#0A2E65] text-white font-bold rounded-xl hover:bg-[#153e82] transition-colors shadow-sm">
                                            Publier mon avis
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <!-- List of Reviews -->
                            <div class="bg-white rounded-2xl p-6 shadow-sm border border-zinc-200/60">
                                <h3 class="text-[17px] font-black text-zinc-900 mb-6">Avis Récents ({{ $stand->total_reviews }})</h3>
                                
                                @if($stand->reviews->isEmpty())
                                    <div class="text-center py-8">
                                        <p class="text-zinc-500 font-medium">Aucun avis pour le moment. Soyez le premier à donner votre avis !</p>
                                    </div>
                                @else
                                    <div class="space-y-6">
                                        @foreach($stand->reviews as $review)
                                            <div class="border-b border-zinc-100 last:border-0 pb-6 last:pb-0">
                                                <div class="flex items-center justify-between mb-2">
                                                    <div class="flex items-center gap-3">
                                                        <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold">
                                                            {{ strtoupper(substr($review->reviewer_name, 0, 1)) }}
                                                        </div>
                                                        <div>
                                                            <p class="font-bold text-zinc-900">{{ $review->reviewer_name }}</p>
                                                            <p class="text-[12px] text-zinc-500">{{ $review->created_at->diffForHumans() }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="flex text-amber-400">
                                                        @for($i = 0; $i < $review->rating; $i++)
                                                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                                        @endfor
                                                    </div>
                                                </div>
                                                @if($review->comment)
                                                    <p class="text-zinc-700 leading-relaxed text-[15px] pl-13">{{ $review->comment }}</p>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endif
    </main>

    <x-client.footer />
</body>

</html>