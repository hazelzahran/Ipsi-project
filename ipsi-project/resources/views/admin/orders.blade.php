
@extends('layouts.admin')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-stone-900">Orders Management</h2>
            <p class="text-stone-500 text-sm">Review and manage curated vintage acquisitions.</p>
        </div>
        <div class="flex gap-2">
            <button class="px-4 py-2 bg-white border border-stone-200 rounded-lg text-sm flex items-center gap-2">
                <i class="fas fa-filter"></i> Filter
            </button>
            <button class="px-4 py-2 bg-white border border-stone-200 rounded-lg text-sm flex items-center gap-2">
                <i class="fas fa-download"></i> Export
            </button>
        </div>
    </div>

    

    <!-- Search Bar -->
    <div class="mb-6">
        <div class="relative max-w-md">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-stone-400">
                <i class="fas fa-search"></i>
            </span>
            <input type="text" class="block w-full pl-10 pr-3 py-2 border border-stone-200 rounded-xl leading-5 bg-white placeholder-stone-400 focus:outline-none focus:ring-1 focus:ring-stone-500 sm:text-sm" placeholder="Search Order ID or Customer...">
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl border border-stone-200 overflow-hidden shadow-sm">
        <table class="min-w-full divide-y divide-stone-200">
            <thead class="bg-stone-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-stone-500 uppercase tracking-wider">Order ID</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-stone-500 uppercase tracking-wider">Customer</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-stone-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-stone-500 uppercase tracking-wider">Total</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-stone-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-stone-500 uppercase tracking-wider text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-stone-200">
                <!-- Contoh Data Satuan -->
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-stone-900">#ORD-2024-8812</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="h-8 w-8 rounded-full bg-stone-100 flex items-center justify-center text-xs font-bold text-stone-600">ER</div>
                            <div class="ml-3">
                                <div class="text-sm font-medium text-stone-900">Elena Rodriguez</div>
                                <div class="text-xs text-stone-500">elena.r@example.com</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-stone-500">Oct 24, 2023</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-stone-900">$1,240.00</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">On Progress</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex justify-end gap-3">
                            <button class="text-stone-400 hover:text-stone-600"><i class="fas fa-edit"></i></button>
                            <!-- LINK MENUJU DETAIL -->
                            <a href="/admin/orders/detail" class="text-stone-400 hover:text-stone-900">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <!-- Ulangi baris di atas untuk data lainnya -->
            </tbody>
        </table>
    </div>
</div>
@endsection