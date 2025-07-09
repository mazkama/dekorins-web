<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Daftar Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-800 rounded-md shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-300">
            <table id="datatable" class="w-full text-sm text-center border border-gray-300 rounded-lg overflow-hidden">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-3 font-semibold border-b">No</th>
                        <th class="px-4 py-3 font-semibold border-b">Buku</th>
                        <th class="px-4 py-3 font-semibold border-b">User</th>
                        <th class="px-4 py-3 font-semibold border-b">Keterangan</th>
                        <th class="px-4 py-3 font-semibold border-b">Status</th>
                        <th class="px-4 py-3 font-semibold border-b">Biaya</th>
                        <th class="px-4 py-3 font-semibold border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($transactions as $trx)
                        <tr class="hover:bg-gray-50 transition duration-200">
                            <td class="px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2">{{ $trx->book->title ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $trx->user->name }}</td>
                            <td class="px-4 py-2">{{ $trx->keterangan }}</td>
                            <td class="px-4 py-2">
                                @if ($trx->status === 0)
                                    <span class="text-yellow-600 font-semibold">Pending</span>
                                @elseif ($trx->status === 1)
                                    <span class="text-green-600 font-semibold">Diterima</span>
                                @else
                                    <span class="text-red-600 font-semibold">Ditolak</span>
                                @endif
                            </td>
                            <td class="px-4 py-2">Rp{{ number_format($trx->biaya, 0, ',', '.') }}</td>
                            <td class="px-4 py-2">
                                <div class="flex justify-center gap-3">
                                    <a href="{{ route('transactions.edit', $trx->id) }}"
                                       class="px-4 py-1.5 bg-yellow-400 text-white text-sm font-semibold rounded hover:bg-yellow-500 transition">
                                        Edit
                                    </a>
                                    <form action="{{ route('transactions.destroy', $trx->id) }}" method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">
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

            @if ($transactions->isEmpty())
                <div class="mt-6 text-center text-gray-500 italic">Belum ada transaksi.</div>
            @endif
        </div>
    </div>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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
