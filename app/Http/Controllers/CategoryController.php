<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

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
        $image = $request->file('url_photo');
        $filename = time().'.'.$request->url_photo->extension();
        $image_resize = Image::make($image->getRealPath());
        $image_resize->fit(250); 
        // $validatedData['url_photo'] = Storage::disk('public_uploads')->put('category-image', $image_resize);
        $image_resize->save(public_path('uploads/category-image/'. $filename));
        $validatedData['url_photo'] = 'category-image/'. $filename;

        Category::create($validatedData);
        return redirect('/admin-dashboard')->with('success', 'Data Ditambahkan');
    }

    public function destroy(Category $category)
    {
        $products = Product::where('category_id', $category->id)->get();
        if ($products->count()) {
            return redirect('/admin-dashboard')->with('error', 'Kategori tersebut sudah digunakan di produk');
        }

        $file_path = 'uploads/' . $category->url_photo;
        unlink($file_path);
        Category::where('id', $category->id)->delete();
        return redirect('/admin-dashboard')->with('success', 'Kategori dihapus');
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', [
            'category' => $category
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $data = Category::where('id', $category->id)->first();
        $rules = [
            'name' => 'required|min:4',
        ];
        if ($request->name == $data->id) {
            $rules['name'] = 'required|min:4|unique:categories';
        }

        if ($request->file('url_photo')) {
            $rules['url_photo'] = 'mimes:png,jpg,jpeg|image|max:1024';
            $file_path = 'uploads/' . $category->url_photo;
            unlink($file_path);
        }
        $validatedData = $request->validate($rules);

        if($request->file('url_photo')){
            $image = $request->file('url_photo');
        $filename = time().'.'.$request->url_photo->extension();
        $image_resize = Image::make($image->getRealPath());
        $image_resize->fit(250); 
        // $validatedData['url_photo'] = Storage::disk('public_uploads')->put('category-image', $image_resize);
        $image_resize->save(public_path('uploads/category-image/'. $filename));
        $validatedData['url_photo'] = 'category-image/'. $filename;
        }
        $validatedData['slug'] = Str::slug($request->name, '-');
        Category::where('id', $category->id)->update($validatedData);
        return redirect('/admin-dashboard')->with('success', 'Data diperbarui');
    }
}
