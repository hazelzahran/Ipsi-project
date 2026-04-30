<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout - Vintage Archive</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-stone-50 text-stone-950 antialiased">
    <div class="mx-auto flex min-h-screen max-w-7xl flex-col px-4 py-4 sm:px-6 lg:px-8">
        @include('partials.header', ['cartCount' => $cartCount ?? 0, 'active' => 'cart'])

        <main class="mt-8 flex-1">
            <h1 class="mb-6 text-4xl font-semibold tracking-tight">Checkout</h1>

            <div class="grid gap-6 lg:grid-cols-[1fr_20rem]">
                <section class="space-y-6">
                    <article class="rounded-3xl border border-stone-200 bg-white p-5">
                        <h2 class="text-3xl font-semibold tracking-tight">Shipping Information</h2>

                        <div class="mt-5 grid gap-3 sm:grid-cols-2">
                            <input type="text" value="Jane" class="rounded-xl border border-stone-300 px-3 py-2.5 text-sm">
                            <input type="text" value="Doe" class="rounded-xl border border-stone-300 px-3 py-2.5 text-sm">
                        </div>

                        <input type="text" value="123 Vintage Lane" class="mt-3 w-full rounded-xl border border-stone-300 px-3 py-2.5 text-sm">

                        <div class="mt-3 grid gap-3 sm:grid-cols-[1fr_10rem]">
                            <input type="text" value="Portland" class="rounded-xl border border-stone-300 px-3 py-2.5 text-sm">
                            <input type="text" value="97204" class="rounded-xl border border-stone-300 px-3 py-2.5 text-sm">
                        </div>

                        <div class="mt-5 space-y-3">
                            <label class="flex items-start justify-between rounded-xl border border-[#2f0a4f] bg-stone-50 px-4 py-3">
                                <div>
                                    <p class="font-semibold">Standard Shipping</p>
                                    <p class="text-xs text-stone-500">3-5 Business Days</p>
                                </div>
                                <span class="font-medium">$5.00</span>
                            </label>
                            <label class="flex items-start justify-between rounded-xl border border-stone-300 bg-white px-4 py-3">
                                <div>
                                    <p class="font-semibold">Express Shipping</p>
                                    <p class="text-xs text-stone-500">1-2 Business Days</p>
                                </div>
                                <span class="font-medium">$15.00</span>
                            </label>
                        </div>
                    </article>

                    <article class="rounded-3xl border border-stone-200 bg-white p-5">
                        <h2 class="text-3xl font-semibold tracking-tight">Payment Details</h2>

                        <div class="mt-4 space-y-3">
                            <a href="{{ route('payment', ['method' => 'qris']) }}" class="flex items-center justify-between rounded-xl border border-[#2f0a4f] bg-stone-50 px-4 py-3">
                                <div>
                                    <p class="font-semibold">QRIS</p>
                                    <p class="text-xs text-stone-500">Pay with any supported app</p>
                                </div>
                                <span class="text-xs">QR</span>
                            </a>
                            <a href="{{ route('payment', ['method' => 'bank']) }}" class="flex items-center justify-between rounded-xl border border-stone-300 bg-white px-4 py-3">
                                <div>
                                    <p class="font-semibold">Bank Transfer (Virtual Account)</p>
                                    <p class="mt-1 text-xs text-stone-500">BCA · BRI · BNI · BSI</p>
                                </div>
                                <span class="text-xs">Bank</span>
                            </a>
                        </div>
                    </article>
                </section>

                <aside class="h-fit rounded-3xl border border-stone-200 bg-white p-5">
                    <h2 class="text-3xl font-semibold tracking-tight">Order Summary</h2>

                    <div class="mt-4 space-y-3">
                        @foreach ($items as $item)
                            <div class="grid grid-cols-[3.5rem_1fr] gap-3">
                                <div class="aspect-square overflow-hidden rounded-xl bg-stone-100">
                                    @if (!empty($item->primary_image_path))
                                        <img src="{{ asset($item->primary_image_path) }}" alt="{{ $item->name }}" class="h-full w-full object-cover">
                                    @else
                                        <div class="flex h-full w-full items-center justify-center bg-stone-200 text-xs text-stone-500">No Image</div>
                                    @endif
                                </div>
                                <div>
                                    <p class="font-semibold leading-tight">{{ $item->name }}</p>
                                    <p class="mt-1 text-xs text-stone-500">Size: {{ $item->size }} · Condition: {{ $item->condition }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <dl class="mt-5 space-y-2 border-t border-stone-200 pt-4 text-sm">
                        <div class="flex items-center justify-between"><dt class="text-stone-500">Subtotal</dt><dd>${{ number_format($subtotal, 2) }}</dd></div>
                        <div class="flex items-center justify-between"><dt class="text-stone-500">Shipping</dt><dd>${{ number_format($shipping, 2) }}</dd></div>
                        <div class="flex items-center justify-between"><dt class="text-stone-500">Taxes</dt><dd>${{ number_format($taxes, 2) }}</dd></div>
                    </dl>

                    <div class="mt-5 flex items-end justify-between">
                        <span class="text-3xl font-semibold">Total</span>
                        <span class="text-4xl font-bold">${{ number_format($total, 2) }}</span>
                    </div>

                    <a href="{{ route('payment', ['method' => 'qris']) }}" class="mt-5 inline-flex w-full items-center justify-center rounded-xl bg-[#2f0a4f] px-4 py-3 text-sm font-semibold text-white transition hover:bg-[#22073a]">Pay ${{ number_format($total, 2) }}</a>
                    <p class="mt-2 text-center text-xs text-stone-500">Secure SSL Encrypted Checkout</p>
                </aside>
            </div>
        </main>

        @include('partials.footer')
    </div>
</body>
</html>
