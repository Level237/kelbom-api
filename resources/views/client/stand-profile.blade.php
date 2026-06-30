<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $stand->stand_name }} - Kelbom</title>

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

        /* Masquer la scrollbar pour les onglets */
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

    <!-- Headers -->
    <x-client.top-header />
    <x-client.header />

    <main class="flex-grow pb-20">

        <!-- Header Profile Section (Facebook/LinkedIn Modern Style) -->
        <div class="bg-white shadow-sm mb-8">
            <div class="max-w-[1100px] mx-auto">
                <!-- Cover Photo -->
                <div
                    class="w-full h-[200px] md:h-[320px] relative rounded-b-2xl md:rounded-b-[32px] overflow-hidden group bg-zinc-200">
                    <img src="{{ $stand->cover_url }}" alt="Cover" class="w-full h-full object-cover">
                    <!-- Subtle dark overlay -->
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-80">
                    </div>
                </div>

                <!-- Profile Info (Overlap) -->
                <div class="px-4 md:px-8 pb-0 relative">
                    <div class="flex flex-col md:flex-row md:items-end justify-between gap-5 -mt-12 md:-mt-16 mb-6">

                        <!-- Avatar and Name -->
                        <div class="flex flex-col md:flex-row items-center md:items-end gap-5">
                            <!-- Logo / Avatar -->
                            <div
                                class="w-[110px] h-[110px] md:w-[150px] md:h-[150px] rounded-full border-4 border-white bg-white shadow-md overflow-hidden relative z-10 shrink-0">
                                <img src="{{ $stand->logo_url }}" alt="Logo {{ $stand->stand_name }}"
                                    class="w-full h-full object-cover">
                            </div>

                            <!-- Title & Info -->
                            <div class="text-center md:text-left pb-1">
                                <h1
                                    class="text-2xl md:text-3xl font-black text-zinc-900 flex items-center justify-center md:justify-start gap-2 tracking-tight">
                                    {{ $stand->stand_name }}
                                    @if($stand->is_verified)
                                        <svg class="w-6 h-6 text-[#0A2E65]" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z">
                                            </path>
                                        </svg>
                                    @endif
                                </h1>
                                <p
                                    class="text-zinc-500 font-medium text-[15px] mt-1.5 flex items-center justify-center md:justify-start gap-2">
                                    <span>{{ '@' . $stand->slug }}</span>
                                    <span class="w-1 h-1 rounded-full bg-zinc-300"></span>
                                    <span class="flex items-center text-amber-500 font-bold gap-1">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                            </path>
                                        </svg>
                                        {{ $stand->rating_avg }}
                                    </span>
                                    <span class="text-zinc-400">({{ $stand->total_reviews }} avis)</span>
                                </p>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-center gap-3 pb-2 w-full md:w-auto">
                            @if($stand->whatsapp_number)
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $stand->whatsapp_number) }}"
                                    target="_blank"
                                    class="flex-1 md:flex-none px-5 py-2.5 bg-[#25D366] hover:bg-[#1DA851] text-white font-bold rounded-xl flex items-center justify-center gap-2 transition-colors shadow-sm text-[15px]">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.573-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.618-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.274.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.099.824z" />
                                    </svg>
                                    WhatsApp
                                </a>
                            @endif
                            <button
                                class="flex-1 md:flex-none px-5 py-2.5 bg-zinc-100 hover:bg-zinc-200 text-zinc-800 font-bold rounded-xl flex items-center justify-center gap-2 transition-colors text-[15px]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                    </path>
                                </svg>
                                Message
                            </button>
                        </div>
                    </div>

                    <hr class="border-zinc-100">

                    <!-- Navigation Tabs -->
                    <nav class="flex items-center gap-8 mt-1 overflow-x-auto no-scrollbar">
                        <a href="#"
                            class="py-4 text-[#0A2E65] font-bold border-b-[3px] border-[#0A2E65] whitespace-nowrap text-[15px]">Produits</a>
                        <a href="#"
                            class="py-4 text-zinc-500 font-bold hover:text-zinc-800 transition-colors whitespace-nowrap text-[15px]">À
                            propos</a>
                        <a href="#"
                            class="py-4 text-zinc-500 font-bold hover:text-zinc-800 transition-colors whitespace-nowrap text-[15px]">Avis
                            & Réputations</a>
                        <a href="#"
                            class="py-4 text-zinc-500 font-bold hover:text-zinc-800 transition-colors whitespace-nowrap text-[15px]">Photos</a>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="max-w-[1100px] mx-auto px-4 md:px-8 grid grid-cols-1 lg:grid-cols-12 gap-6">

            <!-- Left Sidebar (Intro / Details - 4 columns) -->
            <div class="lg:col-span-4 space-y-6">
                <!-- Info Card -->
                <div class="bg-white rounded-2xl p-5 shadow-sm border border-zinc-200/60">
                    <h2 class="text-[17px] font-black text-zinc-900 mb-4">À propos</h2>
                    <p class="text-[14px] text-zinc-600 mb-5 leading-relaxed">
                        {{ $stand->description }}
                    </p>

                    <div class="space-y-3.5">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-zinc-400 shrink-0 mt-0.5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <div>
                                <p class="text-[14px] text-zinc-900 font-medium">{{ $stand->address }}</p>
                                <p class="text-[13px] text-zinc-500">{{ $stand->city }}, {{ $stand->country }}</p>
                            </div>
                        </div>

                        @if($stand->contact_phone)
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-zinc-400 shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                    </path>
                                </svg>
                                <span class="text-[14px] text-zinc-900 font-medium">{{ $stand->contact_phone }}</span>
                            </div>
                        @endif

                        @if($stand->contact_email)
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-zinc-400 shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <a href="mailto:{{ $stand->contact_email }}"
                                    class="text-[14px] text-blue-600 hover:underline font-medium break-all">{{ $stand->contact_email }}</a>
                            </div>
                        @endif

                        @if($stand->website_url)
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-zinc-400 shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9">
                                    </path>
                                </svg>
                                <a href="{{ $stand->website_url }}" target="_blank"
                                    class="text-[14px] text-blue-600 hover:underline font-medium">{{ str_replace(['http://', 'https://'], '', $stand->website_url) }}</a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Extra Stats/Trust Card -->
                <div
                    class="bg-white rounded-2xl p-5 shadow-sm border border-zinc-200/60 flex items-center justify-between">
                    <div class="text-center">
                        <p class="text-xl font-black text-zinc-900">34</p>
                        <p class="text-[12px] text-zinc-500 font-medium">Ventes</p>
                    </div>
                    <div class="w-px h-8 bg-zinc-200"></div>
                    <div class="text-center">
                        <p class="text-xl font-black text-zinc-900">{{ $stand->rating_avg }}/5</p>
                        <p class="text-[12px] text-zinc-500 font-medium">Note</p>
                    </div>
                    <div class="w-px h-8 bg-zinc-200"></div>
                    <div class="text-center">
                        <p class="text-xl font-black text-zinc-900">100%</p>
                        <p class="text-[12px] text-zinc-500 font-medium">Réponse</p>
                    </div>
                </div>
            </div>

            <!-- Right Content (Products Feed - 8 columns) -->
            <div class="lg:col-span-8 space-y-6">
                <!-- Filters / Search in products -->
                <div
                    class="bg-white rounded-2xl p-4 shadow-sm border border-zinc-200/60 flex items-center justify-between gap-4">
                    <div class="relative flex-1 max-w-sm">
                        <svg class="w-5 h-5 absolute left-3 top-1/2 -translate-y-1/2 text-zinc-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <input type="text" placeholder="Rechercher dans ce stand..."
                            class="w-full bg-zinc-100 border-none rounded-xl pl-10 pr-4 py-2.5 text-[14px] font-medium focus:ring-2 focus:ring-[#0A2E65] transition-all outline-none">
                    </div>
                    <button
                        class="px-4 py-2.5 text-[14px] font-bold text-zinc-700 bg-zinc-100 hover:bg-zinc-200 rounded-xl transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
                            </path>
                        </svg>
                        <span class="hidden sm:inline">Trier par</span>
                    </button>
                </div>

                <!-- Products Grid -->
                <div class="grid grid-cols-2 md:grid-cols-3 gap-5">
                    @php
                        $products = [
                            ['img' => 'https://images.unsplash.com/photo-1546868871-7041f2a55e12?q=80&w=400&auto=format&fit=crop', 'name' => 'Apple Watch Series 7', 'price' => '250,000 FCFA', 'category' => 'Montres connectées'],
                            ['img' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?q=80&w=400&auto=format&fit=crop', 'name' => 'Casque Audio Sony WH-1000XM4', 'price' => '180,000 FCFA', 'category' => 'Audio'],
                            ['img' => 'https://images.unsplash.com/photo-1523206489230-c012c64b2b48?q=80&w=400&auto=format&fit=crop', 'name' => 'iPhone 13 Pro - 256GB', 'price' => '650,000 FCFA', 'category' => 'Smartphones'],
                            ['img' => 'https://images.unsplash.com/photo-1583394838336-acd977736f90?q=80&w=400&auto=format&fit=crop', 'name' => 'Écouteurs AirPods Pro', 'price' => '120,000 FCFA', 'category' => 'Audio'],
                            ['img' => 'https://images.unsplash.com/photo-1585386959984-a4155224a1ad?q=80&w=400&auto=format&fit=crop', 'name' => 'MacBook Air M1 2020', 'price' => '750,000 FCFA', 'category' => 'Ordinateurs'],
                            ['img' => 'https://images.unsplash.com/photo-1606813907291-d86efa9b94db?q=80&w=400&auto=format&fit=crop', 'name' => 'Console PlayStation 5', 'price' => '450,000 FCFA', 'category' => 'Gaming'],
                        ];
                    @endphp

                    @foreach($products as $product)
                        <div
                            class="bg-white border border-zinc-200/80 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:shadow-[#0A2E65]/10 transition-all duration-300 group cursor-pointer flex flex-col hover:-translate-y-1">
                            <div class="relative w-full h-40 md:h-48 bg-zinc-100 overflow-hidden">
                                <img src="{{ $product['img'] }}" alt="{{ $product['name'] }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                <button
                                    class="absolute top-3 right-3 w-8 h-8 bg-white/80 backdrop-blur rounded-full flex items-center justify-center text-zinc-500 hover:text-red-500 hover:bg-white transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                            <div class="p-4 flex flex-col flex-1">
                                <span
                                    class="text-[11px] font-bold text-blue-600 uppercase tracking-wider mb-1">{{ $product['category'] }}</span>
                                <h3
                                    class="text-[14px] font-bold text-zinc-900 leading-tight mb-3 group-hover:text-[#0A2E65] transition-colors line-clamp-2">
                                    {{ $product['name'] }}
                                </h3>
                                <div class="mt-auto flex items-center justify-between">
                                    <p class="text-[15px] font-black text-amber-500">{{ $product['price'] }}</p>
                                    <button
                                        class="w-8 h-8 rounded-full bg-zinc-100 flex items-center justify-center text-zinc-900 group-hover:bg-[#0A2E65] group-hover:text-white transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </main>

    <x-client.footer />
</body>

</html>