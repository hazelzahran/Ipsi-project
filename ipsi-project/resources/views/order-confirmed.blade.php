<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order Confirmed - Vintage Archive</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-stone-50 text-stone-950 antialiased">
    <div class="mx-auto flex min-h-screen max-w-7xl flex-col px-4 py-4 sm:px-6 lg:px-8">
        @include('partials.header', ['cartCount' => $cartCount ?? 0, 'active' => 'cart'])

        <main class="mt-8 flex-1">
            <section class="mx-auto max-w-2xl">
                <div class="text-center">
                    <div class="mx-auto inline-flex h-16 w-16 items-center justify-center rounded-full bg-stone-100 text-2xl text-[#2f0a4f]">✓</div>
                    <h1 class="mt-4 text-4xl font-semibold tracking-tight">Order Confirmed!</h1>
                    <p class="mx-auto mt-2 max-w-lg text-sm text-stone-500">Thank you for your purchase. Your one-of-a-kind items are now reserved and being prepared for shipment.</p>
                </div>

                <article class="mt-6 rounded-3xl border border-stone-200 bg-white p-5">
                    <div class="grid gap-4 border-b border-stone-200 pb-5 text-sm sm:grid-cols-3">
                        <div>
                            <p class="text-[11px] uppercase tracking-[0.25em] text-stone-500">Order ID</p>
                            <p class="mt-1 font-semibold">#{{ $orderNumber }}</p>
                        </div>
                        <div>
                            <p class="text-[11px] uppercase tracking-[0.25em] text-stone-500">Date</p>
                            <p class="mt-1 font-semibold">{{ now()->format('M d, Y') }}</p>
                        </div>
                        <div>
                            <p class="text-[11px] uppercase tracking-[0.25em] text-stone-500">Estimated Delivery</p>
                            <p class="mt-1 font-semibold">{{ now()->addDays(4)->format('M d') }} - {{ now()->addDays(6)->format('d') }}</p>
                        </div>
                    </div>

                    <h2 class="mt-5 text-xl font-semibold">Order Summary</h2>
                    <div class="mt-3 divide-y divide-stone-200">
                        @foreach ($items as $item)
                            <div class="grid grid-cols-[4rem_1fr_auto] gap-3 py-4">
                                <div class="aspect-square overflow-hidden rounded-xl bg-stone-100">
                                    <img src="{{ Vite::asset($item->primary_image_path) }}" alt="{{ $item->name }}" class="h-full w-full object-cover">
                                </div>
                                <div>
                                    <p class="font-semibold">{{ $item->name }}</p>
                                    <p class="mt-1 text-sm text-stone-500">Size: {{ $item->size }} · Condition: {{ $item->condition }}</p>
                                </div>
                                <p class="font-medium">${{ number_format((float) $item->price, 2) }}</p>
                            </div>
                        @endforeach
                    </div>

                    <dl class="mt-3 space-y-2 border-t border-stone-200 pt-4 text-sm">
                        <div class="flex items-center justify-between"><dt class="text-stone-500">Subtotal</dt><dd>${{ number_format($subtotal, 2) }}</dd></div>
                        <div class="flex items-center justify-between"><dt class="text-stone-500">Shipping (Archival Insured)</dt><dd>${{ number_format($shipping, 2) }}</dd></div>
                        <div class="flex items-center justify-between text-base font-semibold"><dt>Total</dt><dd>${{ number_format($total, 2) }}</dd></div>
                    </dl>
                </article>

                <div class="mt-6 space-y-2">
                    <a href="{{ route('catalog') }}" class="inline-flex w-full items-center justify-center rounded-xl bg-[#2f0a4f] px-4 py-3 text-sm font-semibold text-white transition hover:bg-[#22073a]">Continue Shopping</a>
                    <button class="inline-flex w-full items-center justify-center rounded-xl border border-stone-300 px-4 py-3 text-sm text-stone-700 transition hover:border-stone-500">Download Invoice</button>
                </div>
            </section>
        </main>

        @include('partials.footer')
    </div>
</body>
</html>
