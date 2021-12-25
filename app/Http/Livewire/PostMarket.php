<?php

namespace App\Http\Livewire;

use App\Models\Market;
use Livewire\Component;
use Illuminate\Support\Str;

class PostMarket extends Component
{
    public $name;
    protected $rules = [
        'name' => 'required'
    ];
    public function submit()
    {
        $this->validate();

        // Execution doesn't reach here if validation fails.

        Market::create([
            'user_id' => auth()->user()->id,
            'name' => $this->name,
            'slug' => Str::slug($this->name, '-')
        ]);
    }
}
