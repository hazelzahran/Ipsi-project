<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Cart - VINTAGE</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="mb-4">Your Cart</h2>
    <div class="row">
        <!-- Cart Items -->
        <div class="col-md-8">
            @foreach($items as $item)
                <div class="card mb-3 {{ $item['selected'] ? '' : 'opacity-50' }}">
                    <div class="row g-0 align-items-center">
                        <div class="col-auto">
                            @if (!empty($item['product']->primary_image_path))
                                <img src="{{ asset($item['product']->primary_image_path) }}" alt="{{ $item['product']->name }}" class="img-fluid rounded-start" style="width: 140px; height: 140px; object-fit: cover;">
                            @else
                                <div class="d-flex align-items-center justify-content-center bg-secondary text-white rounded-start" style="width: 140px; height: 140px;">
                                    No Image
                                </div>
                            @endif
                        </div>
                        <div class="col">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <h5>{{ $item['product']->name }}</h5>
                                    <p class="mb-1">Size: {{ $item['product']->size }} | Condition: {{ $item['product']->condition }}</p>
                                    <p class="mb-0 text-muted">Qty: {{ $item['quantity'] }}</p>
                                </div>
                                <div>
                                    <strong>${{ number_format($item['product']->price * max(1, $item['quantity']), 2) }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Order Summary -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Order Summary
                </div>
                <div class="card-body">
                    <p>Subtotal ({{ $selectedItemsCount }} items): ${{ number_format($subtotal, 2) }}</p>
                    <p>Estimated Shipping: ${{ number_format($shipping, 2) }}</p>
                    <p><strong>Total: ${{ number_format($total, 2) }}</strong></p>
                    <p class="text-muted">Taxes calculated at checkout</p>
                    <button class="btn btn-primary w-100">Checkout Now</button>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="text-center mt-5">
    <small>© 2024 VINTAGE THRIFT. ALL RIGHTS RESERVED.</small>
</footer>

</body>
</html>
