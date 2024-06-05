<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

class AssignPermissionToUserModalComponent extends Component
{
    protected $listeners = ['Reset' => 'resetForm', 'RefreshUserPermissionModal' => 'RefreshUserPermissionModal'];

    public $users;
    public $permission;

    public $model;

    public function mount()
    {
        $this->users = User::get(['id', 'name', 'email']);
        $this->permission = Permission::pluck('name');
    }

    public function RefreshUserPermissionModal()
    {
        $this->users = User::get(['id', 'name', 'email']);
        $this->permission = Permission::pluck('name');
    }



    protected $rules = [
        // 'UserName' => 'required|max:50|exists:users,name',
        // 'PermissionName' => 'required|exists:permissions,name',
        'model.UserName' => 'required|max:50|exists:users,id',
        'model.PermissionName' => 'required|exists:permissions,name',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function resetForm()
    {
        $this->reset('model');
    }

    public function submit()
    {

        $this->validate();

        $user = User::find($this->model['UserName']);
        $user->givePermissionTo($this->model['PermissionName']);

        $this->emit('toast', 'success', 'Permission Assigend to User Successfully', 'Permisison ');
        $this->emit('ModalClose', 'addUserPerModal');
        $this->emit('RefreshCards');
        // $this->emit('RefreshForm', 'AddRoleForm');

        $this->emit('Reset');
        $this->emit('RefreshUserPermissionTable');
    }


    public function render()
    {
        return view('livewire.assign-permission-to-user-modal-component',);
    }
}
