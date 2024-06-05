<?php

namespace App\Http\Livewire;

use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

class PermissionCardComponent extends Component
{
    protected $listeners = ['DeletePermission' => 'DelPermission', 'RefreshCards' => '$refresh'];



    public function DelPermission(Permission $post)
    {
        try {
            DB::transaction(function () use ($post) {
                $post->delete();
                $this->emit('toast', 'success', 'Permission Deleted Successfully', 'Permission');
                $this->emit('RefreshUserPermissionTable');
            });
        } catch (Exception $exception) {
            $this->emit('toast', 'success', $exception->getMessage(), 'Permission');
        }
    }
    public function render()
    {
        $Permission_with_user = Permission::with(['users' => function ($q) {
            $q->select('id','name','email');
            $q->take(5);
        }])->withCount('users')->get();
        return view('livewire.permission-card-component', compact('Permission_with_user'));
    }
}
