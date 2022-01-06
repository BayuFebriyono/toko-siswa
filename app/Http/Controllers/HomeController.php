<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home_partials.main', [
            'categories' => Category::all(),
            'allProducts' => Product::latest()->get()
        ]);
    }

    public function search(Request $request)
    {
        $products = Product::where('name', 'like', '%' . $request->name . '%')->get();
        $category = Category::first();

        return view('product.all_product', [
            'products' => $products,
            'category' => $category,
            'selected' => 'price',
            'search' => $request->name
        ]);
    }
}
