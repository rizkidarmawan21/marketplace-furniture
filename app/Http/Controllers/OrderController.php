<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->status;

        $query = Transaction::query();

        $query->when($status, function ($q) use ($status) {
            return $q->where('status', $status);
        });

        $title = 'All';

        if ($status == 'pending') {
            $title = 'Pending';
        } elseif ($status == 'onprogress') {
            $title = 'Dikemas';
        } elseif ($status == 'sent') {
            $title = 'Dikirim';
        } elseif ($status == 'success') {
            $title = 'Selesai';
        } elseif ($status == 'failed') {
            $title = 'Failed';
        }

        return view('pages.orders.index', [
            'title' => $title,
            'orders' => $query->latest()->paginate(10)
        ]);
    }

    public function show(Transaction $order)
    {
        return view('pages.orders.show', [
            'order' => $order
        ]);
    }

    public function update(Request $request, Transaction $order)
    {
        if (!$request->status) {
            return back()->with('failed', 'Status tidak boleh kosong');
        }


        $order->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status berhasil diubah');
    }

    public function destroy(Transaction $order)
    {
        $order->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Pesanan berhasil dihapus');
    }
}
