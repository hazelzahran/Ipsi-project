<header class="flex items-center justify-between border-b border-stone-200 pb-4">
    <a href="{{ route('home') }}" class="tracking-[0.35em] text-sm font-semibold uppercase text-stone-900">Vintage</a>

    <nav class="flex items-center gap-2 text-sm text-stone-600">
        <a href="{{ route('catalog') }}" class="rounded-full px-3 py-2 transition hover:bg-stone-900 hover:text-white {{ ($active ?? '') === 'catalog' ? 'bg-stone-900 text-white' : '' }}">Catalog</a>
        <a href="{{ route('cart') }}" class="relative rounded-full px-3 py-2 transition hover:bg-stone-900 hover:text-white {{ ($active ?? '') === 'cart' ? 'bg-stone-900 text-white' : '' }}">
            Cart
            @if (($cartCount ?? 0) > 0)
                <span class="ml-1 inline-flex min-w-5 items-center justify-center rounded-full bg-stone-900 px-1.5 text-[11px] font-semibold text-white {{ ($active ?? '') === 'cart' ? 'bg-white text-stone-900' : '' }}">
                    {{ $cartCount }}
                </span>
            @endif
        </a>
    </nav>
</header>
