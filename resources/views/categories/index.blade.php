<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Daftar Kategori') }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Tombol Tambah -->
        <a href="{{ route('categories.create') }}"
           class="mb-6 inline-flex items-center gap-2 bg-blue-600 text-white px-5 py-2.5 rounded-lg hover:bg-blue-700 transition shadow">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Kategori
        </a>

        <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-300">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-800 rounded-md shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <table id="datatable" class="min-w-full text-sm text-gray-700 pt-4">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-6 py-3 border">No</th>
                        <th class="px-6 py-3 border">Nama Kategori</th>
                        <th class="px-6 py-3 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-3 border text-center">{{ $loop->iteration }}</td>
                            <td class="px-6 py-3 border">{{ $category->name }}</td>
                            <td class="px-6 py-3 border text-center">
                                <div class="flex justify-center gap-3">
                                    <a href="{{ route('categories.edit', $category->id) }}"
                                       class="px-4 py-1.5 bg-yellow-400 text-white text-sm font-semibold rounded hover:bg-yellow-500 transition">
                                        Edit
                                    </a>
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="px-4 py-1.5 bg-red-500 text-white text-sm font-semibold rounded hover:bg-red-600 transition">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- TailwindCSS --}}
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    {{-- DataTables --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


    <style>
        .dataTables_wrapper .dataTables_length {
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            color: #374151;
        }

        .dataTables_wrapper .dataTables_length select {
            padding: 0.5rem 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            background-color: white;
        }

        .dataTables_wrapper .dataTables_filter {
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            justify-content: end;
            gap: 0.5rem;
            font-size: 0.875rem;
            color: #374151;
        }

        .dataTables_wrapper .dataTables_filter input {
            padding: 0.5rem 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            background-color: white;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.5rem 0.75rem;
            margin: 0 0.25rem;
            font-size: 0.875rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            background-color: white;
            color: #374151;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background-color: #2563eb;
            color: white;
            border-color: #2563eb;
            font-weight: 600;
        }

        .dataTables_wrapper .dataTables_info {
            margin-top: 1rem;
            font-size: 0.875rem;
            color: #4b5563;
        }
    </style>
    
    {{-- Inisialisasi --}}
    <script>
        $(document).ready(function () {
            $('#datatable').DataTable({
                language: {
                    lengthMenu: "Tampilkan _MENU_ data",
                    zeroRecords: "Data tidak ditemukan",
                    info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                    infoEmpty: "Tidak ada data tersedia",
                    search: "Cari:",
                    paginate: {
                        first: "Awal",
                        last: "Akhir",
                        next: "Next",
                        previous: "Previous"
                    }
                }
            });
        });
    </script>
</x-app-layout>
