<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionApprovalController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('status', 0)->with(['book', 'user'])->get(); // Hanya pending
        return view('transactions.approval', compact('transactions'));
    }

    public function approve($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->status = 1;
        $transaction->save();

        // Tambahkan saldo ke user jika transaksi berhasil
        $transaction->user->increment('saldo', $transaction->biaya);

        return redirect()->route('transactions.approval')->with('success', 'Transaksi disetujui.');
    }

    public function reject($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->status = 2;
        $transaction->save();

        return redirect()->route('transactions.approval')->with('success', 'Transaksi ditolak.');
    }
}
