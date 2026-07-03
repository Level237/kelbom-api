<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelbom - Notre Histoire</title>

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
    </style>
</head>

<body class="bg-zinc-50 text-zinc-900 flex flex-col min-h-screen">

    <x-client.top-header />
    <x-client.header />

    <!-- HERO SECTION -->
    <div class="relative w-full h-[600px] flex items-center justify-center overflow-hidden bg-slate-900">
        <!-- Abstract Background Elements -->
        <div class="absolute inset-0 z-0">
            <div
                class="absolute top-0 left-0 w-[600px] h-[600px] bg-blue-600/20 rounded-full blur-[120px] -translate-x-1/2 -translate-y-1/2">
            </div>
            <div
                class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-[#EAB308]/20 rounded-full blur-[100px] translate-x-1/3 translate-y-1/3">
            </div>
        </div>

        <div class="relative z-10 text-center px-4 max-w-4xl mx-auto mt-16">
            <span
                class="inline-block px-4 py-1.5 rounded-full bg-blue-500/10 text-blue-300 font-bold text-sm tracking-wider uppercase mb-6 border border-blue-500/20 backdrop-blur-md">Notre
                Histoire</span>
            <h1
                class="text-4xl md:text-5xl lg:text-7xl font-black text-white leading-tight tracking-tight mb-8 drop-shadow-lg">
                Des sentiers du village <br />à un <span
                    class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-[#EAB308]">marché
                    mondial</span>.
            </h1>
            <p class="text-lg md:text-xl text-slate-300 font-medium max-w-2xl mx-auto leading-relaxed">
                Un hommage à ceux qui ont marché avant nous — et une promesse à ceux qui bâtissent la suite.
            </p>
        </div>
    </div>

    <!-- SECTION 1: Introduction -->
    <div class="py-24 bg-white relative overflow-hidden">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-50 text-blue-600 mb-8">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-8 tracking-tight">Introduction</h2>
            <div class="space-y-6 text-lg text-slate-600 leading-relaxed font-medium">
                <p>
                    Il fut un temps où le marché n'était pas simplement un lieu… c'était un voyage.
                    Bien avant les smartphones, avant les routes modernes, avant les messages instantanés, <strong
                        class="text-slate-900">Kelbom existait déjà</strong> — non pas sur des écrans, mais dans le cœur
                    des hommes et des femmes.
                </p>
                <p
                    class="text-2xl font-semibold text-[#153e82] py-4 italic border-l-4 border-[#EAB308] pl-6 ml-4 text-left">
                    Dans les villages, on ne disait pas « à demain ». On disait : « on se voit à Kelbom ».
                </p>
                <p>
                    Parce que Kelbom n'était pas tous les jours. C'était le jour.
                </p>
            </div>
        </div>
    </div>

    <!-- SECTION 2: Le passé -->
    <div class="py-24 bg-slate-50 relative">
        <div class="max-w-[1200px] mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="order-2 lg:order-1 relative">
                    <div class="absolute inset-0 bg-blue-100 transform rotate-3 rounded-3xl -z-10"></div>
                    <img src="{{ asset('images/market_dawn.png') }}" alt="Le temps de la marche"
                        class="rounded-3xl shadow-xl w-full object-cover h-[500px] z-10 relative">
                </div>

                <div class="order-1 lg:order-2">
                    <span class="text-blue-600 font-bold tracking-wider uppercase text-sm mb-4 block">Le passé</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-6 tracking-tight">Le temps de la marche
                    </h2>

                    <div class="space-y-6 text-lg text-slate-600 leading-relaxed">
                        <p>
                            Avant les années 50 et après les indépendances, les communautés se reconstruisaient à
                            travers le commerce, le courage et les relations humaines. Les marchés étaient rares et
                            précieux.
                        </p>

                        <ul class="space-y-4">
                            <li class="flex gap-4">
                                <span
                                    class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-full bg-blue-100 text-blue-600 font-bold mt-1">1</span>
                                <div>
                                    <strong class="text-slate-900 block">Le mercredi</strong>
                                    <span>était le petit marché du village.</span>
                                </div>
                            </li>
                            <li class="flex gap-4">
                                <span
                                    class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-full bg-blue-100 text-blue-600 font-bold mt-1">2</span>
                                <div>
                                    <strong class="text-slate-900 block">Le samedi</strong>
                                    <span>le grand marché des villages voisins.</span>
                                </div>
                            </li>
                            <li class="flex gap-4">
                                <span
                                    class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-full bg-[#EAB308]/20 text-yellow-700 font-bold mt-1">3</span>
                                <div>
                                    <strong class="text-slate-900 block">Et parfois…</strong>
                                    <span>un marché exceptionnel rassemblait toute une région. Ce jour s'appelait
                                        <strong class="text-[#153e82]">Kelbom</strong> — le jour du marché.</span>
                                </div>
                            </li>
                        </ul>

                        <p class="pt-4 border-t border-slate-200">
                            Les gens marchaient pendant des jours. Ils traversaient des rivières, gravissaient des
                            collines, dormaient sous les étoiles. Ce n'était pas facile. Mais quelque chose de plus fort
                            les faisait avancer.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION 3: La transformation -->
    <div class="py-24 bg-white relative">
        <div class="max-w-[1200px] mx-auto px-6">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-[#EAB308] font-bold tracking-wider uppercase text-sm mb-4 block">La
                    transformation</span>
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 tracking-tight">La joie qui effaçait la fatigue
                </h2>
                <p class="text-lg text-slate-600 mt-6 font-medium">Au bout du chemin… il y avait Kelbom.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Card 1 -->
                <div
                    class="bg-slate-50 rounded-2xl p-8 text-center hover:-translate-y-2 transition-transform duration-300 border border-slate-100">
                    <div
                        class="w-16 h-16 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6 transform rotate-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Les vendeurs</h3>
                    <p class="text-slate-600">trouvaient des acheteurs</p>
                </div>

                <!-- Card 2 -->
                <div
                    class="bg-slate-50 rounded-2xl p-8 text-center hover:-translate-y-2 transition-transform duration-300 border border-slate-100">
                    <div
                        class="w-16 h-16 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-6 transform -rotate-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Les acheteurs</h3>
                    <p class="text-slate-600">trouvaient des trésors</p>
                </div>

                <!-- Card 3 -->
                <div
                    class="bg-slate-50 rounded-2xl p-8 text-center hover:-translate-y-2 transition-transform duration-300 border border-slate-100">
                    <div
                        class="w-16 h-16 bg-amber-100 text-amber-600 rounded-2xl flex items-center justify-center mx-auto mb-6 transform rotate-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Les amis</h3>
                    <p class="text-slate-600">se retrouvaient</p>
                </div>

                <!-- Card 4 -->
                <div
                    class="bg-slate-50 rounded-2xl p-8 text-center hover:-translate-y-2 transition-transform duration-300 border border-slate-100">
                    <div
                        class="w-16 h-16 bg-purple-100 text-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-6 transform -rotate-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Les inconnus</h3>
                    <p class="text-slate-600">devenaient famille</p>
                </div>
            </div>

            <div class="mt-16 bg-[#153e82] rounded-3xl p-8 md:p-12 text-center text-white relative overflow-hidden">
                <div class="absolute inset-0 opacity-10"
                    style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 24px 24px;">
                </div>
                <div class="relative z-10">
                    <p class="text-xl md:text-2xl font-bold mb-6">Kelbom n'était pas seulement un marché. C'était une
                        fête de la vie.</p>
                    <p class="text-blue-100 font-medium max-w-3xl mx-auto leading-relaxed">
                        Kelbom était aussi un lieu d'information. Si tu voulais voir quelqu'un, tu attendais Kelbom. Si
                        tu voulais être connu, tu allais à Kelbom. La présence comptait.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION 4: L'ère numérique -->
    <div class="py-24 bg-slate-900 text-white relative overflow-hidden">
        <!-- Background Accents -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-blue-600/10 rounded-full blur-[80px]"></div>

        <div class="max-w-[1200px] mx-auto px-6 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-blue-400 font-bold tracking-wider uppercase text-sm mb-4 block">L'ère numérique</span>
                <h2 class="text-3xl md:text-4xl font-bold tracking-tight">Aujourd'hui — Le marché qui vient à vous</h2>
                <p class="text-lg text-slate-400 mt-6 leading-relaxed">
                    Aujourd'hui, tout a changé. Plus de longues marches. Plus d'attente d'un jour précis.
                    Kelbom n'est plus un lieu vers lequel on se déplace. C'est un lieu que l'on porte. Dans sa poche.
                    Dans son téléphone.
                </p>
            </div>

            <div class="bg-white/5 border border-white/10 rounded-3xl p-8 md:p-12 backdrop-blur-sm">
                <h3 class="text-2xl font-bold mb-8 text-center">Kelbom n'a pas perdu son âme. Mais aujourd'hui :</h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                    <div class="p-6">
                        <div
                            class="w-14 h-14 bg-blue-500/20 text-blue-400 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <p class="text-lg font-semibold text-white">Un Stand se crée en quelques secondes</p>
                    </div>

                    <div class="p-6">
                        <div
                            class="w-14 h-14 bg-emerald-500/20 text-emerald-400 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z">
                                </path>
                            </svg>
                        </div>
                        <p class="text-lg font-semibold text-white">Un produit se partage avec un lien</p>
                    </div>

                    <div class="p-6">
                        <div
                            class="w-14 h-14 bg-amber-500/20 text-amber-400 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                </path>
                            </svg>
                        </div>
                        <p class="text-lg font-semibold text-white">Un client se contacte instantanément</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION 5: La vision & CTA -->
    <div class="py-24 bg-white relative">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <span class="text-[#EAB308] font-bold tracking-wider uppercase text-sm mb-4 block">La vision</span>
            <h2 class="text-3xl md:text-5xl font-black text-slate-900 mb-8 tracking-tight">Le marché sans limites
                <br /><span class="text-[#153e82]">et l'histoire continue…</span>
            </h2>

            <p class="text-xl text-slate-600 font-medium leading-relaxed mb-12">
                Kelbom est un hommage à ceux qui ont marché avant nous. À ceux qui ont porté le commerce sur leurs
                épaules. Aujourd'hui, Kelbom récompense leur marche.
            </p>

            <div class="flex flex-col md:flex-row justify-center items-center gap-6 mb-16">
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="font-bold text-slate-800">Sans distance</span>
                </div>
                <div class="hidden md:block w-2 h-2 bg-slate-300 rounded-full"></div>
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="font-bold text-slate-800">Sans fermeture</span>
                </div>
                <div class="hidden md:block w-2 h-2 bg-slate-300 rounded-full"></div>
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="font-bold text-slate-800">Sans barrières</span>
                </div>
            </div>

            <div class="p-8 bg-blue-50 rounded-2xl mb-16 border border-blue-100">
                <p class="text-2xl font-bold text-blue-900 mb-2">Un marché partout. Un marché à tout moment.</p>
                <p class="text-lg text-blue-700">Kelbom n'est pas un souvenir. C'est une renaissance.</p>
            </div>

            <!-- CTA Section -->
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('client.marketplace') }}"
                    class="inline-flex items-center justify-center px-8 py-4 text-base font-bold text-white bg-[#153e82] hover:bg-blue-900 rounded-xl transition-colors shadow-lg shadow-blue-900/20">
                    Explorer le marché
                </a>
                <a href="{{ route("seller.register") }}"
                    class="inline-flex items-center justify-center px-8 py-4 text-base font-bold text-slate-900 bg-[#EAB308] hover:bg-[#CA8A04] rounded-xl transition-colors shadow-lg shadow-yellow-500/20">
                    Créer mon Stand
                </a>
            </div>
        </div>
    </div>

    <x-client.footer />

</body>

</html>