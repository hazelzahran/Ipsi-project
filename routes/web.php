<?php

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $homeProducts = Product::query()
        ->where('status', 'available')
        ->where('is_active', true)
        ->latest('id')
        ->take(9)
        ->get();

    return view('welcome', [
        'featuredCollections' => $homeProducts->take(3),
        'spotlightItems' => $homeProducts->slice(3, 6)->values(),
        'cartCount' => 3,
    ]);
})->name('home');




Route::get('/catalog', function (Request $request) {
    $selectedCategories = collect(Arr::wrap($request->input('category', [])))
        ->map(static fn ($value) => trim((string) $value))
        ->filter(static fn ($value) => $value !== '')
        ->unique()
        ->values()
        ->all();

    $selectedSizes = collect(Arr::wrap($request->input('size', [])))
        ->map(static fn ($value) => trim((string) $value))
        ->filter(static fn ($value) => $value !== '')
        ->unique()
        ->values()
        ->all();

    $selectedConditions = collect(Arr::wrap($request->input('condition', [])))
        ->map(static fn ($value) => trim((string) $value))
        ->filter(static fn ($value) => $value !== '')
        ->unique()
        ->values()
        ->all();

    $selected = [
        'search' => trim((string) $request->input('search', '')),
        'category' => $selectedCategories,
        'size' => $selectedSizes,
        'condition' => $selectedConditions,
        'min_price' => trim((string) $request->input('min_price', '')),
        'max_price' => trim((string) $request->input('max_price', '')),
        'sort' => trim((string) $request->input('sort', 'newest')),
    ];

    $query = Product::query()
        ->where('status', 'available')
        ->where('is_active', true);

    if ($selected['search'] !== '') {
        $query->where(function ($searchQuery) use ($selected): void {
            $searchQuery
                ->where('name', 'like', "%{$selected['search']}%")
                ->orWhere('description', 'like', "%{$selected['search']}%");
        });
    }

    $filteredCategories = collect($selected['category'])
        ->reject(static fn ($category) => $category === 'All Clothing')
        ->values()
        ->all();

    if ($filteredCategories !== []) {
        $query->whereIn('category', $filteredCategories);
    }

    if ($selected['size'] !== []) {
        $query->whereIn('size', $selected['size']);
    }

    if ($selected['condition'] !== []) {
        $query->whereIn('condition', $selected['condition']);
    }

    if (is_numeric($selected['min_price'])) {
        $query->where('price', '>=', (float) $selected['min_price']);
    }

    if (is_numeric($selected['max_price'])) {
        $query->where('price', '<=', (float) $selected['max_price']);
    }

    $sortWhitelist = ['newest', 'price_asc', 'price_desc'];

    if (! in_array($selected['sort'], $sortWhitelist, true)) {
        $selected['sort'] = 'newest';
    }

    if ($selected['sort'] === 'price_asc') {
        $query->orderBy('price');
    } elseif ($selected['sort'] === 'price_desc') {
        $query->orderByDesc('price');
    } else {
        $query->latest('id');
    }

    $products = $query->paginate(9)->withQueryString();

    return view('catalog', [
        'filters' => [
            'Category' => ['All Clothing', 'Outerwear', 'Tops', 'Bottoms', 'Accessories', 'Footwear', 'Layering'],
            'Size' => ['XS', 'S', 'M', 'L', 'XL'],
            'Condition' => ['Like New', 'Very Good', 'Pre-Loved'],
        ],
        'selected' => $selected,
        'products' => $products,
        'cartCount' => 3,
    ]);
})->name('catalog');

Route::get('/cart', function () {
    $items = Product::query()
        ->where('status', 'available')
        ->where('is_active', true)
        ->latest('id')
        ->take(3)
        ->get()
        ->map(function (Product $product, int $index) {
            $quantity = $index < 2 ? 1 : 0;

            return [
                'product' => $product,
                'quantity' => $quantity,
                'selected' => $index < 2,
            ];
        });

    $subtotal = $items
        ->filter(fn (array $item) => $item['selected'])
        ->sum(fn (array $item) => (float) $item['product']->price * max(1, $item['quantity']));

    $shipping = $subtotal > 0 ? 12 : 0;

    return view('cart', [
        'items' => $items,
        'cartCount' => $items->count(),
        'selectedItemsCount' => $items->filter(fn (array $item) => $item['selected'])->count(),
        'subtotal' => $subtotal,
        'shipping' => $shipping,
        'total' => $subtotal + $shipping,
    ]);
})->name('cart');

Route::get('/checkout', function () {
    $items = Product::query()
        ->where('status', 'available')
        ->where('is_active', true)
        ->latest('id')
        ->take(2)
        ->get();

    $subtotal = $items->sum(fn (Product $product) => (float) $product->price);
    $shipping = 5;
    $taxes = round($subtotal * 0.085, 2);

    return view('checkout', [
        'items' => $items,
        'cartCount' => 3,
        'subtotal' => $subtotal,
        'shipping' => $shipping,
        'taxes' => $taxes,
        'total' => $subtotal + $shipping + $taxes,
    ]);
})->name('checkout');

Route::get('/payment', function (Request $request) {
    $method = $request->query('method', 'bank');
    $allowedMethods = ['bank', 'qris'];

    if (! in_array($method, $allowedMethods, true)) {
        $method = 'bank';
    }

    $items = Product::query()
        ->where('status', 'available')
        ->where('is_active', true)
        ->latest('id')
        ->take(2)
        ->get();

    $subtotal = $items->sum(fn (Product $product) => (float) $product->price);
    $shipping = 0;

    return view('payment', [
        'method' => $method,
        'items' => $items,
        'cartCount' => 3,
        'total' => $subtotal + $shipping,
        'orderNumber' => 'TF-928410',
        'vaAccounts' => [
            ['bank' => 'BCA', 'number' => '3901 8830 1928'],
            ['bank' => 'BNI', 'number' => '8273 1029 3547'],
            ['bank' => 'BRI', 'number' => '1092 3847 5610'],
            ['bank' => 'BSI', 'number' => '9002 1827 3645'],
        ],
    ]);
})->name('payment');

Route::get('/order/confirmed', function () {
    $items = Product::query()
        ->where('status', 'available')
        ->where('is_active', true)
        ->latest('id')
        ->take(2)
        ->get();

    $subtotal = $items->sum(fn (Product $product) => (float) $product->price);
    $shipping = 25;

    return view('order-confirmed', [
        'items' => $items,
        'cartCount' => 0,
        'orderNumber' => 'TF-928410',
        'subtotal' => $subtotal,
        'shipping' => $shipping,
        'total' => $subtotal + $shipping,
    ]);
})->name('order.confirmed');
