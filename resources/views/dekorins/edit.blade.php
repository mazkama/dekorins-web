<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">Edit Dekorasi</h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-300">
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                    <ul class="list-disc pl-5 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('dekorins.update', $dekorin->id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block mb-1 font-medium">Tema</label>
                        <input type="text" name="tema" value="{{ old('tema', $dekorin->tema) }}" required class="w-full border px-4 py-2 rounded">
                    </div>

                    <div>
                        <label class="block mb-1 font-medium">Kategori</label>
                        <select name="category_id" required class="w-full border px-4 py-2 rounded">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $dekorin->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block mb-1 font-medium">Harga</label>
                        <input type="number" name="price" value="{{ old('price', $dekorin->price) }}" class="w-full border px-4 py-2 rounded">
                    </div>

                    <div>
                        <label class="block mb-1 font-medium">Rating</label>
                        <input type="number" name="rating" value="{{ old('rating', $dekorin->rating) }}" step="0.1" class="w-full border px-4 py-2 rounded">
                    </div>

                    <div>
                        <label class="block font-medium mb-1">Gambar Saat Ini</label>
                        @if ($dekorin->image)
                            <img src="{{ asset('storage/' . $dekorin->image) }}" class="h-20 rounded mb-2">
                        @else
                            <p class="text-sm text-gray-500">Tidak ada gambar</p>
                        @endif
                        <input type="file" name="image" accept="image/*" class="w-full px-4 py-2 border rounded">
                    </div>

                    <div>
                        <label class="block font-medium mb-1">File Saat Ini</label>
                        @if ($dekorin->file)
                            <a href="{{ asset('storage/' . $dekorin->file) }}" target="_blank" class="text-sm text-blue-600 underline">Lihat File</a>
                        @else
                            <p class="text-sm text-gray-500">Tidak ada file</p>
                        @endif
                        <input type="file" name="file" accept=".pdf" class="w-full px-4 py-2 border rounded mt-2">
                    </div>
                </div>

                <div class="mt-4">
                    <label class="block mb-1 font-medium">Deskripsi</label>
                    <textarea name="description" rows="4" class="w-full border px-4 py-2 rounded">{{ old('description', $dekorin->description) }}</textarea>
                </div>

                <div class="flex justify-end mt-6">
                    <a href="{{ route('dekorins.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 mr-2">Batal</a>
                    <button type="submit" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">Update</button>
                </div>
            </form>
        </div>
    </div>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</x-app-layout>
