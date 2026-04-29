@extends('layouts.admin')

@section('content')

{{-- HEADER --}}
<div class="mt-6 flex items-start justify-between">
    <div>
        <h1 class="text-3xl font-semibold">Edit Product</h1>
        <p class="text-sm text-stone-500">Update product information</p>
    </div>

    <a href="/admin/products"
       class="w-9 h-9 flex items-center justify-center rounded-full hover:bg-stone-200 text-stone-500 text-lg">
        ✕
    </a>
</div>

{{-- FORM --}}
<form action="/admin/products/1/update" method="POST" enctype="multipart/form-data">

    @csrf

    {{-- CONTAINER --}}
    <div class="mt-6 bg-white rounded-2xl shadow border p-6 max-w-5xl">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- IMAGE UPLOAD --}}
            <div>

                <label class="block text-sm font-medium mb-2">Product Image</label>

                <div class="relative border rounded-xl bg-stone-100 h-80 flex items-center justify-center overflow-hidden cursor-pointer">

                    {{-- PREVIEW --}}
                    <img id="previewImage"
                        src="https://images.unsplash.com/photo-1542060748-10c28b62716b"
                        class="object-cover h-full w-full">

                    {{-- OVERLAY --}}
                    <div class="absolute inset-0 flex items-center justify-center bg-black/30 text-white text-sm opacity-0 hover:opacity-100 transition">
                        Click to change image
                    </div>

                    {{-- INPUT --}}
                    <input type="file"
                        name="image"
                        id="imageInput"
                        class="absolute inset-0 opacity-0 cursor-pointer"
                        onchange="previewFile()">
                </div>

            </div>

            {{-- FORM RIGHT --}}
            <div class="md:col-span-2 space-y-4">

                {{-- NAME --}}
                <div>
                    <label class="text-sm font-medium">Product Name</label>
                    <input type="text"
                        name="name"
                        value="Vintage Jacket"
                        class="w-full border rounded-lg p-2 mt-1">
                </div>

                {{-- CATEGORY & STATUS --}}
                <div class="grid grid-cols-2 gap-4">

                    <div>
                        <label class="text-sm font-medium">Category</label>
                        <select name="category" class="w-full border rounded-lg p-2 mt-1">
                            <option>Outerwear</option>
                            <option>Tops</option>
                            <option>Bottoms</option>
                            <option>Accessories</option>
                            <option>Shoes</option>
                        </select>
                    </div>

                    <div>
                        <label class="text-sm font-medium">Status</label>
                        <select name="status" class="w-full border rounded-lg p-2 mt-1">
                            <option>Active</option>
                            <option>Sold</option>
                            <option>Draft</option>
                        </select>
                    </div>

                </div>

                {{-- PRICE --}}
                <div>
                    <label class="text-sm font-medium">Price</label>
                    <input type="number"
                        name="price"
                        value="145"
                        class="w-full border rounded-lg p-2 mt-1">
                </div>

                {{-- DESCRIPTION --}}
                <div>
                    <label class="text-sm font-medium">Description</label>
                    <textarea name="description"
                        class="w-full border rounded-lg p-2 mt-1 h-28">Vintage jacket high quality</textarea>
                </div>

            </div>

        </div>

        {{-- FOOTER --}}
        <div class="flex justify-end gap-3 mt-8 border-t pt-6">

            <a href="/admin/products"
                class="px-4 py-2 border rounded-lg">
                Cancel
            </a>

            <button type="submit"
                class="bg-purple-900 text-white px-6 py-2 rounded-lg">
                Save Changes
            </button>

        </div>

    </div>

</form>

{{-- IMAGE PREVIEW SCRIPT --}}
<script>
function previewFile() {
    const file = document.getElementById("imageInput").files[0];
    const preview = document.getElementById("previewImage");

    if (file) {
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
        }

        reader.readAsDataURL(file);
    }
}
</script>

@endsection