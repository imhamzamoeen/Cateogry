<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ResetPasswordBladeComponent extends Component
{
    protected $listeners = ['Reset' => 'resetForm',];

    public $email;
    public $password;
    public $password_confirmation;


    public function mount($email)
    {
        $this->email = $email;
    }


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

        $this->validate();
        $roles = User::where('email', $this->email)->update(['password' => Hash::make($this->password)]);
        $this->emit('toast', 'success', 'Password has been updated successfully', 'Password ');
        $this->emit('Reset');
        return redirect('login');
    }


    protected $rules = [
        'email' => 'required|exists:users,email',
        'password' => 'required|min:8|confirmed',
    ];

    public function render()
    {
        return view('livewire.reset-password-blade-component');
    }
}
