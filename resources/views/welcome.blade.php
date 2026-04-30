<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vintage Archive</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-stone-50 text-stone-950 antialiased">
    <div class="mx-auto flex min-h-screen max-w-7xl flex-col px-4 py-4 sm:px-6 lg:px-8">
        @include('partials.header', ['cartCount' => $cartCount ?? 0, 'active' => 'home'])

        <main class="flex-1">
            <section class="relative mt-6 overflow-hidden rounded-4xl border border-stone-200 bg-stone-900 text-white shadow-2xl">
                <div class="absolute inset-0">
                    @if(isset($featuredCollections[0]))
    <img src="{{ $featuredCollections[0]['image'] }}">
@endif
                    <div class="absolute inset-0 bg-linear-to-t from-stone-950 via-stone-950/50 to-stone-950/10"></div>
                </div>
                <div class="relative grid min-h-136 items-end p-8 sm:p-12 lg:grid-cols-[1.2fr_0.8fr] lg:p-14">
                    <div class="max-w-2xl">
                        <p class="mb-4 text-xs uppercase tracking-[0.4em] text-stone-300">Curated archive</p>
                        <h1 class="max-w-xl text-5xl font-semibold tracking-tight sm:text-6xl lg:text-7xl">Pieces with a past, styled for now.</h1>
                        <p class="mt-5 max-w-xl text-sm leading-7 text-stone-200 sm:text-base">Discover one-of-a-kind vintage clothing and accessories sourced for the thrift customer who wants a sharper selection, cleaner presentation, and better detail at a glance.</p>
                        <div class="mt-8 flex flex-wrap gap-3">
                            <a href="{{ route('catalog') }}" class="inline-flex items-center justify-center rounded-full bg-white px-6 py-3 text-sm font-semibold text-stone-950 transition hover:bg-stone-200">Explore the catalog</a>
                            <a href="#collections" class="inline-flex items-center justify-center rounded-full border border-white/25 px-6 py-3 text-sm font-semibold text-white transition hover:bg-white/10">View featured picks</a>
                        </div>
                    </div>
                    <div class="mt-8 lg:mt-0 lg:justify-self-end">
                        <div class="max-w-sm rounded-[1.75rem] border border-white/15 bg-white/10 p-5 backdrop-blur">
                            <p class="text-xs uppercase tracking-[0.35em] text-stone-300">Archive note</p>
                            <div class="mt-4 space-y-3 text-sm text-stone-200">
                                <p>• Handpicked outerwear, tops, bottoms, and accessories.</p>
                                <p>• Local image assets from <span class="font-medium text-white">resources/images</span>.</p>
                                <p>• Designed for a polished catalog-first storefront.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="collections" class="mt-10">
                <div class="flex items-end justify-between gap-4 border-b border-stone-200 pb-4">
                    <div>
                        <p class="text-xs uppercase tracking-[0.35em] text-stone-500">Featured collections</p>
                        <h2 class="mt-2 text-3xl font-semibold tracking-tight text-stone-950">New arrivals with editorial treatment</h2>
                    </div>
                    <a href="{{ route('catalog') }}" class="text-sm font-medium text-stone-600 transition hover:text-stone-950">View all</a>
                </div>

                <div class="mt-6 grid gap-5 lg:grid-cols-3">
                    @foreach ($featuredCollections as $item)
                        <article class="group overflow-hidden rounded-3xl border border-stone-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                            <div class="aspect-4/5 overflow-hidden bg-stone-100">
                                <img src="{{ asset($item->primary_image_path) }}" alt="{{ $item->name }}" class="h-full w-full object-cover transition duration-700 group-hover:scale-105">
                            </div>
                            <div class="p-5">
                                <p class="text-xs uppercase tracking-[0.3em] text-stone-500">{{ $item->category ?: 'Archive' }}</p>
                                <div class="mt-2 flex items-start justify-between gap-4">
                                    <h3 class="text-lg font-semibold text-stone-950">{{ $item->name }}</h3>
                                    <span class="shrink-0 text-sm font-medium text-stone-500">${{ number_format((float) $item->price, 0) }}</span>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>

            <section class="mt-10 grid items-start gap-4 rounded-4xl border border-stone-200 bg-white p-4 lg:grid-cols-[0.8fr_1.2fr] lg:p-5">
                <div class="lg:max-w-sm">
                    <div class="rounded-3xl bg-stone-950 p-4 text-white">
                        <p class="text-xs uppercase tracking-[0.35em] text-stone-400">Why this format</p>
                        <h2 class="mt-2 text-xl font-semibold tracking-tight">Built for thrift discovery.</h2>
                        <p class="mt-2 max-w-sm text-sm leading-6 text-stone-300">Home menonjolkan mood dan trust, sementara katalog fokus ke filter dan keputusan beli.</p>
                        <a href="{{ route('catalog') }}" class="mt-4 inline-flex rounded-full bg-white px-4 py-2 text-sm font-semibold text-stone-950 transition hover:bg-stone-200">Open catalog</a>
                    </div>
                </div>

                <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($spotlightItems as $item)
                        <article class="overflow-hidden rounded-3xl border border-stone-200 bg-stone-50">
                            <div class="aspect-3/4 overflow-hidden">
                                <img src="{{ asset($item->primary_image_path) }}" alt="{{ $item->name }}" class="h-full w-full object-cover">
                            </div>
                            <div class="p-3">
                                <p class="text-[11px] uppercase tracking-[0.3em] text-stone-500">{{ $item->category ?: 'Archive' }}</p>
                                <div class="mt-1.5 flex items-start justify-between gap-3">
                                    <h3 class="text-sm font-semibold text-stone-950">{{ $item->name }}</h3>
                                    <span class="shrink-0 text-xs text-stone-600">${{ number_format((float) $item->price, 0) }}</span>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
        </main>

        @include('partials.footer')
    </div>
</body>
</html>
