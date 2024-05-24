<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();

        $products = Product::with('category', 'productImages')->get();

        return view('pages.products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required',
            'stock' => 'required|numeric',
            'size' => 'required',
            'color' => 'required',
            'product_images' => 'required|image|mimes:jpg,jpeg,png',
        ]);

        try {
            DB::beginTransaction();
            $fileService = new FileService();

            $product = Product::create([
                'name' => $validation['name'],
                'description' => $validation['description'],
                'category_id' => $validation['category_id'],
                'price' => $validation['price'],
                'stock' => $validation['stock'],
                'size' => $validation['size'],
                'color' => $validation['color']
            ]);

            $file = $fileService->uploadFile($request->file('product_images'), 'file/product');

            $product->productImages()->create([
                'image_path' => config('app.url') . $file,
                'is_main_image' => false,
            ]);

            DB::commit();

            return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('admin.products.index')->with('failed', 'Product failed to create.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product = Product::with('category', 'productImages')->find($product->id);

        return view('pages.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validation = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required',
            'stock' => 'required|numeric',
            'size' => 'required',
            'color' => 'required',
            'product_images' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        try {
            DB::beginTransaction();
            $fileService = new FileService();

            $product->update([
                'name' => $validation['name'],
                'description' => $validation['description'],
                'category_id' => $validation['category_id'],
                'price' => $validation['price'],
                'stock' => $validation['stock'],
                'size' => $validation['size'],
                'color' => $validation['color'],
            ]);

            if ($request->hasFile('product_images')) {

                $file = $fileService->uploadFile($request->file('product_images'), 'file/product');

                $product->productImages()->delete();

                $product->productImages()->create([
                    'image_path' => config('app.url') . $file,
                    'is_main_image' => false,
                ]);
            }


            DB::commit();

            return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('admin.products.index')->with('failed', 'Product failed to update.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            DB::beginTransaction();
            $product->delete();
            DB::commit();

            return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('admin.products.index')->with('failed', 'Product failed to delete.');
        }
    }
}
