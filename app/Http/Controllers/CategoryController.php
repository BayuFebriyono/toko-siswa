<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category){
        $products = Product::where('category_id', $category->id)->get();
        return view('product.all_product',[
            'products' => $products,
            'category' => $category,
            'selected' => 'price'
        ]);
    }

    public function sortir($table = null, $category_id = null, Request $request){
        $table = $request->sortir;
        // dd($table);
        $category_id = $request->category_id;
        $category = Category::where('id', $category_id)->first();
        $products = Product::where('category_id', $category_id)->get()->sortBy($table);
        return view('product.all_product',[
            'products' => $products,
            'category' => $category,
            'selected' => $table
        ]);
    }

    // Crud
    public function add(){
        return view('admin.category.add');
    }
}
