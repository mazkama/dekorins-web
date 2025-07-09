<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Dekorin;
use App\Models\User;
use App\Models\Payment;
use App\Models\PaymentMethod;
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
        $payment = Payment::with('paymentMethod')->where('transaction_id', $transaction->id)->first();
        $paymentMethods = PaymentMethod::all();

        return view('transactions.edit', compact('transaction', 'dekorins', 'users', 'payment', 'paymentMethods'));
    }

    // Update transaksi
    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'dekorin_id' => 'required|exists:dekorins,id',
            'user_id'    => 'required|exists:users,id',
            'keterangan' => 'required|string',
            'status'     => 'required|string|in:pending,approved,rejected,paid',
            'biaya'      => 'required|numeric',
        ]);

        $transaction->update($request->only([
            'dekorin_id', 'user_id', 'keterangan', 'status', 'biaya'
        ]));

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    // Approve pembayaran
    public function approvePayment($transactionId)
    {
        $transaction = Transaction::findOrFail($transactionId);
        $transaction->update(['status' => 'approved']);
        return redirect()->back()->with('success', 'Pembayaran disetujui.');
    }

    // Cancel pembayaran
    public function cancelPayment($transactionId)
    {
        $transaction = Transaction::findOrFail($transactionId);
        $transaction->update(['status' => 'rejected']);
        return redirect()->back()->with('success', 'Pembayaran ditolak.');
    }

    // Hapus transaksi
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
