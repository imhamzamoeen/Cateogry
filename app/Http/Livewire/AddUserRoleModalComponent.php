<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class AddUserRoleModalComponent extends Component
{

    protected $listeners = ['ResetUserRole' => 'resetForm', 'RefreshRoleUserModal' => 'RefreshRoleUserModal'];

    public $users;
    public $role;

    public $Model;

    public function mount()
    {
        $this->users = User::get(['id', 'name', 'email']);
        $this->role = Role::pluck('name');
    }

    public function RefreshRoleUserModal()
    {
        $this->users = User::get(['id', 'name', 'email']);
        $this->role = Role::pluck('name');
    }



    protected $rules = [
        // 'UserName' => 'required|max:50|exists:users,name',
        // 'PermissionName' => 'required|exists:permissions,name',
        'Model.user' => 'required|max:50|exists:users,id',
        'Model.role' => 'required|exists:roles,name',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function resetForm()
    {
        $this->reset('Model');
    }

    public function submit()
    {

        $this->validate();

        $user = User::find($this->Model['user']);
        $user->assignRole($this->Model['role']);

        $this->emit('toast', 'success', 'Role  Assigend to User Successfully', 'Role ');
        $this->emit('ModalClose', 'UserRoleModal');
        $this->emit('RefreshCards');
        $this->emit('ResetUserRole');
        $this->emit('RefreshRoleUserTable');
    }

    public function render()
    {
        return view('livewire.add-user-role-modal-component');
    }
}
