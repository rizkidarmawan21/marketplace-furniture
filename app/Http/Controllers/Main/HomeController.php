<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $productPopular = Product::with('category', 'productImages')
            ->orderBy('created_at', 'DESC')
            ->limit(10)
            ->get();

        $productRecomendation = Product::with('category', 'productImages')
            ->inRandomOrder()
            ->limit(10)
            ->get();

        return view('pages.main.home', compact('productPopular', 'productRecomendation'));
    }
}
