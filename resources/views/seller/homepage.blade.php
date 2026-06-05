<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Devenir Vendeur | {{ config('app.name', 'Kelbom') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        .liquid-glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.1);
        }

        .hero-gradient {
            background: radial-gradient(circle at 50% 50%, rgba(59, 130, 246, 0.05) 0%, transparent 50%);
        }
    </style>
</head>
<body class="bg-white text-zinc-950 min-h-[100dvh] flex flex-col selection:bg-blue-100 selection:text-blue-900">

    <x-seller.header :transparent="true" />

    <x-seller.hero />
    <x-seller.features />
    <footer class="py-10 border-t border-zinc-100">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-6">
            <p class="text-sm text-zinc-500">© 2026 {{ config('app.name', 'Kelbom') }}. Tous droits réservés.</p>
            <div class="flex gap-8 text-sm text-zinc-500 font-medium">
                <a href="#" class="hover:text-zinc-950 transition-colors">Confidentialité</a>
                <a href="#" class="hover:text-zinc-950 transition-colors">CGV</a>
                <a href="#" class="hover:text-zinc-950 transition-colors">Contact</a>
            </div>
        </div>
    </footer>

</body>
</html>
