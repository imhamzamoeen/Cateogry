<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AddRoleModalComponent extends Component
{

    protected $listeners = ['ResetRoleModal' => 'resetForm',];

    public $name;
    public $permissions;


    protected $rules = [
        'name' => 'required|max:20|unique:roles,name',
        'permissions' => 'required|array|min:1',


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
        $newRole = Role::create([
            'name' => $validatedData['name'],
        ]);
        $newRole->syncPermissions($validatedData['permissions']);
        $this->emit('toast', 'success', 'Role Added Successfully', 'Role');
        $this->emit('ModalClose', 'AddRoleModal');
        $this->emit('RefreshCards');
        // $this->emit('RefreshForm', 'AddRoleForm');

        $this->emit('ResetRoleModal');

        $this->emit('RefreshRolePermissionTable');
        $this->emit('RefreshRoleUserModal');
    }


    public function render()
    {
        $Permissions = Permission::pluck('name');
        return view('livewire.add-role-modal-component', compact('Permissions'));
    }
}
