<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Catalog - Vintage Archive</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-stone-50 text-stone-950 antialiased">
    <div class="mx-auto flex min-h-screen max-w-7xl flex-col px-4 py-4 sm:px-6 lg:px-8">
        @include('partials.header', ['cartCount' => $cartCount ?? 0, 'active' => 'catalog'])

        <main class="mt-6 grid gap-6 lg:grid-cols-[18rem_1fr]">
            <aside class="rounded-[1.75rem] border border-stone-200 bg-white p-5 shadow-sm lg:sticky lg:top-6 lg:self-start">
                <div class="flex items-center justify-between">
                    <h1 class="text-2xl font-semibold tracking-tight">Filters</h1>
                    <span class="text-xs uppercase tracking-[0.3em] text-stone-500">Archive</span>
                </div>

                <form method="GET" action="{{ route('catalog') }}" class="mt-2">
                    <input type="hidden" name="search" value="{{ $selected['search'] }}">
                    <input type="hidden" name="sort" value="{{ $selected['sort'] }}">

                    @foreach ($filters as $title => $options)
                        @php
                            $key = strtolower($title);
                            $selectedValues = $selected[$key] ?? [];
                        @endphp
                        <section class="mt-6 border-t border-stone-200 pt-5 first:mt-8 first:border-t-0 first:pt-0">
                            <h2 class="text-xs uppercase tracking-[0.35em] text-stone-500">{{ $title }}</h2>
                            <div class="mt-4 space-y-3">
                                @foreach ($options as $option)
                                    @php
                                        $optionValue = $option;
                                    @endphp
                                    <label class="flex cursor-pointer items-center gap-3 rounded-2xl border border-stone-200 px-3 py-2 text-sm transition hover:border-stone-400">
                                        <input
                                            type="checkbox"
                                            name="{{ $key }}[]"
                                            value="{{ $optionValue }}"
                                            @checked(in_array($optionValue, $selectedValues, true) || ($key === 'category' && $selectedValues === [] && $optionValue === 'All Clothing'))
                                            class="h-4 w-4 border-stone-400 text-stone-950 focus:ring-stone-950"
                                        >
                                        <span>{{ $option }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </section>
                    @endforeach

                    <section class="mt-6 border-t border-stone-200 pt-5">
                        <h2 class="text-xs uppercase tracking-[0.35em] text-stone-500">Price</h2>
                        <div class="mt-4 grid grid-cols-2 gap-3">
                            <input type="text" name="min_price" value="{{ $selected['min_price'] }}" placeholder="Min" class="rounded-2xl border border-stone-200 px-3 py-2 text-sm outline-none transition focus:border-stone-400">
                            <input type="text" name="max_price" value="{{ $selected['max_price'] }}" placeholder="Max" class="rounded-2xl border border-stone-200 px-3 py-2 text-sm outline-none transition focus:border-stone-400">
                        </div>
                    </section>

                    <div class="mt-5 grid grid-cols-2 gap-3">
                        <button type="submit" class="rounded-full bg-stone-950 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-stone-800">Apply</button>
                        <a href="{{ route('catalog') }}" class="inline-flex items-center justify-center rounded-full border border-stone-300 px-4 py-2.5 text-sm text-stone-600 transition hover:border-stone-500">Reset</a>
                    </div>
                </form>
            </aside>

            <section class="min-w-0">
                <div class="flex flex-col gap-4 border-b border-stone-200 pb-5 lg:flex-row lg:items-end lg:justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-[0.35em] text-stone-500">Curated second-hand pieces</p>
                        <h1 class="mt-2 text-4xl font-semibold tracking-tight">The Archive</h1>
                        <p class="mt-2 max-w-2xl text-sm leading-7 text-stone-600">Browse the catalog with a clean grid, clear pricing, and enough detail to compare vintage pieces quickly.</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <label class="text-sm text-stone-500">Sort by:</label>
                        <form method="GET" action="{{ route('catalog') }}">
                            <input type="hidden" name="search" value="{{ $selected['search'] }}">
                            @foreach ($selected['category'] as $value)
                                <input type="hidden" name="category[]" value="{{ $value }}">
                            @endforeach
                            @foreach ($selected['size'] as $value)
                                <input type="hidden" name="size[]" value="{{ $value }}">
                            @endforeach
                            @foreach ($selected['condition'] as $value)
                                <input type="hidden" name="condition[]" value="{{ $value }}">
                            @endforeach
                            <input type="hidden" name="min_price" value="{{ $selected['min_price'] }}">
                            <input type="hidden" name="max_price" value="{{ $selected['max_price'] }}">
                            <select name="sort" onchange="this.form.submit()" class="rounded-full border border-stone-200 bg-white px-4 py-2 text-sm outline-none transition focus:border-stone-400">
                                <option value="newest" @selected($selected['sort'] === 'newest')>Newest Arrivals</option>
                                <option value="price_asc" @selected($selected['sort'] === 'price_asc')>Price: Low to High</option>
                                <option value="price_desc" @selected($selected['sort'] === 'price_desc')>Price: High to Low</option>
                            </select>
                        </form>
                    </div>
                </div>

                <div class="mt-5">
                    <form method="GET" action="{{ route('catalog') }}">
                        @foreach ($selected['category'] as $value)
                            <input type="hidden" name="category[]" value="{{ $value }}">
                        @endforeach
                        @foreach ($selected['size'] as $value)
                            <input type="hidden" name="size[]" value="{{ $value }}">
                        @endforeach
                        @foreach ($selected['condition'] as $value)
                            <input type="hidden" name="condition[]" value="{{ $value }}">
                        @endforeach
                        <input type="hidden" name="min_price" value="{{ $selected['min_price'] }}">
                        <input type="hidden" name="max_price" value="{{ $selected['max_price'] }}">
                        <input type="hidden" name="sort" value="{{ $selected['sort'] }}">
                        <input type="search" name="search" value="{{ $selected['search'] }}" placeholder="Search items by name..." class="w-full rounded-full border border-stone-200 bg-white px-5 py-3 text-sm outline-none transition focus:border-stone-400">
                    </form>
                </div>

                <div class="mt-6 grid gap-5 sm:grid-cols-2 xl:grid-cols-3">
                    @forelse ($products as $product)
                        <article class="group overflow-hidden rounded-3xl border border-stone-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                            <div class="relative aspect-4/5 overflow-hidden bg-stone-100">
                                <img src="{{ Vite::asset($product->primary_image_path) }}" alt="{{ $product->name }}" class="h-full w-full object-cover transition duration-700 group-hover:scale-105">
                                <div class="absolute left-3 top-3 rounded-full bg-white/90 px-3 py-1 text-[11px] uppercase tracking-[0.25em] text-stone-700 backdrop-blur">{{ $product->category }}</div>
                            </div>
                            <div class="p-4">
                                <div class="flex items-start justify-between gap-4">
                                    <div>
                                        <p class="text-[11px] uppercase tracking-[0.3em] text-stone-500">{{ $product->category }}</p>
                                        <h2 class="mt-2 text-lg font-semibold text-stone-950">{{ $product->name }}</h2>
                                    </div>
                                    <span class="shrink-0 text-sm font-medium text-stone-600">${{ number_format((float) $product->price, 0) }}</span>
                                </div>
                                <div class="mt-4 flex items-center justify-between text-sm text-stone-500">
                                    <span>Size: {{ $product->size }}</span>
                                    <span>{{ $product->condition }}</span>
                                </div>
                                <button class="mt-5 inline-flex w-full items-center justify-center rounded-full bg-stone-950 px-4 py-3 text-sm font-semibold text-white transition hover:bg-stone-800">
                                    Add to Cart
                                </button>
                            </div>
                        </article>
                    @empty
                        <div class="col-span-full rounded-3xl border border-stone-200 bg-white p-8 text-center text-stone-500">
                            Tidak ada produk yang cocok dengan filter saat ini.
                        </div>
                    @endforelse
                </div>

                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            </section>
        </main>

        @include('partials.footer')
    </div>
</body>
</html>
