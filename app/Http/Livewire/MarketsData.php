<?php

namespace App\Http\Livewire;

use App\Models\Market;
use Livewire\Component;

class MarketsData extends Component
{
    public $limitPerPage = 10;
    protected $listeners = [
        'market-data' => 'marketData'
    ];
    public function marketData()
    {
        $this->limitPerPage = $this->limitPerPage + 6;
    }
    public function render()
    {
        $market = Market::with('product', 'user')->latest()->paginate($this->limitPerPage);
        $this->emit('marketsStore');
        return view('livewire.markets-data', ['allMarkets' => $market]);
    }
}
