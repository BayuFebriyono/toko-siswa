<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use App\Models\Market;
class MarketProducts extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {

        // $comments = Komentar::with(['product', 'user'])->where('product_id', $this->product_id)->latest()->paginate(5);
        // return view('livewire.market-products', [
        //     'comments' => $comments
        // ]);

        $market = auth()->user()->market;
        $produk = Product::where('market_id', $market->id)->latest()->paginate(5);
        return view('livewire.market-products', [
            'market' => $market,
            'products' => $produk,
        ]);
    }
}
