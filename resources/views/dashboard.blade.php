<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
            <!-- Total Kategori -->
            <div class="bg-white rounded-xl shadow p-6 border border-gray-200">
                <div class="text-sm text-gray-500">Total Kategori</div>
                <div class="text-2xl font-bold text-blue-600 mt-2">{{ $totalCategories }}</div>
            </div>

            <!-- Total Dekorasi -->
            <div class="bg-white rounded-xl shadow p-6 border border-gray-200">
                <div class="text-sm text-gray-500">Total Dekorasi</div>
                <div class="text-2xl font-bold text-purple-600 mt-2">{{ $totalDekorins }}</div>
            </div>

            <!-- Total Transaksi -->
            <div class="bg-white rounded-xl shadow p-6 border border-gray-200">
                <div class="text-sm text-gray-500">Total Transaksi</div>
                <div class="text-2xl font-bold text-yellow-600 mt-2">{{ $totalTransactions }}</div>
            </div>

            <!-- Total Pengguna -->
            <div class="bg-white rounded-xl shadow p-6 border border-gray-200">
                <div class="text-sm text-gray-500">Total Pengguna</div>
                <div class="text-2xl font-bold text-red-600 mt-2">{{ $totalUsers }}</div>
            </div>
        </div>
    </div>

<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</x-app-layout>
