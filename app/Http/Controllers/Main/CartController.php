<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(){
        $carts = Cart::where('user_id', auth()->id())->get();

        return view('pages.main.cart', compact('carts'));
    }

    public function store(Request $request){
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required'
        ]);

        $cart = Cart::where('product_id', $request->product_id)->where('user_id', auth()->id())->first();

        if($cart){
            $cart->update([
                'quantity' => $cart->quantity + $request->quantity
            ]);
        }else{
            Cart::create([
                'product_id' => $request->product_id,
                'user_id' => auth()->id(),
                'quantity' => $request->quantity
            ]);
        }

        return back()->with('success', 'Product added to cart');
    }

    public function destroy(Cart $cart){
        $cart->delete();
        return back()->with('success', 'Product removed from cart');
    }

    public function update(Request $request, Cart $cart){
        $request->validate([
            'quantity' => 'required',
            'type' => 'required|in:increment,decrement'
        ]);

        $cart->update([
            'quantity' => $request->type == 'increment' ? $cart->quantity + $request->quantity : $cart->quantity - $request->quantity
        ]);

        return back()->with('success', 'Cart updated');
    }
}
