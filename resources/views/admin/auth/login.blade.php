<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelbom Admin - Connexion</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; -webkit-font-smoothing: antialiased; }
    </style>
</head>
<body class="bg-[#050B14] min-h-screen flex items-center justify-center relative overflow-hidden">

    <!-- Arrière-plan abstrait (Glowing effect) -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-lg h-[500px] bg-blue-600/20 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute bottom-[-10%] right-[-5%] w-[400px] h-[400px] bg-indigo-600/10 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="w-full max-w-[420px] px-6 relative z-10">
        <!-- Logo -->
        <div class="text-center mb-10">
            <h1 class="text-3xl font-black tracking-tighter text-white flex items-center justify-center gap-2">
                KELBOM <span class="text-blue-500 font-medium text-lg bg-blue-500/10 px-2 py-0.5 rounded border border-blue-500/20">Admin</span>
            </h1>
            <p class="text-zinc-400 text-sm mt-3 font-medium">Connectez-vous pour accéder au panneau de contrôle.</p>
        </div>

        <!-- Carte de Connexion -->
        <div class="bg-white/[0.03] backdrop-blur-xl border border-white/10 rounded-3xl p-8 shadow-2xl">
            <form action="{{ route('admin.login.submit') ?? '#' }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Champ Email -->
                <div>
                    <label class="block text-[13px] font-semibold text-zinc-300 mb-2">Adresse email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-zinc-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                        </div>
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="admin@kelbom.com" 
                            class="w-full bg-black/20 border border-white/10 rounded-xl py-3.5 pl-11 pr-4 text-white placeholder-zinc-600 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all text-[15px]">
                    </div>
                    @error('email')
                        <p class="text-red-400 text-xs mt-2 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Champ Mot de Passe -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label class="block text-[13px] font-semibold text-zinc-300">Mot de passe</label>
                        <a href="#" class="text-[12px] font-medium text-blue-500 hover:text-blue-400 transition-colors">Mot de passe oublié ?</a>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-zinc-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <input type="password" name="password" required placeholder="••••••••" 
                            class="w-full bg-black/20 border border-white/10 rounded-xl py-3.5 pl-11 pr-4 text-white placeholder-zinc-600 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all text-[15px]">
                    </div>
                </div>

                <!-- Se souvenir de moi -->
                <div class="flex items-center">
                    <input type="checkbox" id="remember" name="remember" class="w-4 h-4 rounded bg-black/20 border-white/20 text-blue-500 focus:ring-blue-500 focus:ring-offset-0">
                    <label for="remember" class="ml-2 text-[13px] text-zinc-400 cursor-pointer">Rester connecté</label>
                </div>

                <!-- Bouton Soumettre -->
                <button type="submit" class="w-full py-3.5 px-4 bg-blue-600 hover:bg-blue-500 text-white font-bold rounded-xl shadow-[0_0_20px_rgba(37,99,235,0.3)] transition-all duration-300 hover:shadow-[0_0_25px_rgba(37,99,235,0.5)] hover:-translate-y-0.5">
                    Connexion au tableau de bord
                </button>
            </form>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8">
            <p class="text-zinc-600 text-[12px]">
                &copy; {{ date('Y') }} Kelbom Marketplace.<br>Accès réservé au personnel autorisé.
            </p>
        </div>
    </div>

</body>
</html>
