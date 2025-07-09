<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Tambah Metode Pembayaran
        </h2>
    </x-slot>

    <div class="py-8 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-200">
            @if ($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 p-4 rounded">
                    <ul class="list-disc pl-5 space-y-1 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('payment-methods.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-medium mb-1">Nama Metode</label>
                    <input type="text" name="name" id="name" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200"
                        placeholder="Contoh: Bank Transfer, OVO, DANA" value="{{ old('name') }}">
                </div>

                <div class="mb-4">
                    <label for="account_number" class="block text-gray-700 font-medium mb-1">Nomor Rekening (Opsional)</label>
                    <input type="text" name="account_number" id="account_number"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200"
                        placeholder="Masukkan nomor rekening jika ada" value="{{ old('account_number') }}">
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-medium mb-1">Deskripsi (Opsional)</label>
                    <textarea name="description" id="description" rows="3"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200"
                        placeholder="Contoh: Pembayaran melalui bank BCA atas nama PT. XYZ">{{ old('description') }}</textarea>
                </div>

                <div class="flex justify-start mt-6">
                    <a href="{{ route('payment-methods.index') }}"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 transition mr-3">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</x-app-layout>
