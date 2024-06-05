<?php

namespace App\Http\Livewire\Dashboard\Sections;

use App\Models\Order;
use App\Models\Unit;
use App\Models\User;
use Livewire\Component;

class FirstSection extends Component
{
    public $item;
    public $PendingOrder;
    public $ApprovedOrder;
    public $user;
    public $TopOrder;
    public function mount(){
            $this->item=Unit::count();
            $this->PendingOrder=Order::where('status', 'pending')->count();
            $this->user=User::count();
            $this->TopOrder=Order::orderBy('quantity','DESC')->first();
            $this->ApprovedOrder=Order::where('status', 'approved')->count();




    }
    public function render()
    {
        return view('livewire.dashboard.sections.first-section');
    }
}
