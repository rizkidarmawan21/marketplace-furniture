<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $search = request()->query('search');

        // multiple categories parameter
        $categories = request()->query('category');
        $categories  = $categories ? explode(',', $categories) : null;

        $listCategory = Category::all();

        $products = Product::with('category', 'productImages')
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', "%$search%");
            })
            ->when($categories, function ($query) use ($categories) {
                return $query->whereIn('category_id', $categories);
            })
            ->paginate(12);

        return view('pages.main.products', compact('products', 'listCategory'));
    }
}
