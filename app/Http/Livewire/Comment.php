<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Comment as Komentar;
use Livewire\WithPagination;

class Comment extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $product_id;

    public function mount($product)
    {
        $this->product_id = $product->id;
    }

    public function render()
    {

        $comments = Komentar::with(['product', 'user'])->where('product_id', $this->product_id)->latest()->paginate(1);
        return view('livewire.comment', [
            'comments' => $comments
        ]);
    }
}
