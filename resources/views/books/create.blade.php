<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">Tambah Buku</h2>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto sm:px-6 lg:px-8">
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

            <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Judul Buku</label>
                        <input type="text" name="title" value="{{ old('title') }}" required
                            class="w-full px-4 py-2 border rounded">
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Pengarang</label>
                        <input type="text" name="pengarang" value="{{ old('pengarang') }}" required
                            class="w-full px-4 py-2 border rounded">
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Kategori</label>
                        <select name="category_id" required class="w-full px-4 py-2 border rounded">
                            <option value="">Pilih kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Tanggal Terbit</label>
                        <input type="date" name="tgl_terbit" value="{{ old('tgl_terbit') }}" required
                            class="w-full px-4 py-2 border rounded">
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Harga</label>
                        <input type="number" name="price" value="{{ old('price') }}" required
                            class="w-full px-4 py-2 border rounded">
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Rating (0–5)</label>
                        <input type="number" name="rating" step="0.1" min="0" max="5"
                            value="{{ old('rating') }}"
                            class="w-full px-4 py-2 border rounded">
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Upload Gambar (jpg, png)</label>
                        <input type="file" name="image" accept="image/*" class="w-full px-4 py-2 border rounded">
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Upload File Buku (PDF)</label>
                        <input type="file" name="file" accept=".pdf" class="w-full px-4 py-2 border rounded">
                    </div>
                </div>

                <div class="mt-4">
                    <label class="block font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="description" rows="4"
                        class="w-full px-4 py-2 border rounded">{{ old('description') }}</textarea>
                </div>

                <div class="flex justify-start mt-6">
                    <a href="{{ route('books.index') }}"
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
