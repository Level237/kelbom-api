<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Se connecter - Kelbom</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#FDFBF4]">
    <div class="min-h-[100dvh] flex">
        <!-- Left Side: Visual Hero -->
        <div style="background: url('{{ asset('assets/img/login.jpg') }}') center/cover;" class="hidden max-sm:hidden lg:flex lg:w-1/2 bg-gradient-to-br from-[#0A2E65] via-[#0A2E65]/90 to-emerald-600/20 flex-col items-center justify-center p-12 relative overflow-hidden">
            
            
            <!-- Overlay Gradient -->
            <div class="absolute inset-0 bg-gradient-to-t from-[#0A2E65]/96 via-transparent to-transparent"></div>
            
            
        </div>

        <!-- Right Side: Form -->
        <div class="w-full lg:w-1/2 flex flex-col items-center justify-center p-6 sm:p-8 md:p-12">
            <div class="w-full max-w-md">
                
                <!-- Header -->
                <div class="mb-8 animate-in fade-in slide-in-from-bottom-5 duration-700">
                    <h1 class="text-3xl md:text-4xl font-bold text-zinc-900 mb-2">
                        Se connecter
                    </h1>
                    <p class="text-zinc-600">Accédez à votre compte Kelbom</p>
                </div>

                <!-- Form -->
                <form action="{{ route('login.submit') }}" method="POST" class="space-y-5 animate-in fade-in slide-in-from-bottom-6 duration-700 delay-100">
                    @csrf

                    <!-- Phone Field -->
                    <div class="space-y-2">
                        <label for="phone_number" class="block text-sm font-bold text-zinc-900">
                            Numéro de téléphone
                        </label>
                        <input 
                            type="tel" 
                            id="phone_number" 
                            name="phone_number"
                            value="{{ old('phone_number') }}"
                            placeholder="+228 90 00 00 00"
                            class="w-full px-4 py-3 rounded-lg border-2 @error('phone_number') border-red-500 @else border-zinc-200 @enderror bg-white focus:border-emerald-500 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-emerald-500/10 font-medium"
                            required
                        />
                        @error('phone_number')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-bold text-zinc-900">
                            Mot de passe
                        </label>
                        <input 
                            type="password" 
                            id="password" 
                            name="password"
                            placeholder="Votre mot de passe"
                            class="w-full px-4 py-3 rounded-lg border-2 border-zinc-200 bg-white focus:border-emerald-500 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-emerald-500/10 font-medium"
                            required
                        />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="remember" class="w-4 h-4 rounded border-zinc-300 text-emerald-600 cursor-pointer" />
                            <span class="text-sm text-zinc-600">Se souvenir de moi</span>
                        </label>
                        <a href="#" class="text-sm text-[#0A2E65] font-bold hover:text-[#0A2E65]/80 transition-colors">
                            Mot de passe oublié?
                        </a>
                    </div>

                    <!-- CTA Button -->
                    <button 
                        type="submit"
                        class="w-full bg-gradient-to-r from-[#0A2E65] to-[#0A2E65]/90 text-white py-3.5 rounded-lg font-bold text-base shadow-lg shadow-blue-900/20 hover:shadow-xl hover:shadow-blue-900/30 hover:to-[#0A2E65] transition-all duration-300 active:scale-95 mt-6 flex items-center justify-center gap-2"
                    >
                        <span>Se connecter</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </button>

                    <!-- Register Link -->
                    <div class="text-center pt-4 border-t border-zinc-200">
                        <p class="text-zinc-600 text-sm">
                            Pas encore de compte ? 
                            <a href="{{ route('seller.register') }}" class="font-bold text-[#0A2E65] hover:text-[#0A2E65]/80 transition-colors">
                                S'inscrire
                            </a>
                        </p>
                    </div>
                </form>

                <!-- Trust Section -->
                <div class="mt-8 p-4 bg-blue-50/50 rounded-lg border border-blue-200/30 animate-in fade-in slide-in-from-bottom-7 duration-700 delay-200">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18.101 12.93a1 1 0 00-1.414-1.414L10 16.586 3.414 10.101a1 1 0 10-1.414 1.414l7.071 7.07a1 1 0 001.414 0l9.9-9.9z" clip-rule="evenodd" />
                        </svg>
                        <div class="text-sm">
                            <p class="font-bold text-zinc-900">Connexion sécurisée</p>
                            <p class="text-zinc-600 mt-1">Chiffrage SSL 256-bit et authentification 2FA</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Hero Image Placeholder (shown on mobile) -->
    <div class="lg:hidden fixed top-0 left-0 w-full h-24 bg-gradient-to-r from-[#0A2E65] to-emerald-600/20 -z-50"></div>
</body>
</html>
