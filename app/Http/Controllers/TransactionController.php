<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Dekorin;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    // Tampilkan semua transaksi
    public function index()
    {
        $transactions = Transaction::with(['dekorin', 'user'])->latest()->get();
        return view('transactions.index', compact('transactions'));
    }

    // Tampilkan form edit transaksi
    public function edit(Transaction $transaction)
    {
        $dekorins = Dekorin::all();
        $users = User::all();
        return view('transactions.edit', compact('transaction', 'dekorins', 'users'));
    }

    // Update transaksi
    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'dekorin_id' => 'required|exists:dekorins,id',
            'user_id'    => 'required|exists:users,id',
            'keterangan' => 'required|string',
            'status'     => 'required|string|in:pending,approved,rejected',
            'biaya'      => 'required|numeric',
        ]);

        $transaction->update($request->only([
            'dekorin_id', 'user_id', 'keterangan', 'status', 'biaya'
        ]));

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    // Hapus transaksi
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
