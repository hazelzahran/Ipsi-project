<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Vintage Archive</title>
    <!-- Vite untuk CSS & JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- FontAwesome untuk Ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts (Inter) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>

<body class="bg-[#F9FAFB] antialiased">

    {{-- TOP NAVBAR --}}
    <header class="bg-white border-b border-stone-100 px-8 py-4 fixed w-full top-0 z-50">
        <div class="flex justify-between items-center">
            {{-- Logo Vintage --}}
            <div class="flex items-center gap-2">
                <h1 class="text-2xl font-black text-[#2D1B4E] tracking-[0.2em] uppercase">Vintage</h1>
            </div>

            {{-- Right Icons --}}
            <div class="flex items-center gap-6">
                <button class="text-stone-400 hover:text-stone-600 transition"><i class="far fa-bell text-lg"></i></button>
                <button class="text-stone-400 hover:text-stone-600 transition"><i class="fas fa-cog text-lg"></i></button>
                <button class="text-stone-400 hover:text-stone-600 transition"><i class="far fa-question-circle text-lg"></i></button>
                <div class="flex items-center gap-3 ml-2 cursor-pointer">
                    <div class="h-9 w-9 rounded-full bg-stone-100 border border-stone-200 flex items-center justify-center overflow-hidden">
                        <span class="text-xs font-bold text-stone-500">AD</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="flex pt-[73px]">

        {{-- SIDEBAR --}}
        <aside class="w-72 bg-white border-r border-stone-100 fixed h-[calc(100vh-73px)] overflow-y-auto">
            
            {{-- Thrift Manager Brand Area --}}
            <div class="p-6">
                <div class="flex items-center gap-4 p-4 bg-stone-50/50 rounded-2xl border border-stone-100">
                    <div class="w-12 h-12 bg-[#2D1B4E] rounded-xl flex items-center justify-center text-white shadow-lg shadow-purple-900/20">
                        <i class="fas fa-store text-lg"></i>
                    </div>
                    <div>
                        <h2 class="text-sm font-bold text-stone-900 leading-tight">Thrift Manager</h2>
                        <p class="text-[10px] text-stone-400 font-medium uppercase tracking-wider mt-0.5">V.1.02.ADMIN</p>
                    </div>
                </div>
            </div>

            <nav class="px-4 space-y-1">
                {{-- Dashboard: SAMBUNG KE HOME SCREEN (/) --}}
                <a href="/" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->is('/') ? 'bg-[#2D1B4E]/5 text-[#2D1B4E] font-bold' : 'text-stone-500 hover:bg-stone-50' }}">
                    <div class="w-8 flex justify-center">
                        <i class="fas fa-th-large text-lg"></i>
                    </div>
                    <span class="text-[15px]">Dashboard</span>
                </a>

                {{-- Products --}}
                <a href="/admin/products" class="relative flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->is('admin/products*') ? 'bg-[#F9FAFB] text-[#2D1B4E] font-bold' : 'text-stone-500 hover:bg-stone-50' }}">
                    <div class="w-8 flex justify-center">
                        <i class="fas fa-box text-lg"></i>
                    </div>
                    <span class="text-[15px]">Products</span>
                    @if(request()->is('admin/products*'))
                        <div class="absolute right-0 w-1.5 h-8 bg-[#2D1B4E] rounded-l-full shadow-[0_0_10px_rgba(45,27,78,0.3)]"></div>
                    @endif
                </a>

                {{-- Orders --}}
                <a href="/admin/orders" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->is('admin/orders*') ? 'bg-[#F9FAFB] text-[#2D1B4E] font-bold' : 'text-stone-500 hover:bg-stone-50' }}">
                    <div class="w-8 flex justify-center">
                        <i class="fas fa-shopping-cart text-lg"></i>
                    </div>
                    <span class="text-[15px]">Orders</span>
                </a>

                {{-- Analytics --}}
                <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->is('admin/analytics*') ? 'bg-[#F9FAFB] text-[#2D1B4E] font-bold' : 'text-stone-500 hover:bg-stone-50' }}">
                    <div class="w-8 flex justify-center">
                        <i class="fas fa-chart-line text-lg"></i>
                    </div>
                    <span class="text-[15px]">Analytics</span>
                </a>
            </nav>

            {{-- Logout Section --}}
            <div class="absolute bottom-6 w-full px-6">
                <button class="flex items-center gap-3 px-4 py-3 w-full text-stone-400 hover:text-red-500 transition rounded-xl hover:bg-red-50">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="text-sm font-semibold">Logout System</span>
                </button>
            </div>
        </aside>

        {{-- MAIN CONTENT AREA --}}
        <div class="flex-1 ml-72">
            {{-- Breadcrumb Navigation --}}
            <div class="px-10 py-4 bg-white/50 border-b border-stone-100 flex items-center gap-2 text-xs text-stone-400">
                <span>Pages</span>
                <i class="fas fa-chevron-right text-[8px]"></i>
                <span class="text-stone-900 font-medium capitalize">{{ str_replace('admin/', '', request()->path()) }}</span>
            </div>

            <main class="p-10">
                @yield('content')
            </main>
        </div>

    </div>

</body>
</html>