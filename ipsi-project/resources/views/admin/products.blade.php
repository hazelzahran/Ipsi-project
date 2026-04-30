@extends('layouts.admin')

@section('content')

<div x-data="{ 
    showFilter: false, 
    search: '',
    selectedCategory: 'All',
    selectedStatus: 'All',
    products: [
        {id: 1, name: 'Vintage Camel Wool Coat', cat: 'Outerwear', price: 185.00, size: 'L', status: 'active', img: 'https://images.unsplash.com/photo-1591047139829-d91aecb6caea?q=80&w=150'},
        {id: 2, name: 'Minimalist White Sneakers', cat: 'Footwear', price: 120.00, size: '42', status: 'active', img: 'https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=150'},
        {id: 3, name: 'Leather Messenger Bag', cat: 'Accessories', price: 95.00, size: 'OS', status: 'draft', img: 'https://images.unsplash.com/photo-1548036328-c9fa89d128fa?q=80&w=150'},
        {id: 4, name: 'Classic Denim Jacket', cat: 'Outerwear', price: 75.00, size: 'M', status: 'active', img: 'https://images.unsplash.com/photo-1551537482-f2075a1d41f2?q=80&w=150'},
        {id: 5, name: 'Silk Floral Scarf', cat: 'Accessories', price: 45.00, size: 'OS', status: 'active', img: 'https://images.unsplash.com/photo-1584917865442-de89df76afd3?q=80&w=150'},
    ],
    get filteredProducts() {
        return this.products.filter(p => {
            const matchSearch = p.name.toLowerCase().includes(this.search.toLowerCase());
            const matchCat = this.selectedCategory === 'All' || p.cat === this.selectedCategory;
            const matchStatus = this.selectedStatus === 'All' || p.status === this.selectedStatus;
            return matchSearch && matchCat && matchStatus;
        });
    }
}">
    {{-- TITLE SECTION --}}
    <div class="mb-8">
        <div class="flex justify-between items-end">
            <div>
                <h1 class="text-3xl font-bold text-[#2D1B4E] tracking-tight">Products Management</h1>
                <p class="text-sm text-stone-500 mt-1">Manage and curate your high-end thrift inventory.</p>
            </div>
            <div class="flex gap-3 relative">
                <button @click="showFilter = !showFilter" :class="showFilter ? 'bg-stone-100 border-stone-400' : 'bg-white'" class="px-5 py-2.5 border border-stone-200 rounded-xl text-sm font-semibold text-stone-600 hover:bg-stone-50 transition flex items-center gap-2 shadow-sm">
                    <i class="fas fa-sliders-h text-stone-400"></i> Filter
                </button>

                <div x-show="showFilter" @click.away="showFilter = false" x-transition class="absolute top-14 right-44 w-72 bg-white border border-stone-100 shadow-2xl rounded-2xl z-50 p-5">
                    <h4 class="text-xs font-bold text-stone-900 mb-4 uppercase tracking-widest">Filter Options</h4>
                    <div class="space-y-4">
                        <div>
                            <label class="text-[10px] font-bold text-stone-400 uppercase tracking-widest">Category</label>
                            <select x-model="selectedCategory" class="mt-1 w-full border-stone-200 rounded-lg text-xs focus:ring-[#2D1B4E]">
                                <option value="All">All Categories</option>
                                <option value="Outerwear">Outerwear</option>
                                <option value="Footwear">Footwear</option>
                                <option value="Accessories">Accessories</option>
                            </select>
                        </div>
                        <div>
                            <label class="text-[10px] font-bold text-stone-400 uppercase tracking-widest">Status</label>
                            <select x-model="selectedStatus" class="mt-1 w-full border-stone-200 rounded-lg text-xs focus:ring-[#2D1B4E]">
                                <option value="All">All Status</option>
                                <option value="active">Active</option>
                                <option value="draft">Draft</option>
                            </select>
                        </div>
                    </div>
                </div>

                <a href="/admin/add-product" class="px-5 py-2.5 bg-[#2D1B4E] text-white rounded-xl text-sm font-semibold hover:bg-[#1f1235] transition flex items-center gap-2 shadow-lg shadow-purple-900/20">
                    <i class="fas fa-plus"></i> Add New Product
                </a>
            </div>
        </div>
    </div>

    {{-- STATS CARDS --}}
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4 mb-10">
        <div class="bg-white p-6 rounded-3xl border border-stone-100 shadow-sm relative overflow-hidden">
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 bg-purple-50 rounded-xl flex items-center justify-center text-[#2D1B4E]">
                    <i class="fas fa-box"></i>
                </div>
                <span class="text-[10px] font-bold text-green-500 bg-green-50 px-2 py-1 rounded-lg">+12%</span>
            </div>
            <p class="text-xs font-semibold text-stone-400 uppercase tracking-wider">Total Products</p>
            <p class="text-2xl font-black text-stone-900 mt-1">1,284</p>
        </div>

        <div class="bg-white p-6 rounded-3xl border border-stone-100 shadow-sm relative overflow-hidden">
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 bg-orange-50 rounded-xl flex items-center justify-center text-orange-600">
                    <i class="fas fa-tag"></i>
                </div>
                <span class="text-[10px] font-bold text-red-500 bg-red-50 px-2 py-1 rounded-lg">-2%</span>
            </div>
            <p class="text-xs font-semibold text-stone-400 uppercase tracking-wider">Avg. Price</p>
            <p class="text-2xl font-black text-stone-900 mt-1">$145.20</p>
        </div>

        <div class="bg-white p-6 rounded-3xl border border-stone-100 shadow-sm relative overflow-hidden">
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600">
                    <i class="fas fa-certificate"></i>
                </div>
                <span class="text-[10px] font-bold text-green-500 bg-green-50 px-2 py-1 rounded-lg">+5%</span>
            </div>
            <p class="text-xs font-semibold text-stone-400 uppercase tracking-wider">Active</p>
            <p class="text-2xl font-black text-stone-900 mt-1">942</p>
        </div>

        <div class="bg-white p-6 rounded-3xl border border-stone-100 shadow-sm relative overflow-hidden">
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 bg-stone-100 rounded-xl flex items-center justify-center text-stone-600">
                    <i class="fas fa-history"></i>
                </div>
            </div>
            <p class="text-xs font-semibold text-stone-400 uppercase tracking-wider">Sold</p>
            <p class="text-2xl font-black text-stone-900 mt-1">342</p>
        </div>
    </div>

    {{-- INVENTORY TABLE --}}
    <div class="bg-white rounded-[2rem] border border-stone-100 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-stone-50 bg-stone-50/30">
            <div class="relative max-w-md">
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-stone-400 text-sm"></i>
                <input x-model="search" type="text" placeholder="Search..." 
                    class="w-full pl-12 pr-4 py-3 bg-white border border-stone-200 rounded-2xl text-sm focus:ring-2 focus:ring-purple-500/10 focus:border-[#2D1B4E] transition shadow-sm">
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-[10px] font-bold text-stone-400 uppercase tracking-[0.15em] bg-white">
                    <tr>
                        <th class="px-8 py-5">Product Details</th>
                        <th class="px-6 py-5">Category</th>
                        <th class="px-6 py-5 text-center">Size</th>
                        <th class="px-6 py-5">Price</th>
                        <th class="px-6 py-5 text-center">Status</th>
                        <th class="px-8 py-5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-50">
                    <template x-for="p in filteredProducts" :key="p.id">
                        <tr class="hover:bg-stone-50/50 transition group">
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-4">
                                    <div class="w-14 h-14 rounded-2xl bg-stone-100 overflow-hidden border border-stone-100 flex-shrink-0 shadow-sm">
                                        <img :src="p.img" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                    </div>
                                    <div>
                                        <p class="font-bold text-stone-900 group-hover:text-[#2D1B4E] transition leading-tight" x-text="p.name"></p>
                                        <p class="text-[10px] text-stone-400 font-mono mt-1 uppercase tracking-tighter" x-text="'SKU: PROD-' + (1000 + p.id)"></p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <span class="px-3 py-1 bg-stone-100 text-stone-600 rounded-lg text-[10px] font-bold uppercase tracking-wider" x-text="p.cat"></span>
                            </td>
                            <td class="px-6 py-5 text-center font-semibold text-stone-600 uppercase" x-text="p.size"></td>
                            <td class="px-6 py-5 font-black text-[#2D1B4E]" x-text="'$' + p.price.toFixed(2)"></td>
                            <td class="px-6 py-5 text-center">
                                <span :class="p.status === 'active' ? 'bg-green-50 text-green-600' : 'bg-orange-50 text-orange-600'" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-bold uppercase">
                                    <span :class="p.status === 'active' ? 'bg-green-500 shadow-[0_0_5px_rgba(34,197,94,0.5)]' : 'bg-orange-500'" class="w-1.5 h-1.5 rounded-full"></span> 
                                    <span x-text="p.status"></span>
                                </span>
                            </td>
                            <td class="px-8 py-5 text-right">
                                <div class="flex justify-end gap-2">
                                    <a :href="'/admin/products/' + p.id + '/edit'" class="w-9 h-9 flex items-center justify-center text-stone-400 hover:text-[#2D1B4E] hover:bg-purple-50 rounded-xl transition duration-300">
                                        <i class="fas fa-edit text-sm"></i>
                                    </a>
                                    <button class="w-9 h-9 flex items-center justify-center text-stone-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition duration-300">
                                        <i class="fas fa-trash-alt text-sm"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>

        {{-- PAGINATION SECTION (Dikecilkan sizenya sesuai image_1cac60.png) --}}
        <div class="px-8 py-5 border-t border-stone-50 flex items-center justify-between">
            {{-- Text di kiri dikecilkan (text-[11px] atau text-xs) --}}
            <p class="text-[11px] text-stone-400 font-medium tracking-wide">
                Showing 1 to 10 of <span class="text-stone-700">1,284</span> products
            </p>
            
            {{-- Tombol pagination dikecilkan (w-7 h-7) --}}
            <div class="flex items-center gap-1.5">
                <button class="w-7 h-7 flex items-center justify-center border border-stone-200 rounded-full text-stone-400 hover:bg-stone-50 transition">
                    <i class="fas fa-chevron-left text-[9px]"></i>
                </button>
                <button class="w-7 h-7 flex items-center justify-center bg-[#2D1B4E] text-white rounded-full text-[10px] font-bold shadow-md">1</button>
                <button class="w-7 h-7 flex items-center justify-center text-stone-500 hover:bg-stone-50 rounded-full text-[10px] font-bold transition">2</button>
                <button class="w-7 h-7 flex items-center justify-center text-stone-500 hover:bg-stone-50 rounded-full text-[10px] font-bold transition">3</button>
                <span class="text-stone-300 text-[10px] px-0.5">...</span>
                <button class="w-7 h-7 flex items-center justify-center text-stone-500 hover:bg-stone-50 rounded-full text-[10px] font-bold transition">129</button>
                <button class="w-7 h-7 flex items-center justify-center border border-stone-200 rounded-full text-stone-400 hover:bg-stone-50 transition">
                    <i class="fas fa-chevron-right text-[9px]"></i>
                </button>
            </div>
        </div>
    </div>

    {{-- FOOTER SECTION --}}
    <footer class="mt-12 mb-8 flex flex-col md:flex-row justify-between items-center border-t border-stone-100 pt-8 gap-4">
        <p class="text-xs text-stone-400 font-medium">
            © 2024 Curated Modern Thrift Admin. All items undergo mandatory authentication.
        </p>
        <div class="flex items-center gap-6">
            <a href="#" class="text-xs text-stone-400 hover:text-[#2D1B4E] font-semibold transition">Privacy Policy</a>
            <a href="#" class="text-xs text-stone-400 hover:text-[#2D1B4E] font-semibold transition">Terms of Service</a>
            <a href="#" class="text-xs text-stone-400 hover:text-[#2D1B4E] font-semibold transition">Support</a>
        </div>
    </footer>
</div>

<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection