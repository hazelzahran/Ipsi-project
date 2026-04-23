<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Awaiting Payment - Vintage Archive</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-stone-50 text-stone-950 antialiased">
    <div class="mx-auto flex min-h-screen max-w-7xl flex-col px-4 py-4 sm:px-6 lg:px-8">
        @include('partials.header', ['cartCount' => $cartCount ?? 0, 'active' => 'cart'])

        <main class="mt-8 flex-1">
            <section class="mx-auto max-w-2xl">
                <div class="rounded-xl bg-[#2f0a4f] px-4 py-3 text-center text-sm font-medium text-white">Items reserved for 14:59 minutes</div>

                <article class="mt-4 rounded-3xl border border-stone-200 bg-white p-5">
                    <h1 class="text-4xl font-semibold tracking-tight">Awaiting Payment</h1>
                    <p class="mt-2 text-sm text-stone-500">Your order is confirmed. Please complete the transfer to finalize your purchase.</p>

                    <div class="mt-4 rounded-2xl bg-stone-100 p-5 text-center">
                        <p class="text-xs uppercase tracking-[0.3em] text-stone-500">Total Amount Due</p>
                        <p class="mt-2 text-6xl font-bold text-[#2f0a4f]">${{ number_format($total, 2) }}</p>
                    </div>

                    @if ($method === 'bank')
                        <section class="mt-6">
                            <h2 class="text-xs uppercase tracking-[0.3em] text-stone-500">Your Account Details</h2>
                            <div class="mt-3 grid gap-3 sm:grid-cols-2">
                                <div class="rounded-xl bg-stone-100 p-3">
                                    <p class="text-[11px] uppercase tracking-[0.2em] text-stone-500">Account Name</p>
                                    <p class="mt-1 font-semibold">Alexander Rivers</p>
                                </div>
                                <div class="rounded-xl bg-stone-100 p-3">
                                    <p class="text-[11px] uppercase tracking-[0.2em] text-stone-500">Account Number</p>
                                    <p class="mt-1 font-semibold">xxxx - xxxx - xxxx - xxxx</p>
                                </div>
                            </div>

                            <h3 class="mt-5 text-xs uppercase tracking-[0.3em] text-stone-500">Virtual Account Transfers</h3>
                            <div class="mt-3 space-y-2">
                                @foreach ($vaAccounts as $account)
                                    <div class="flex items-center justify-between rounded-xl border border-stone-200 px-4 py-3">
                                        <div>
                                            <p class="text-[11px] uppercase tracking-[0.2em] text-stone-500">{{ $account['bank'] }} Virtual Account</p>
                                            <p class="mt-1 text-lg font-semibold">{{ $account['number'] }}</p>
                                        </div>
                                        <button class="text-xs font-medium text-stone-600 underline underline-offset-4">Copy</button>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    @else
                        <section class="mt-6 rounded-2xl border border-stone-200 bg-stone-50 p-4">
                            <div class="flex items-center justify-between">
                                <h2 class="text-xs uppercase tracking-[0.3em] text-stone-500">Pay With QRIS</h2>
                                <span class="text-xs">QR</span>
                            </div>

                            <div class="mt-4 mx-auto flex aspect-square w-48 items-center justify-center rounded-2xl border border-stone-300 bg-white p-4">
                                <img src="{{ Vite::asset($items->first()->primary_image_path) }}" alt="QR placeholder" class="h-full w-full rounded-xl object-cover">
                            </div>
                            <p class="mt-3 text-center text-xs text-stone-500">Scan with any supported e-wallet or mobile banking app.</p>
                        </section>
                    @endif

                    <section class="mt-6 border-t border-stone-200 pt-4">
                        <h2 class="text-xs uppercase tracking-[0.3em] text-stone-500">Order Summary</h2>
                        <div class="mt-3 space-y-3">
                            @foreach ($items as $item)
                                <div class="grid grid-cols-[3.25rem_1fr_auto] items-center gap-3">
                                    <div class="aspect-square overflow-hidden rounded-xl bg-stone-100">
                                        <img src="{{ Vite::asset($item->primary_image_path) }}" alt="{{ $item->name }}" class="h-full w-full object-cover">
                                    </div>
                                    <div>
                                        <p class="font-medium leading-tight">{{ $item->name }}</p>
                                        <p class="mt-1 text-xs text-stone-500">${{ number_format((float) $item->price, 2) }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>

                    <div class="mt-6 space-y-2">
                        <a href="{{ route('order.confirmed') }}" class="inline-flex w-full items-center justify-center rounded-xl bg-[#2f0a4f] px-4 py-3 text-sm font-semibold text-white transition hover:bg-[#22073a]">I have transferred</a>
                        <button class="inline-flex w-full items-center justify-center rounded-xl border border-stone-300 px-4 py-3 text-sm text-stone-600 transition hover:border-stone-500">Copy Payment Details</button>
                    </div>
                </article>

                <div class="mt-8 text-center text-sm text-stone-500">
                    Need help with your payment?<br>
                    <a href="#" class="font-medium text-stone-900 underline underline-offset-4">Contact Concierge Support</a>
                </div>
            </section>
        </main>

        @include('partials.footer')
    </div>
</body>
</html>
