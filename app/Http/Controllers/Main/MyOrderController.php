<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class MyOrderController extends Controller
{
    public function index()
    {
        $status = request('status', 'pending');
        $user = auth()->user();

        $transactions = Transaction::with('details.product')
            ->where('user_id', $user->id)
            ->where('status', $status)
            ->latest()
            ->get();

        $countTransactions = [
            'pending' => $user->transactions()->where('status', 'pending')->count(),
            'onprogress' => $user->transactions()->where('status', 'onprogress')->count(),
            'sent' => $user->transactions()->where('status', 'sent')->count(),
        ];


        return view('pages.main.history', [
            'transactions' => $transactions,
            'status' => $status,
            'countTransactions' => collect($countTransactions)
        ]);
    }

    public function show(Transaction $transaction)
    {
        return view('pages.main.detail-history', [
            'transaction' => $transaction
        ]);
    }

    public function received(Request $request, Transaction $transaction)
    {
        $request->validate([
            'received' => 'required|boolean'
        ]);

        if ($transaction->status !== 'sent') {
            return back()->with('failed', 'Pesanan belum dikirimkan');
        }

        $transaction->update([
            'status' => $request->received ? 'success' : 'sent'
        ]);

        return back()->with('success', 'Pesanan telah diterima');
    }
}
