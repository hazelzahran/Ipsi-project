<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Your Cart - Vintage Archive</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-stone-50 text-stone-950 antialiased">
    <div class="mx-auto flex min-h-screen max-w-7xl flex-col px-4 py-4 sm:px-6 lg:px-8">
        @include('partials.header', ['cartCount' => $cartCount ?? 0, 'active' => 'cart'])

        <main class="mt-8 flex-1">
            <div class="mb-6 flex items-end justify-between border-b border-stone-200 pb-4">
                <h1 class="text-4xl font-semibold tracking-tight">Your Cart</h1>
                <span class="text-sm text-stone-500">{{ $cartCount }} items</span>
            </div>

            <section class="grid gap-6 lg:grid-cols-[1fr_20rem]">
                <div class="space-y-4">
                    @foreach ($items as $item)
                        <article class="grid grid-cols-[1.25rem_5.5rem_1fr] items-start gap-4 rounded-3xl border border-stone-200 bg-white p-4">
                            <div class="pt-1">
                                <input type="checkbox" class="h-4 w-4 rounded border-stone-300" @checked($item['selected'])>
                            </div>

                            <div class="aspect-square overflow-hidden rounded-2xl bg-stone-100">
                                <img src="{{ Vite::asset($item['product']->primary_image_path) }}" alt="{{ $item['product']->name }}" class="h-full w-full object-cover">
                            </div>

                            <div>
                                <div class="flex items-start justify-between gap-4">
                                    <h2 class="text-2xl font-semibold leading-tight">{{ $item['product']->name }}</h2>
                                    <span class="text-3xl font-semibold">${{ number_format((float) $item['product']->price, 2) }}</span>
                                </div>

                                <p class="mt-2 text-sm text-stone-500">Size: {{ $item['product']->size }} · Condition: {{ $item['product']->condition }}</p>

                                <button class="mt-5 text-sm text-stone-600 underline underline-offset-4 transition hover:text-stone-900">Remove</button>
                            </div>
                        </article>
                    @endforeach
                </div>

                <aside class="h-fit rounded-3xl border border-stone-200 bg-white p-5">
                    <h2 class="text-3xl font-semibold tracking-tight">Order Summary</h2>

                    <dl class="mt-5 space-y-3 border-b border-stone-200 pb-5 text-sm">
                        <div class="flex items-center justify-between">
                            <dt class="text-stone-500">Subtotal ({{ $selectedItemsCount }} items)</dt>
                            <dd>${{ number_format($subtotal, 2) }}</dd>
                        </div>
                        <div class="flex items-center justify-between">
                            <dt class="text-stone-500">Estimated Shipping</dt>
                            <dd>${{ number_format($shipping, 2) }}</dd>
                        </div>
                    </dl>

                    <div class="mt-5">
                        <div class="flex items-end justify-between">
                            <span class="text-3xl font-semibold">Total</span>
                            <span class="text-5xl font-bold">${{ number_format($total, 2) }}</span>
                        </div>
                        <p class="mt-2 text-xs text-stone-500">Taxes calculated at checkout</p>
                    </div>

                    <a href="{{ route('checkout') }}" class="mt-6 inline-flex w-full items-center justify-center rounded-xl bg-[#2f0a4f] px-4 py-3 text-sm font-semibold text-white transition hover:bg-[#22073a]">Checkout Now</a>
                </aside>
            </section>
        </main>

        @include('partials.footer')
    </div>
</body>
</html>
