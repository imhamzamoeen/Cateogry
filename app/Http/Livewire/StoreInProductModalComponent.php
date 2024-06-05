<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\Unit;
use Exception;
use Livewire\Component;

class StoreInProductModalComponent extends Component
{
    public $type;
    public $quantity;
    public $unit_id;
    public $limit;
    public function mount()
    {
        $this->type = '';
        $this->quantity = '';
        $this->unit_id = '';


    }
    protected $listeners = [
        'ProductInModal' => 'ProductInModal'
    ];

    public function ProductInModal(Unit $unit)
    {
        $this->quantity = $unit->quantity;
        $this->unit_id = $unit->id;
        $this->limit = $unit->quantity;

        $this->emit('ModalOpen', 'ProductInModal');
        
    }

    protected function rules()
    {
        
        return [
            'type' => 'required|string',
            'unit_id' => ['required', 'numeric', 'exists:units,id'],
            'quantity' => ['required', 'numeric', 'between:1,'.$this->limit.'' ],
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function resetForm()
    {
        $this->reset(['type', 'quantity','unit_id',]);
    }

    public function EditSubmit()
    {

        $this->validate();
        try {

            $validatedData = $this->validate();
            $validatedData['status'] = "pending";
            $validatedData['last_performer'] = auth()->user()->user_type;
            $validatedData['user_id'] = auth()->user()->id;

            $emptyRemoved = array_filter($validatedData);



            $order = Order::create($emptyRemoved);
            // $update_quantity = Unit::whereId($this->unit_id)->when($this->type == "in", function ($query) {
            //     return $query->increment('quantity', $this->quantity);
            // }, function ($query) {
            //     return $query->decrement('quantity', $this->quantity);
            // });


            $this->emit('toast', 'success', 'Action Performed Successfully', 'Store');

            $this->emit('ModalClose', 'ProductInModal');
        } catch (Exception $exception) {
            $this->emit('toast', 'info', $exception->getMessage(), 'Store');
        }
    }

    public function render()
    {
        return view('livewire.store-in-product-modal-component');
    }
}
