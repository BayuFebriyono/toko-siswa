<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductsData extends Component
{

    public $limitPerPage = 10;
    protected $listeners = [
        'product-data' => 'productData'
    ];

    public function productData()
    {
        $this->limitPerPage = $this->limitPerPage + 6;
    }

    public function render()
    {
        $product = Product::latest()->paginate($this->limitPerPage);
        $this->emit('productsStore');
        return view('livewire.products-data', ['allProducts' => $product]);
    }
}
