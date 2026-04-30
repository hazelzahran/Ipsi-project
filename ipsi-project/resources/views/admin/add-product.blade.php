@extends('layouts.admin')

@section('content')

{{-- HEADER --}}
<div class="mt-6 flex items-start justify-between">

    <div>
        <h1 class="text-3xl font-semibold">Add New Product</h1>
        <p class="text-sm text-stone-500">Create a new product listing</p>
    </div>

    {{-- CLOSE BUTTON --}}
    <a href="/admin/products"
       class="w-9 h-9 flex items-center justify-center rounded-full hover:bg-stone-200 text-stone-500 hover:text-black text-lg">
        ✕
    </a>

</div>

{{-- FORM CONTAINER --}}
<a href="/admin/products"
   class="absolute top-4 right-4 w-8 h-8 flex items-center justify-center rounded-full hover:bg-stone-100 text-stone-500 hover:text-black">
    ✕
</a>

    {{-- GENERAL INFO --}}
    <div>
        <h2 class="text-lg font-semibold mb-3">General Information</h2>

        <div class="grid gap-4">

            <div>
                <label class="text-sm text-stone-600">Product Name</label>
                <input type="text"
                    class="w-full border rounded-lg p-2 mt-1">
            </div>

            <div>
                <label class="text-sm text-stone-600">Category</label>
                <select class="w-full border rounded-lg p-2 mt-1">
                    <option>Outerwear</option>
                    <option>Tops</option>
                    <option>Bottoms</option>
                </select>
            </div>

        </div>
    </div>

    {{-- DIVIDER --}}
    <div class="border-t my-6"></div>

    {{-- PRICING --}}
    <div>
        <h2 class="text-lg font-semibold mb-3">Pricing & Details</h2>

        <div class="grid gap-4 sm:grid-cols-2">

            <div>
                <label class="text-sm text-stone-600">Price</label>
                <input type="number"
                    class="w-full border rounded-lg p-2 mt-1">
            </div>

            <div>
                <label class="text-sm text-stone-600">Size</label>
                <input type="text"
                    class="w-full border rounded-lg p-2 mt-1">
            </div>

        </div>

        <div class="mt-4">
            <label class="text-sm text-stone-600">Description</label>
            <textarea
                class="w-full border rounded-lg p-2 mt-1"></textarea>
        </div>
    </div>

    {{-- DIVIDER --}}
    <div class="border-t my-6"></div>

    {{-- IMAGE --}}
    <div>
        <h2 class="text-lg font-semibold mb-3">Product Image</h2>

        <input type="file"
            class="w-full border rounded-lg p-2">
    </div>

    {{-- ACTION BUTTON --}}
    <div class="flex justify-end gap-3 mt-8">

        <a href="/admin/products"
            class="px-4 py-2 border rounded-lg">
            Cancel
        </a>

        <button onclick="submitForm()"
            class="bg-purple-600 text-white px-5 py-2 rounded-lg">
            Save Product
        </button>

    </div>

</div>

<script>
function submitForm() {
    alert("Product added (dummy)")
}
</script>

@endsection