<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProduct = Product::count();
        // total_price - 5000 (Biaya Aplikasi)
        $totalProfit = Transaction::where('status', 'success')->sum(DB::raw('total_price - 5000'));

        $totalOrders = Transaction::count();
        $totalUser = User::where('role', 'user')->count();

        $totalOrderPending = Transaction::where('status', 'pending')->count();
        $totalOrderOnProcess = Transaction::where('status', 'onprogress')->count();
        $totalOrderSent = Transaction::where('status', 'sent')->count();
        $totalOrderSuccess = Transaction::where('status', 'success')->count();

        return view('dashboard', compact(
            'totalProduct',
            'totalProfit',
            'totalOrders',
            'totalUser',
            'totalOrderPending',
            'totalOrderOnProcess',
            'totalOrderSent',
            'totalOrderSuccess'
        ));
    }
}
