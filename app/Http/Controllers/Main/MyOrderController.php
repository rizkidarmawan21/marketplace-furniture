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
}
