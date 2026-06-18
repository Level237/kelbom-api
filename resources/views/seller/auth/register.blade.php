<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Créer mon compte - Kelbom</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#FDFBF4]">
    <div class="min-h-[100dvh] flex">
        <!-- Left Side: Visual Hero -->
        <div style="background: url('{{ asset('assets/img/register.jpg') }}') center/cover;" class="hidden max-sm:hidden lg:flex lg:w-1/2 bg-gradient-to-br from-[#0A2E65] via-[#0A2E65]/90 to-emerald-600/20 flex-col items-center justify-center p-12 relative overflow-hidden">
            
            
            <!-- Overlay Gradient -->
            <div class="absolute inset-0 bg-gradient-to-t from-[#0A2E65]/96 via-transparent to-transparent"></div>
            
            
        </div>

        <!-- Right Side: Form -->
        <div class="w-full lg:w-1/2 flex flex-col items-center justify-center p-6 sm:p-8 md:p-12">
            <div class="w-full max-w-md">
                
                <!-- Header -->
                <div class="mb-8 animate-in fade-in slide-in-from-bottom-5 duration-700">
                    <h1 class="text-3xl md:text-4xl font-bold text-zinc-900 mb-2">
                        Créer mon compte
                    </h1>
                    <p class="text-zinc-600">Commencez à vendre en quelques minutes</p>
                </div>

                <!-- Form -->
                <form action="{{ route('seller.register.submit') }}" method="POST" class="space-y-5 animate-in fade-in slide-in-from-bottom-6 duration-700 delay-100">
                    @csrf

                    <!-- Name Field -->
                    <div class="space-y-2">
                        <label for="name" class="block text-sm font-bold text-zinc-900">
                            Nom complet
                        </label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name"
                            placeholder="Entrez votre nom"
                            value="{{ old('name') }}"
                            class="w-full px-4 py-3 rounded-lg border-2 {{ $errors->has('name') ? 'border-red-500 bg-red-50' : 'border-zinc-200 bg-white focus:border-[#0A2E65]' }} transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-emerald-500/10 font-medium"
                            required
                        />
                        @error('name')
                            <p class="text-sm text-red-600 flex items-center gap-1 mt-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18.101 12.93a1 1 0 00-1.414-1.414L10 16.586 3.414 10.101a1 1 0 10-1.414 1.414l7.071 7.07a1 1 0 001.414 0l9.9-9.9z" clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Phone Field -->
                    <div class="space-y-2">
                        <label for="phone_number" class="block text-sm font-bold text-zinc-900">
                            Numéro de téléphone
                        </label>
                        <input 
                            type="tel" 
                            id="phone_number" 
                            name="phone_number"
                            placeholder="Entrez votre numéro de téléphone"
                            value="{{ old('phone_number') }}"
                            class="w-full px-4 py-3 rounded-lg border-2 {{ $errors->has('phone_number') ? 'border-red-500 bg-red-50' : 'border-zinc-200 bg-white focus:border-[#0A2E65]' }} transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-emerald-500/10 font-medium"
                            required
                        />
                        @error('phone_number')
                            <p class="text-sm text-red-600 flex items-center gap-1 mt-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18.101 12.93a1 1 0 00-1.414-1.414L10 16.586 3.414 10.101a1 1 0 10-1.414 1.414l7.071 7.07a1 1 0 001.414 0l9.9-9.9z" clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </p>
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
                            placeholder="Entrez votre mot de passe (min 8 caractères)"
                            class="w-full px-4 py-3 rounded-lg border-2 {{ $errors->has('password') ? 'border-red-500 bg-red-50' : 'border-zinc-200 bg-white focus:border-[#0A2E65]' }} transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-emerald-500/10 font-medium"
                            required
                        />
                        @error('password')
                            <p class="text-sm text-red-600 flex items-center gap-1 mt-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18.101 12.93a1 1 0 00-1.414-1.414L10 16.586 3.414 10.101a1 1 0 10-1.414 1.414l7.071 7.07a1 1 0 001.414 0l9.9-9.9z" clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Password Confirmation -->
                    <div class="space-y-2">
                        <label for="password_confirmation" class="block text-sm font-bold text-zinc-900">
                            Confirmer le mot de passe
                        </label>
                        <input 
                            type="password" 
                            id="password_confirmation" 
                            name="password_confirmation"
                            placeholder="Confirmez votre mot de passe"
                            class="w-full px-4 py-3 rounded-lg border-2 border-zinc-200 bg-white focus:border-[#0A2E65] transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-emerald-500/10 font-medium"
                            required
                        />
                    </div>

                    <!-- CTA Button -->
                    <button 
                        type="submit"
                        class="w-full bg-gradient-to-r from-[#0A2E65] to-[#0A2E65]/90 text-white py-3.5 rounded-lg font-bold text-base shadow-lg shadow-blue-900/20 hover:shadow-xl hover:shadow-blue-900/30 hover:to-[#0A2E65] transition-all duration-300 active:scale-95 mt-6 flex items-center justify-center gap-2"
                    >
                        <span>Créer mon compte</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </button>

                    <!-- Login Link -->
                    <div class="text-center pt-4 border-t border-zinc-200">
                        <p class="text-zinc-600 text-sm">
                            Vous avez déjà un compte ? 
                            <a href="{{ route('login') }}" class="font-bold text-[#0A2E65] hover:text-[#0A2E65]/80 transition-colors">
                                Se connecter
                            </a>
                        </p>
                    </div>
                </form>

                <!-- Trust Section -->
                <div class="mt-8 p-4 bg-emerald-50/50 rounded-lg border border-emerald-200/30 animate-in fade-in slide-in-from-bottom-7 duration-700 delay-200">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-emerald-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <div class="text-sm">
                            <p class="font-bold text-zinc-900">Vos données sont sécurisées</p>
                            <p class="text-zinc-600 mt-1">Chiffrage SSL 256-bit et conformité RGPD</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Hero Image Placeholder (shown on mobile) -->
    
    <script>
        // Add slight delay to form animation on load
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.querySelector('form');
            if (form) {
                form.style.animationDelay = '0.1s';
            }
        });
    </script>
</body>
</html>
