<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Photo;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:products|min:5|max:40',
            'description' => 'required|min:20|max:500',
            'price' => 'required|min:4',
            'stock' => 'required|min:1',
            'berat' => 'numeric'
        ]);
        $validatedData['category_id'] = $request->category_id;
        $validatedData['slug'] = Str::of($request->name)->slug('-');
        $validatedData['market_id'] = $request->market_id;

        Product::create($validatedData);
        return redirect()->back()->with('success', 'Produk Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $photos = Photo::where('product_id', $product->id)->get();
        // $comments = Comment::with(['product', 'user'])->where('product_id', $product->id)->get();
        return view('product.show', [
            'product' => $product,
            'photos'  => $photos,
            // 'comments' => $comments
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $photos = Photo::where('product_id', $product->id)->get();
        session(['product_id' => $product->id]);
        $products = Product::where('market_id', auth()->user()->market->id)->get();
        return view('myprofile.edit-product', [
            'product' => $product,
            'photos' => $photos,
            'products' => $products,
            'categories' => Category::all()->sortBy('name')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $rules = [
            'name' => 'required|min:5|max:40',
            'description' => 'required|min:20|max:500',
            'price' => 'required|min:4',
            'stock' => 'required'
        ];

        if ($request->name != $product->name) {
            $rules['name'] = 'required|unique:products|min:5|max:40';
        }

        $validatedData = $request->validate($rules);
        $validatedData['slug'] = Str::of($request->name)->slug('-');
        $validatedData['category_id'] = $request->category_id;

        Product::where('id', $product->id)->update($validatedData);
        return redirect('/product/' . $validatedData['slug'] . '/edit')->with('success', 'Produk Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        Product::where('id', $product->id)->delete();
        return redirect('/myaccount/market')->with('success', 'Product dihapus');
    }

    public function addPhoto(Request $request)
    {
        $validatedData = $request->validate([
            'url' => 'required|mimes:png,jpg,jpeg|max:1024'
        ]);

        $validatedData['url'] = Storage::disk('public_uploads')->put('product-image', $request->file('url'));
        $validatedData['product_id'] = session('product_id');

        Photo::create($validatedData);
        if ($validatedData) {
            return response()->json(['status' => 1, 'msg' => 'Gambar Berhasil DIperbarui', '']);
        } else {
            return response()->json(['status' => 0, 'msg' => 'Something went wrong, try again later']);
        }
    }

    public function removePhoto(Photo $photo)
    {
        $file_path = 'uploads/' . $photo->url;
        unlink($file_path);

        Photo::where('id', $photo->id)->delete();
        return redirect()->back();
    }
}
