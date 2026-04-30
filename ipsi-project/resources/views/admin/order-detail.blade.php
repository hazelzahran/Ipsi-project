@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-4xl mx-auto">
    <div class="mb-6 flex items-center gap-4">
        <a href="/admin/orders" class="text-stone-500 hover:text-stone-900 text-xl">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h2 class="text-2xl font-bold text-stone-900">Order Detail #ORD-2024-8812</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Informasi Customer -->
        <div class="md:col-span-2 space-y-6">
            <div class="bg-white p-6 rounded-2xl border border-stone-200 shadow-sm">
                <h3 class="font-bold mb-4 text-stone-900">Items Ordered</h3>
                <div class="space-y-4">
                    <!-- Item 1 -->
                    <div class="flex items-center justify-between border-b border-stone-100 pb-4">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 bg-stone-100 rounded-lg overflow-hidden">
                                <img src="https://via.placeholder.com/150" class="object-cover w-full h-full">
                            </div>
                            <div>
                                <p class="font-bold text-stone-900">Vintage Leather Jacket</p>
                                <p class="text-sm text-stone-500">Size: L | Qty: 1</p>
                            </div>
                        </div>
                        <p class="font-bold text-stone-900">$840.00</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-stone-200 shadow-sm">
                <h3 class="font-bold mb-4 text-stone-900">Shipping Address</h3>
                <p class="text-stone-600 text-sm leading-relaxed">
                    Elena Rodriguez<br>
                    Jl. Vintage Raya No. 123, Heritage District<br>
                    Jakarta Selatan, 12345<br>
                    Indonesia
                </p>
            </div>
        </div>

        <!-- Ringkasan Pembayaran -->
        <div class="md:col-span-1 space-y-6">
            <div class="bg-white p-6 rounded-2xl border border-stone-200 shadow-sm">
                <h3 class="font-bold mb-4 text-stone-900">Order Summary</h3>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between text-stone-500">
                        <span>Subtotal</span>
                        <span>$1,200.00</span>
                    </div>
                    <div class="flex justify-between text-stone-500">
                        <span>Shipping</span>
                        <span>$40.00</span>
                    </div>
                    <div class="border-t border-stone-100 pt-2 flex justify-between font-bold text-lg text-stone-900">
                        <span>Total</span>
                        <span>$1,240.00</span>
                    </div>
                </div>
                <button class="w-full mt-6 bg-stone-900 text-white py-2 rounded-xl text-sm font-medium hover:bg-stone-800 transition">
                    Update Status
                </button>
            </div>
        </div>
    </div>
</div>
@endsection