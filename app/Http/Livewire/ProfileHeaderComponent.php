<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProfileHeaderComponent extends Component
{
    // use WithFileUploads;
    public $image;

    protected $listeners = ['ResetImage' => 'resetForm', 'UpdatePic' => 'ImageStore','RefreshHeader'=>'$refresh'];

    protected $rules = [
        'image' => 'mimes:jpeg,jpg,png|required|max:10000',
    ];

    public function updated($propertyName)
    {

        $this->validateOnly($propertyName);
    }

    public function resetForm()
    {
        $this->reset();
        // $this->emit('RefreshHeader');
    }

    public function ImageStore()
    {
        $this->validate();
        $name = $this->file->store('image', 'public');
        $update_pic = User::whereId(auth()->user()->id)->update([
            'image' => $name
        ]);
        if ($update_pic > 0) {

            $this->emit('toast', 'success', 'Profile Updated Successfully', 'Profile');
        }
    }
    public function render()
    {
        $user = auth()->user();
        return view('livewire.profile-header-component', compact('user'));
    }
}
