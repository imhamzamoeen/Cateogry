<?php

namespace App\Http\Livewire;

use App\Models\User;
use Exception;
use Livewire\Component;
use Livewire\WithFileUploads;

class NewUserComponent extends Component
{
    use WithFileUploads;

    public $Model;
    public $image;

    protected $listeners = ['ResetCreateForm' => 'resetForm',];

    // protected $rules = [

    //     'Model.name' => 'required|string|max:40',
    //     'Model.email' => 'required|email|unique:users,email',
    //     'Model.password' => 'required|string|min:8',
    //     'Model.user_type' => 'required|string|in:Super_Admin,Admin,User,Accountant',
    //     'image' => 'mimes:jpeg,jpg,png|nullable|max:10000'
    // ];

    protected function rules()
    {
        return [
            'Model.name' => 'required|string|max:40',
            'Model.email' => 'required|email|unique:users,email',
            'Model.password' => 'required|string|min:8',
            'Model.user_type' => 'required|string|in:Super_Admin,Admin,User,Accountant',
            'image' => 'mimes:jpeg,jpg,png|nullable|max:10000'
        ];
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function resetForm()
    {
        $this->reset(['Model', 'image']);
    }

    public function submit()
    {
        try {
            $validatedData = $this->validate();
            if (!empty($validatedData['image'])) {

                $file_name = substr(md5(uniqid(rand(1, 6))), 0, 10) . '.' . $this->image->extension(); // or any name you want
                $this->image->storeAs('users', $file_name, 'asset');
                $validatedData['Model']['image'] = $file_name;
                // $validatedData['Model'] += ['image' => $file_name];
                // dd($validatedData['Model']);
            }
            $emptyRemoved = array_filter($validatedData['Model']);

            $user = User::create($emptyRemoved);
            $user->assignRole($emptyRemoved['user_type']);

            $this->emit('toast', 'success', 'User Created successfully', 'User Managment');
            $this->emit('ResetCreateForm');
            $this->emit('RefreshUserManagmentTable');
        } catch (Exception $exception) {
            $this->emit('toast', 'info', $exception->getMessage(), 'User Managment');
        }
    }

    public function render()
    {
        return view('livewire.new-user-component');
    }
}
