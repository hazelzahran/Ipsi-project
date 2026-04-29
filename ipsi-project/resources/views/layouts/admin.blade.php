<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-stone-100">

<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    <aside class="w-64 bg-white border-r border-stone-200 p-6">

        <h2 class="text-xl font-bold mb-6">Admin Panel</h2>

        <nav class="space-y-2 text-sm">

            <a href="#" class="block px-4 py-2 rounded-lg hover:bg-stone-100">Dashboard</a>

            <a href="/admin/products"
               class="block px-4 py-2 rounded-lg bg-stone-200 font-medium">
               Products
            </a>

            <a href="#" class="block px-4 py-2 rounded-lg hover:bg-stone-100">Orders</a>

            <a href="#" class="block px-4 py-2 rounded-lg hover:bg-stone-100">Analytics</a>

        </nav>

    </aside>

    {{-- MAIN CONTENT --}}
    <div class="flex-1 flex flex-col">

        {{-- 🔥 NAVBAR ATAS (INI YANG KEMARIN HILANG) --}}
        <div class="bg-white border-b border-stone-200 px-6 py-3">
            @include('partials.header', ['cartCount' => 0, 'active' => 'admin'])
        </div>

        {{-- CONTENT --}}
        <main class="flex-1 p-6">
            @yield('content')
        </main>

    </div>

</div>

</body>
</html>