<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LeftSideProfileComponent extends Component
{

    protected $listeners = ['RefreshDetailComponent' => '$refresh',];
    public function render()
    {
        $user = auth()->user();
        return view('livewire.left-side-profile-component', compact('user'));
    }
}
