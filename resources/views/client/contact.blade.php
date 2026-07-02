<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelbom - Contactez-nous</title>

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

<body class="bg-slate-50 text-slate-900 flex flex-col min-h-screen">

    <x-client.top-header />
    <x-client.header />

    <main class="flex-grow">
        <!-- Hero Section -->
        <section class="relative bg-[#0A2E65] opacity-[1] py-20 md:py-28 overflow-hidden">
            <div class="absolute inset-0 w-full h-full">
                <!-- Abstract pattern/image for background -->
                <div
                    class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10 mix-blend-overlay">
                </div>
                <div
                    class="absolute -top-24 -right-24 w-96 h-96 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20">
                </div>
                <div
                    class="absolute -bottom-24 -left-24 w-96 h-96 bg-indigo-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20">
                </div>
            </div>

            <div class="relative z-10 max-w-5xl mx-auto px-4 md:px-8 text-center">
                <span
                    class="inline-flex items-center gap-2 px-4 py-1.5 bg-blue-500/20 text-blue-200 border border-blue-400/30 text-[13px] font-bold uppercase tracking-widest rounded-full mb-6">
                    Support 24/7
                </span>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-white mb-6 tracking-tight">
                    Nous sommes là pour vous aider
                </h1>
                <p class="text-[16px] md:text-lg text-blue-100 font-medium leading-relaxed max-w-2xl mx-auto">
                    Une question, un partenariat ou besoin d'assistance ? N'hésitez pas à nous contacter. Notre équipe
                    vous répondra dans les plus brefs délais.
                </p>
            </div>
        </section>

        <!-- Main Content Section -->
        <section class="max-w-4xl mx-auto px-4 md:px-8 py-16 md:py-20 -mt-16 md:-mt-24 relative z-20">
            
            <!-- Top Section: Form -->
            @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-6 py-4 rounded-2xl mb-8 flex items-center gap-4 shadow-sm max-w-3xl mx-auto">
                    <svg class="w-6 h-6 text-emerald-500 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p class="font-medium text-sm md:text-base">{{ session('success') }}</p>
                </div>
            @endif

            <div class="bg-white rounded-3xl shadow-xl shadow-blue-900/5 border border-slate-200 p-8 md:p-10 mb-12">
                <h2 class="text-2xl md:text-3xl font-black text-slate-900 mb-2 text-center">Envoyez-nous un message</h2>
                <p class="text-slate-500 mb-8 text-center max-w-2xl mx-auto">Remplissez le formulaire ci-dessous, notre équipe reviendra vers vous rapidement.</p>

                <form action="{{ route('client.contact.store') }}" method="POST" class="space-y-6 max-w-3xl mx-auto">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nom -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Votre nom <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="name" required placeholder="Ex: Jean Dupont"
                                class="w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500 bg-slate-50 py-3.5 px-4 transition-colors">
                        </div>
                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Votre adresse email
                                <span class="text-red-500">*</span></label>
                            <input type="email" name="email" required placeholder="Ex: jean@example.com"
                                class="w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500 bg-slate-50 py-3.5 px-4 transition-colors">
                        </div>
                    </div>

                    <!-- Objet -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Objet du message <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="subject" required
                            placeholder="Ex: Demande de partenariat, Problème technique..."
                            class="w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500 bg-slate-50 py-3.5 px-4 transition-colors">
                    </div>

                    <!-- Message -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Votre message <span
                                class="text-red-500">*</span></label>
                        <textarea name="message" rows="6" required placeholder="Détaillez votre demande ici..."
                            class="w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500 bg-slate-50 py-3.5 px-4 transition-colors resize-none"></textarea>
                    </div>

                    <!-- Submit -->
                    <button type="submit"
                        class="w-full py-4 bg-[#0A2E65] hover:bg-blue-900 text-white font-bold rounded-xl shadow-lg shadow-blue-900/20 transition-all duration-300 flex items-center justify-center gap-2">
                        Envoyer le message
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </button>
                </form>
            </div>
            
            <!-- Divider -->
            <div class="flex items-center justify-center gap-4 mb-12">
                <div class="h-px bg-slate-200 flex-1 max-w-[100px]"></div>
                <span class="text-sm font-bold text-slate-400 uppercase tracking-widest">Ou contactez-nous directement via</span>
                <div class="h-px bg-slate-200 flex-1 max-w-[100px]"></div>
            </div>

            <!-- Bottom Section: Contact Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <!-- WhatsApp Card -->
                <div
                    class="bg-white rounded-3xl shadow-lg shadow-emerald-900/5 p-8 border border-slate-200 transition-transform hover:-translate-y-1 text-center flex flex-col items-center">
                    <div
                        class="w-16 h-16 bg-emerald-500 rounded-2xl flex items-center justify-center mb-6 shadow-sm">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-800 mb-2">WhatsApp</h3>
                    <p class="text-slate-500 mb-8 leading-relaxed max-w-sm">Discutez avec nous instantanément — réponse la
                        plus rapide garantie.</p>
                    <a href="https://wa.me/237600000000" target="_blank"
                        class="mt-auto flex items-center justify-center gap-2 w-full max-w-[280px] py-3.5 bg-[#25D366] hover:bg-[#1ebd5a] text-white font-bold rounded-xl transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                            </path>
                        </svg>
                        Ouvrir le chat
                    </a>
                </div>

                <!-- Email Card -->
                <div
                    class="bg-white rounded-3xl shadow-lg shadow-amber-900/5 p-8 border border-slate-200 transition-transform hover:-translate-y-1 text-center flex flex-col items-center">
                    <div class="w-16 h-16 bg-amber-500 rounded-2xl flex items-center justify-center mb-6 shadow-sm">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-800 mb-2">Email us</h3>
                    <p class="text-slate-500 mb-8 leading-relaxed max-w-sm">Écrivez-nous directement — nous vous répondons
                        dans les 24 heures.</p>
                    <a href="mailto:info@kelbom.com"
                        class="mt-auto flex items-center justify-center gap-2 w-full max-w-[280px] py-3.5 bg-[#D4AF37] hover:bg-[#c4a132] text-white font-bold rounded-xl transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                        info@kelbom.com
                    </a>
                </div>

            </div>
        </section>

    </main>

    <x-client.footer />

</body>

</html>