<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelbom - Marketplace</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
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

    <!-- Top Header -->
    <x-client.top-header />

    <!-- Main Header -->
    <x-client.header />

    <!-- Main Content -->
    <main class="flex-grow">
        
        <!-- Marketplace Hero Section -->
        <section class="relative bg-[#050B14] h-[300px] md:h-[400px] flex items-center justify-center overflow-hidden border-b border-zinc-200">
            <!-- Background Image with light opacity -->
            <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?q=80&w=1920&auto=format&fit=crop" 
                 alt="Marketplace Background" 
                 class="absolute inset-0 w-full h-full object-cover opacity-20 transition-transform duration-[10s] hover:scale-105">
            
            <!-- Dark Overlay Gradient -->
            <div class="absolute inset-0 bg-gradient-to-t from-[#050B14] via-[#050B14]/60 to-transparent opacity-90"></div>
            
            <!-- Content -->
            <div class="relative z-10 text-center px-4 max-w-3xl mx-auto">
                <span class="inline-block px-3 py-1 bg-blue-500/20 text-blue-200 border border-blue-500/30 text-[12px] font-bold uppercase tracking-widest rounded-full mb-5 backdrop-blur-sm shadow-sm">
                    Catalogue Kelbom
                </span>
                <h1 class="text-4xl md:text-5xl font-black text-white mb-5 tracking-tight">
                    Explorez la Marketplace
                </h1>
                <p class="text-[16px] md:text-lg text-blue-100/90 font-medium leading-relaxed max-w-2xl mx-auto">
                    Découvrez des milliers de stands, produits exclusifs et fournisseurs à travers le monde. Trouvez exactement ce qu'il vous faut en quelques clics.
                </p>
            </div>
        </section>

    </main>

    <!-- Footer Component -->
    <x-client.footer />

</body>
</html>
