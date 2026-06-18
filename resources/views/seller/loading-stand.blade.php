<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuration de votre Stand | Kelbom</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #ffffff;
        }
        .mesh-gradient {
            background: 
                radial-gradient(at 0% 0%, rgba(34, 197, 94, 0.03) 0, transparent 50%), 
                radial-gradient(at 100% 0%, rgba(59, 130, 246, 0.03) 0, transparent 50%),
                radial-gradient(at 100% 100%, rgba(16, 185, 129, 0.03) 0, transparent 50%),
                radial-gradient(at 0% 100%, rgba(59, 130, 246, 0.03) 0, transparent 50%);
        }
        .liquid-glass {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(244, 244, 245, 1);
            box-shadow: 
                0 20px 40px -15px rgba(0,0,0,0.05),
                inset 0 1px 0 rgba(255,255,255,0.5);
        }
        .shimmer {
            background: linear-gradient(
                90deg,
                transparent 0%,
                rgba(255, 255, 255, 0.4) 50%,
                transparent 100%
            );
            background-size: 200% 100%;
            animation: shimmer 2s infinite;
        }
        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
        .progress-spring {
            transition: width 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }
    </style>
</head>
<body class="text-zinc-900 min-h-[100dvh] flex flex-col items-center justify-center p-6 mesh-gradient overflow-hidden">
    
    <!-- Background Particles (Simplified SVG) -->
    <div class="fixed inset-0 pointer-events-none z-0 opacity-40">
        <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
            <circle cx="10" cy="10" r="0.2" fill="#10b981" class="animate-pulse" />
            <circle cx="90" cy="20" r="0.1" fill="#3b82f6" />
            <circle cx="50" cy="80" r="0.3" fill="#10b981" opacity="0.5" />
        </svg>
    </div>

    <!-- Main Container -->
    <div class="max-w-xl w-full relative z-10 flex flex-col items-center">
        
        <!-- Brand Signature -->
        <div class="flex items-center gap-2 group transition-transform duration-300 active:scale-95 shrink-0 pl-2">
            <a href="/" class="flex items-center gap-3 group transition-transform duration-300 active:scale-95 shrink-0">
                <img src="{{ asset('assets/img/kelbom-Photoroom.png') }}" alt="Kelbom" class="h-15 md:h-24 w-auto">
               
            </a>
        </div>

        <!-- Glass Panel -->
        <div class="w-full liquid-glass rounded-[2.5rem] p-10 md:p-14 text-center animate-in slide-in-from-bottom-8 duration-1000 ease-out">
            <h1 class="text-4xl md:text-5xl font-bold tracking-tighter leading-none mb-4 text-zinc-950">
                Préparation de <span class="text-[#0A2E65]">votre stand</span>
            </h1>
            <p class="text-zinc-500 text-lg md:text-xl font-light mb-12 max-w-[40ch] mx-auto">
                {{ $user->name }}, nous assemblons les pièces de votre futur stand professionnel.
            </p>

            <!-- Modern Loader -->
            <div class="relative w-full max-w-sm mx-auto mb-10">
                <!-- Progress Label -->
                <div class="flex justify-between items-end mb-4">
                    <span id="status-message" class="text-xs font-semibold uppercase tracking-widest text-[#0A2E65] transition-all duration-500">
                        Initialisation...
                    </span>
                    <span class="text-2xl font-mono font-medium text-zinc-900" id="progress-percent">
                        00%
                    </span>
                </div>

                <!-- Progress Bar Track -->
                <div class="h-3 w-full bg-zinc-100/80 rounded-full overflow-hidden p-[1px] border border-zinc-200/50">
                    <!-- Progress Bar Fill -->
                    <div id="progress-fill" class="h-full bg-[#0A2E65] rounded-full relative progress-spring w-0 shadow-[0_0_15px_rgba(16,185,129,0.3)]">
                        <!-- Shimmer Overlay -->
                        <div class="absolute inset-0 shimmer"></div>
                    </div>
                </div>
            </div>

            <!-- Subtle Badge -->
           
        </div>

        <!-- Footer Note -->
        <p class="mt-8 text-zinc-400 text-sm font-light animate-in fade-in duration-1000 delay-500">
            Ne fermez pas cette page. Votre tableau de bord sera prêt dans un instant.
        </p>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const progressFill = document.getElementById('progress-fill');
            const progressPercent = document.getElementById('progress-percent');
            const statusMessage = document.getElementById('status-message');
            
            const messages = [
                "Analyse des données",
                "Génération du stand",
                "Optimisation SEO",
                "Sécurisation SSL",
                "Déploiement final",
                "Bienvenue chez vous"
            ];

            let progress = 0;
            const duration = 6000; // 6 seconds for extra premium feel
            const interval = 40; 
            
            // Organic progress curve logic
            function updateProgress() {
                // Slower at the beginning and end, faster in the middle
                const increment = Math.random() * (progress < 30 || progress > 80 ? 0.4 : 1.2);
                progress += increment;

                if (progress >= 100) {
                    progress = 100;
                    progressFill.style.width = '100%';
                    progressPercent.textContent = '100%';
                    
                    setTimeout(() => {
                        // Success scale effect before redirect
                        document.querySelector('.liquid-glass').style.transform = 'scale(0.98)';
                        document.querySelector('.liquid-glass').style.opacity = '0';
                        document.querySelector('.liquid-glass').style.transition = 'all 0.5s ease-in-out';
                        
                        setTimeout(() => {
                            window.location.href = "{{ route('seller.dashboard') }}";
                        }, 500);
                    }, 800);
                    return;
                }

                // Update UI with formatted numbers
                progressFill.style.width = `${progress}%`;
                const displayPercent = Math.round(progress).toString().padStart(2, '0');
                progressPercent.textContent = `${displayPercent}%`;

                // Update status messages with fade effect
                const messageIndex = Math.floor((progress / 100) * messages.length);
                if (messages[messageIndex] && statusMessage.textContent !== messages[messageIndex]) {
                    statusMessage.style.opacity = '0';
                    statusMessage.style.transform = 'translateY(5px)';
                    setTimeout(() => {
                        statusMessage.textContent = messages[messageIndex];
                        statusMessage.style.opacity = '1';
                        statusMessage.style.transform = 'translateY(0)';
                    }, 250);
                }

                requestAnimationFrame(updateProgress);
            }

            // Start animation
            setTimeout(updateProgress, 500);
        });
    </script>
</body>
</html>
