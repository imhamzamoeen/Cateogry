<?php

namespace App\Http\Livewire;

use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class RoleCardsComponent extends Component

{
    protected $listeners = ['DeleteRole' => 'DeleteRole', 'RefreshCards' => '$refresh'];



    public function DeleteRole(Role $post)
    {
        try {
            DB::transaction(function () use ($post) {
                $post->delete();
                $this->emit('toast', 'success', 'Role Deleted Successfully', 'Role');
                $this->emit('RefreshCards');
                $this->emit('RefreshRoleUserTable');
                $this->emit('RefreshRolePermissionTable');
            });
        } catch (Exception $exception) {
            $this->emit('toast', 'error', $exception->getMessage(), 'Role ');
        }
    }
    public function render()
    {
        $Role_with_user = Role::with(['users' => function ($q) {
            $q->select('id', 'name', 'image');
            $q->take(5);
        }])->withCount('users')->get();
        return view('livewire.role-cards-component', compact('Role_with_user'));
    }
}
