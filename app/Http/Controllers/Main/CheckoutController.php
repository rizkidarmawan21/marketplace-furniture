<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\TransactionShipping;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $userKey = 'items_' . auth()->id();
        $cartItems = Cache::get($userKey);

        if ($cartItems === null || empty($cartItems)) {
            return redirect()->route('cart.index')->with('failed', 'Pilih produk yang ingin dichackout terlebih dahulu !');
        }

        return view('pages.main.checkout');
    }

    public function saveItemForCheckout(Request $request)
    {
        $request['items'] = json_decode($request->items, true);

        $validated = $request->validate([
            'items' => 'required|array',
        ]);

        $items = $validated['items'];

        // Menyimpan items ke dalam cache dengan kunci unik untuk setiap pengguna
        $userKey = 'items_' . auth()->id();
        Cache::put($userKey, $items, now()->addMinutes(10));

        return redirect()->route('checkout.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'receiver_name' => 'required|string|max:255',
            'receiver_phone' => 'required|string|max:255',
            'receiver_address' => 'required|string',
            'receiver_province' => 'required|string|max:255',
            'receiver_city' => 'required|string|max:255',
            'receiver_postal_code' => 'required|string|max:255',
        ]);

        try {
            DB::beginTransaction();

            // Mengambil items dari cache dengan kunci unik untuk setiap pengguna
            $userKey = 'items_' . auth()->id();
            $cartItems = Cache::get($userKey);

            if (empty($cartItems)) {
                return redirect()->route('main.home')->with('error', 'Halaman checkout telah kedaluwarsa. Silakan coba lagi.');
            }

            $invoiceCode = 'INV-' . now()->format('Ymd') . str()->padLeft(rand(0, 999999999), 9, '0');

            do {
                $invoiceCode++;
            } while (Transaction::where('invoice_code', $invoiceCode)->exists());


            $itemProducts = [];
            $totalPrice = 5000;

            foreach ($cartItems as $cart_id) {
                $cart = Cart::find($cart_id);

                if ($cart) {
                    $product = Product::find($cart->product_id);

                    if ($product) {
                        $total = $product->price * $cart->quantity;

                        $itemProducts[] = [
                            'product_id' => $product->id,
                            'price' => $product->price,
                            'quantity' => $cart->quantity,
                            'total' => $total,
                        ];

                        $totalPrice += $total;
                    }

                    $cart->delete();
                }
            }

            $transaction = Transaction::create([
                'user_id' => auth()->id(),
                'invoice_code' => $invoiceCode,
                'total_price' => $totalPrice,
            ]);

            foreach ($itemProducts as $itemProduct) {
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $itemProduct['product_id'],
                    'price' => $itemProduct['price'],
                    'quantity' => $itemProduct['quantity'],
                    'total' => $itemProduct['total'],
                ]);


                // Mengurangi stok produk
                $product = Product::find($itemProduct['product_id']);
                $product->stock -= $itemProduct['quantity'];
                $product->save();
            }

            TransactionShipping::create([
                'transaction_id' => $transaction->id,
                'receiver_name' => $request->receiver_name,
                'receiver_phone' => $request->receiver_phone,
                'receiver_address' => $request->receiver_address,
                'receiver_province' => $request->receiver_province,
                'receiver_city' => $request->receiver_city,
                'receiver_postal_code' => $request->receiver_postal_code,
            ]);

            Cache::forget($userKey);

            // Midtrans
            // Konfigurasi midtrans
            Config::$serverKey = config('services.midtrans.serverKey');
            Config::$isProduction = config('services.midtrans.isProduction');
            Config::$isSanitized = config('services.midtrans.isSanitized');
            Config::$is3ds = config('services.midtrans.is3ds');


            $midtransItems = [
                [
                    'id' => 'Biaya Aplikasi',
                    'price' => 5000,
                    'quantity' => 1,
                    'name' => 'Biaya Aplikasi',
                ]
            ];

            foreach ($itemProducts as $itemProduct) {
                $midtransItems[] = [
                    'id' => $itemProduct['product_id'],
                    'price' => $itemProduct['price'],
                    'quantity' => $itemProduct['quantity'],
                    'name' => Product::find($itemProduct['product_id'])->name,
                ];
            }

            $midtrans = [
                'transaction_details' => array(
                    'order_id' =>  $transaction->invoice_code,
                    'gross_amount' => (int) $transaction->total_price,
                ),
                'item_details' => $midtransItems,
                'enabled_payments' => [
                    'qris',
                    'bank_transfer',
                    'alfamart',
                    'alfamidi',
                ],
                'vtweb' => array()
            ];

            // Ambil halaman payment midtrans
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;
            $transaction->payment_url = $paymentUrl;
            $transaction->save();

            DB::commit();

            return redirect()->to($paymentUrl);
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error($e->getMessage());

            return redirect()->route('main.home')->with('error', 'Terjadi kesalahan saat melakukan checkout. Silakan coba lagi.');
        }
    }
}
