<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class ViewUnitComponent extends Component
{
    
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public $item;
 
    public function mount($item)
    {
        $this->item = $item;
        
    }
 
    public function render()
    {
        return view('livewire.view-unit-component',[
            'items'=>$this->item->paginate(10)
        ]);
    }
}
