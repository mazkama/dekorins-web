<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-md sm:rounded-lg">

                <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Buku</label>
                        <select name="book_id" class="form-select w-full mt-1">
                            <option value="">-- Tidak ada buku --</option>
                            @foreach ($books as $book)
                                <option value="{{ $book->id }}" {{ $transaction->book_id == $book->id ? 'selected' : '' }}>
                                    {{ $book->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">User</label>
                        <select name="user_id" class="form-select w-full mt-1">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ $transaction->user_id == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Keterangan</label>
                        <textarea name="keterangan" class="form-input w-full mt-1">{{ $transaction->keterangan }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" class="form-select w-full mt-1">
                            <option value="0" {{ $transaction->status == 0 ? 'selected' : '' }}>Pending</option>
                            <option value="1" {{ $transaction->status == 1 ? 'selected' : '' }}>Diterima</option>
                            <option value="2" {{ $transaction->status == 2 ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Biaya</label>
                        <input type="number" name="biaya" class="form-input w-full mt-1" value="{{ $transaction->biaya }}">
                    </div>

                    <div class="flex justify-between items-center">
                        <a href="{{ route('transactions.index') }}" class="text-gray-600 hover:underline">Kembali</a>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
