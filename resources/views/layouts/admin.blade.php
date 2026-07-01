<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelbom Admin Dashboard</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        /* Hide scrollbar for sidebar */
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-[#F8FAFC] text-slate-800 antialiased h-screen overflow-hidden">
    <div class="flex h-full" x-data="{ sidebarOpen: false }">
        
        <!-- Sidebar -->
        @include('admin.partials.sidebar')

        <!-- Main Content Wrapper -->
        <div class="flex flex-col flex-1 min-w-0 overflow-hidden relative">
            <!-- Header -->
            @include('admin.partials.header')

            <!-- Main padding & scrollable area -->
            <main class="flex-1 overflow-y-auto overflow-x-hidden p-6 bg-[#F8FAFC]">
                <div class="max-w-7xl mx-auto">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
</body>
</html>
