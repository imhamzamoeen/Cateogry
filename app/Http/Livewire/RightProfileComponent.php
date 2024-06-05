<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use PDO;

class RightProfileComponent extends Component
{
    protected $listeners = ['ResetUpdateForm' => 'resetForm','RefreshModel'=>'ResetModel'];

    public $Model;
    public function mount()
    {
        $this->Model['name'] = auth()->user()->name;
        $this->Model['email'] = auth()->user()->email;
    }
    protected function rules()
    {
        return [
            'Model.name' => ['required', 'string'],
            'Model.email' => ['required', 'email', 'max:255', 'unique:users,email,' . auth()->user()->id . ',id'],
            'Model.password' => ['nullable', 'string', 'min:8']
        ];
    }

    public function ResetModel()
    {
        $this->Model['name'] = auth()->user()->name;
        $this->Model['email'] = auth()->user()->email;
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


        $validatedData = $this->validate();
        $emptyRemoved = array_filter($validatedData['Model']);
        $Updated = User::whereId(auth()->user()->id)->update($emptyRemoved);

        $this->emit('toast', 'success', 'Profile Updated Successfully', 'Profile');
        $this->emit('RefreshModel');
        $this->emit('RefreshDetailComponent');
    }

    public function render()
    {

        return view('livewire.right-profile-component');
    }
}
