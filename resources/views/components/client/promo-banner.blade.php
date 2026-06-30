<section class="max-w-[1400px] mx-auto px-4 md:px-8 py-4 mb-6">
    <a href="{{ route('seller.register') ?? '#' }}"
        class="block w-full rounded-3xl overflow-hidden shadow-sm hover:shadow-lg hover:shadow-amber-500/10 transition-all duration-500 group relative">
        <div class="w-full relative overflow-hidden "> <!-- Couleur de fond jaune en fallback -->
            <img src="{{ asset('assets/img/client/create-stand.png') }}" alt="Devenez Vendeur sur Kelbom"
                class="w-full h-auto max-h-[500px] object-cover sm:object-contain transition-transform duration-700 group-hover:scale-105">

            <!-- Optional: A subtle hover overlay effect -->
            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/5 transition-colors duration-500"></div>
        </div>
    </a>
</section>