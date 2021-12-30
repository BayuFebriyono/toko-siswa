<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $products = Product::where('category_id', $category->id)->get();
        return view('product.all_product', [
            'products' => $products,
            'category' => $category,
            'selected' => 'price'
        ]);
    }

    public function sortir($table = null, $category_id = null, Request $request)
    {
        $table = $request->sortir;
        // dd($table);
        $category_id = $request->category_id;
        $category = Category::where('id', $category_id)->first();
        $products = Product::where('category_id', $category_id)->get()->sortBy($table);
        return view('product.all_product', [
            'products' => $products,
            'category' => $category,
            'selected' => $table
        ]);
    }

    // Crud
    public function add()
    {
        return view('admin.category.add');
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|min:4|unique:categories',
            'url_photo' => 'mimes:png,jpg,jpeg|image|max:1024'
        ]);
        
        $validatedData['slug'] = Str::slug($request->name, '-');
        $validatedData['url_photo'] = Storage::disk('public_uploads')->put('category-image', $request->file('url_photo'));

        Category::create($validatedData);
        return redirect('/admin-dashboard')->with('success', 'Data Ditambahkan');
    }

    public function destroy(Category $category){
        $products = Product::where('category_id', $category->id)->get();
        if ($products->count()){
            return redirect('/admin-dashboard')->with('error', 'Kategori tersebut sudah digunakan di produk');
        }

        Category::where('id', $category->id)->delete();
        return redirect('/admin-dashboard')->with('success','Kategori dihapus');
        
    }
}
