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
                        <label class="block text-sm font-medium text-gray-700">Dekorin</label>
                        <select name="dekorin_id" class="form-select w-full mt-1">
                            <option value="">-- Pilih Dekorin --</option>
                            @foreach ($dekorins as $dekorin)
                                <option value="{{ $dekorin->id }}" {{ $transaction->dekorin_id == $dekorin->id ? 'selected' : '' }}>
                                    {{ $dekorin->tema }}
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
                            <option value="pending" {{ $transaction->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ $transaction->status == 'approved' ? 'selected' : '' }}>Disetujui</option>
                            <option value="rejected" {{ $transaction->status == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                            <option value="paid" {{ $transaction->status == 'paid' ? 'selected' : '' }}>Dibayar</option>
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

                {{-- Tampilkan detail pembayaran jika ada --}}
                @if($payment)
                    <div class="mt-8 border-t pt-6">
                        <h3 class="font-semibold text-lg mb-2">Detail Pembayaran</h3>
                        <div class="mb-2">
                            <span class="font-medium">Metode:</span>
                            {{ $payment->paymentMethod->name ?? '-' }}
                        </div>
                        <div class="mb-2">
                            <span class="font-medium">Jumlah:</span>
                            Rp{{ number_format($payment->amount, 0, ',', '.') }}
                        </div>
                        <div class="mb-2">
                            <span class="font-medium">Tanggal Bayar:</span>
                            {{ $payment->paid_at ? \Carbon\Carbon::parse($payment->paid_at)->format('d-m-Y H:i') : '-' }}
                        </div>
                        <div class="mb-2">
                            <span class="font-medium">Bukti Pembayaran:</span>
                            @if($payment->payment_proof)
                                <a href="{{ asset('storage/' . $payment->payment_proof) }}" target="_blank" class="text-blue-600 underline">Lihat Bukti</a>
                            @else
                                <span>-</span>
                            @endif
                        </div>
                        <div class="flex gap-3 mt-4">
                            @if($transaction->status !== 'approved')
                                <form action="{{ route('transactions.approvePayment', $transaction->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 mr-3">Approve</button>
                                </form>
                                <form action="{{ route('transactions.cancelPayment', $transaction->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Cancel</button>
                                </form>
                            @else
                                <span class="text-green-700 font-semibold">Pembayaran sudah disetujui.</span>
                            @endif
                        </div> 
                @endif

            </div>
        </div>
    </div>
</x-app-layout>