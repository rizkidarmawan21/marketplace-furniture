<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\MidtranCallbackLog;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Notification;

class MidtransController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function callback(Request $request)
    {
        // Set konfigurasi midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        // Buat instance midtrans notification
        $notification = new Notification();

        // Assign ke variable untuk memudahkan coding
        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $order_id = $notification->order_id;

        // Cari transaksi berdasarkan code
        $transaction = Transaction::where('invoice_code', $order_id)->first();

        if (is_null($transaction)) {
            return response()->json([
                'meta' => [
                    'code' => 404,
                    'message' => 'Transaction not found'
                ]
            ]);
        }

        // set log callback
        $log = [
            'url' => $request->fullUrl(),
            'request' => json_encode($request->all()),
            'order_id' => $order_id,
            'status_code' => $status,
            'payment_type' => $type,
        ];

        MidtranCallbackLog::create($log);

        if ($transaction->status == 'Paid') {
            return response()->json([
                'meta' => [
                    'code' => 200,
                    'message' => 'Status paid'
                ]
            ]);
        }

        // Handle notification status midtrans
        if ($status == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $transaction->status = 'pending';
                } else {
                    $transaction->status = 'onprogress';
                }
            }
        } else if ($status == 'settlement') {
            $transaction->status = 'onprogress';
        } else if ($status == 'pending') {
            $transaction->status = 'pending';
        } else if ($status == 'deny') {
            $transaction->status = 'failed';
        } else if ($status == 'expire') {
            $transaction->status = 'failed';
        } else if ($status == 'failed') {
            $transaction->status = 'failed';
        }

        // Simpan transaksi
        $transaction->save();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function success(Request $request)
    {
        return view('midtrans.success');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function unfinish(Request $request)
    {
        return view('midtrans.unfinish');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function error(Request $request)
    {
        return view('midtrans.error');
    }
}
