<?php

namespace App\Http\Livewire;

use App\Models\Unit;
use Livewire\Component;
use Livewire\WithPagination;

class StoreBladeComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = '';

    

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        return view('livewire.store-blade-component', [
            'items' => Unit::where('name', 'like', '%' . $this->search . '%')->with(['SubCategory.Category'])->paginate(10),

        ]);
    }
}
