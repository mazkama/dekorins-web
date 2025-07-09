<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Payment;
use Illuminate\Http\Request;

class TransactionApiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'dekorin_id' => 'required|exists:dekorins,id',
            'keterangan' => 'nullable|string',
            'status'     => 'required|in:pending,paid,approved,rejected',
            'biaya'      => 'required|numeric',
        ]);

        $transaction = Transaction::create([
            'user_id'    => $request->user()->id,
            'dekorin_id' => $request->dekorin_id,
            'keterangan' => $request->keterangan,
            'status'     => $request->status,
            'biaya'      => $request->biaya,
        ]);

        return response()->json([
            'message' => 'Transaksi berhasil dibuat',
            'data'    => $transaction
        ], 201);
    }

    public function pay(Request $request, $transaction_id)
    {
        $request->validate([
            'payment_method_id' => 'required|exists:payment_methods,id',
            'amount'            => 'required|numeric',
            'payment_proof'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'paid_at'           => 'nullable|date',
        ]);

        $transaction = Transaction::findOrFail($transaction_id);

        // Cek apakah sudah ada pembayaran
        if ($transaction->payment) {
            return response()->json([
                'message' => 'Pembayaran sudah dilakukan untuk transaksi ini',
            ], 400);
        }

        $paymentProofPath = null;
        if ($request->hasFile('payment_proof')) {
            $paymentProofPath = $request->file('payment_proof')->store('payment_proofs', 'public');
        }

        $payment = Payment::create([
            'transaction_id'    => $transaction->id,
            'payment_method_id' => $request->payment_method_id,
            'amount'            => $request->amount,
            'payment_proof'     => $paymentProofPath,
            'paid_at'           => $request->paid_at,
        ]);

        $transaction->update(['status' => 'paid']);

        return response()->json([
            'message' => 'Pembayaran berhasil',
            'data'    => $payment
        ], 201);
    }
}
