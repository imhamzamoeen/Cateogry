<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class AddPermissionModalComponent extends Component
{
    protected $listeners = ['Reset' => 'resetForm',];

    public $name;



    protected $rules = [
        'name' => 'required|max:20|unique:permissions,name',
    ];

    public function updated($propertyName)
    {

        $this->validateOnly($propertyName);
    }

    public function resetForm()
    {
        $this->reset();
    }

    public function submit()
    {

        $validatedData = $this->validate();
        $newRole = Permission::create($validatedData);

        $this->emit('toast', 'success', 'Permission Added Successfully', 'Permission');
        $this->emit('ModalClose', 'AddPermissionModal');
        $this->emit('RefreshCards');
        $this->emit('Reset');
        $this->emit('RefreshUserPermissionTable');
        $this->emit('RefreshUserPermissionModal');
    }
    public function render()
    {
        return view('livewire.add-permission-modal-component');
    }
}
