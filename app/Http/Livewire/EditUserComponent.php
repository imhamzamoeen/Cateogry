<?php

namespace App\Http\Livewire;

use App\Models\User;
use Exception;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditUserComponent extends Component
{

    use WithFileUploads;
    protected $listeners = ['ResetEditModal' => 'resetForm', 'UserEditModal' => 'UserEditModal',];
    public $User;
    public $image;
    public function mount()
    {

        $this->User['id'] = '';
        $this->User['name'] = '';
        $this->User['email'] = '';
        $this->User['password'] = '';
        $this->User['user_type'] = '';
        $this->image = '';
        // dd($User);
    }

    protected function rules()
    {
        return [
            'User.name' => 'required|string|max:40',
            'User.email' => ['required', 'string', 'max:255', 'unique:users,email,' . $this->User['id'] . ',id'],
            'User.password' => 'nullable|string|min:8',
            'User.user_type' => 'required|string|in:Super_Admin,Admin,User,Accountant',
            'image' => 'mimes:jpeg,jpg,png|nullable|max:10000'
        ];
    }

    public function UserEditModal(User $user)
    {
        $this->User['id']=$user->id;
        $this->User['name'] = $user->name;
        $this->User['email'] = $user->email;
        $this->User['user_type'] = $user->user_type;
        // $User['password'] = $user->password;
        $this->emit('ModalOpen', 'UserEditModal');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function resetForm()
    {
        $this->reset('User');
    }

    public function EditSubmit()
    {

        try {
            
            $validatedData = $this->validate();
            if (!empty($validatedData['image'])) {
               
                $file_name = substr(md5(uniqid(rand(1, 6))), 0, 10) . '.' . $this->image->extension(); // or any name you want
                $this->image->storeAs('users', $file_name, 'asset');
                $validatedData['User']['image'] = $file_name;
                // $validatedData['Model'] += ['image' => $file_name];
                // dd($validatedData['Model']);
            }
            $emptyRemoved = array_filter($validatedData['User']);
          
                
            $user = User::whereId( $this->User['id'])->update($emptyRemoved);
            User::find($this->User['id'])->syncRoles([]);
            // User::find( $this->User['id'])->roles()->detach();   
            //rEmove previous role and then do 
            User::find( $this->User['id'])->assignRole($emptyRemoved['user_type']);

            $this->emit('toast', 'success', 'User Updated successfully', 'User Managment');

            $this->emit('RefreshUserManagmentTable');
            $this->emit('ModalClose', 'UserEditModal');
        } catch (Exception $exception) {
            $this->emit('toast', 'info', $exception->getMessage(), 'User Managment');
        }
    }
    public function render()
    {
        return view('livewire.edit-user-component');
    }
}
