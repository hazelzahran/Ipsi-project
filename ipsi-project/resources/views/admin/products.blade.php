@extends('layouts.admin')

@section('content')

{{-- TITLE --}}
<div>
    <h1 class="text-3xl font-semibold">Products Management</h1>
    <p class="text-sm text-stone-500">Manage your inventory</p>
</div>

{{-- STATS --}}
<div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">

    <div class="bg-white p-4 rounded-xl shadow border">
        <p class="text-sm text-stone-500">Total Products</p>
        <p class="text-xl font-bold">1,284</p>
    </div>

    <div class="bg-white p-4 rounded-xl shadow border">
        <p class="text-sm text-stone-500">Avg Price</p>
        <p class="text-xl font-bold">$145</p>
    </div>

    <div class="bg-white p-4 rounded-xl shadow border">
        <p class="text-sm text-stone-500">Active</p>
        <p class="text-xl font-bold text-green-600">942</p>
    </div>

    <div class="bg-white p-4 rounded-xl shadow border">
        <p class="text-sm text-stone-500">Sold</p>
        <p class="text-xl font-bold">342</p>
    </div>

</div>

{{-- ACTION BAR --}}
<div class="mt-6 flex justify-between items-center">

    <input type="text"
        placeholder="Search product..."
        class="border rounded-lg px-4 py-2 w-64">

    <a href="/admin/add-product"
        class="bg-purple-600 text-white px-4 py-2 rounded-lg">
        + Add Product
    </a>

</div>

{{-- TABLE --}}
<div class="mt-4 bg-white rounded-xl shadow border overflow-hidden">

    <table class="w-full text-sm text-left">

        <thead class="bg-stone-100">
            <tr>
                <th class="p-3">Product</th>
                <th class="p-3">Category</th>
                <th class="p-3">Size</th>
                <th class="p-3">Price</th>
                <th class="p-3">Status</th>
                <th class="p-3 text-center">Action</th>
            </tr>
        </thead>

        <tbody>

            {{-- ROW 1 --}}
            <tr class="border-t hover:bg-stone-50">

                {{-- PRODUCT --}}
                <td class="p-3">
                    <div class="flex items-center gap-3">
                        <img src="https://images.unsplash.com/photo-1542060748-10c28b62716b"
                             class="w-10 h-10 rounded object-cover">

                        <span>Vintage Jacket</span>
                    </div>
                </td>

                <td class="p-3">Outerwear</td>
                <td class="p-3">L</td>
                <td class="p-3">$145</td>

                <td class="p-3 text-green-600 font-medium">
                    Active
                </td>

                {{-- ACTION --}}
                <td class="p-3 text-center">
                    <a href="/admin/products/1/edit"
                        class="px-3 py-1 border rounded-lg hover:bg-stone-100 text-sm">
                        Edit
                    </a>
                </td>

            </tr>

        </tbody>

    </table>

</div>

@endsection