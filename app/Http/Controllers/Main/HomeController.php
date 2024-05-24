<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Article;
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

        // get 5 latest articles
        $articles = Article::orderBy('created_at', 'DESC')
            ->limit(5)
            ->get();

        return view('pages.main.home', compact('productPopular', 'productRecomendation','articles'));
    }
}
