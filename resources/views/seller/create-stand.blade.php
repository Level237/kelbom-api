<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Créer un Stand | {{ config('app.name', 'Kelbom') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

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

    @php
        $currentStep = request('step', 1);
        $totalSteps = 4;
        
        // Valider que le step est entre 1 et 4
        if ($currentStep < 1 || $currentStep > $totalSteps) {
            $currentStep = 1;
        }
    @endphp

    <!-- Dynamic Step Component Loader -->
    @switch($currentStep)
        @case(1)
            <x-seller.stand-creation-step-1 :data="$data" />
            @break
        @case(2)
            <x-seller.stand-creation-step-2 :data="$data" />
            @break
        @case(3)
            <x-seller.stand-creation-step-3 :data="$data" />
            @break
        @case(4)
            <x-seller.stand-creation-step-4 :data="$data" />
            @break
        @default
            <x-seller.stand-creation-step-1 :data="$data" />
    @endswitch

    <script>
        // Navigation helper
        const navigateToStep = (stepNumber) => {
            const totalSteps = 4;
            if (stepNumber >= 1 && stepNumber <= totalSteps) {
                window.location.href = `{{ route('seller.stand.create') }}?step=${stepNumber}`;
            }
        };

        // Store current step for JavaScript usage
        window.currentStep = {{ $currentStep }};
        window.totalSteps = {{ $totalSteps }};

        // Handle form submissions and navigation
        document.addEventListener('DOMContentLoaded', function() {
            // Next button handler - Now we should submit the form
            const nextButtons = document.querySelectorAll('[data-action="next-step"]');
            nextButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    const form = this.closest('form');
                    if (form) {
                        form.submit();
                    }
                });
            });

            // Previous button handler
            const prevButtons = document.querySelectorAll('[data-action="prev-step"]');
            prevButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const prevStep = window.currentStep - 1;
                    if (prevStep >= 1) {
                        navigateToStep(prevStep);
                    }
                });
            });

            // Cancel button handler
            const cancelButtons = document.querySelectorAll('[data-action="cancel"]');
            cancelButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (confirm('Êtes-vous sûr de vouloir annuler la création du stand ?')) {
                        window.location.href = '/';
                    }
                });
            });
        });
    </script>

</body>

</html>



