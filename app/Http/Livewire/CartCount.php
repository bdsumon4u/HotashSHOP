<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CartCount extends Component
{
    protected $listeners = ['cartUpdated' => '$refresh', 'cartBoxUpdated' => '$refresh'];

    public function render()
    {
        return view('livewire.cart-count');
    }
}
