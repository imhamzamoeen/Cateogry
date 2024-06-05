<?php

namespace App\Http\Livewire;

use Livewire\Component;

class NavBarComponent extends Component
{
    public $user;
    public function mount()
    {
        $this->user = auth()->user();
    }
    public function render()
    {
        return view('livewire.nav-bar-component');
    }
}
