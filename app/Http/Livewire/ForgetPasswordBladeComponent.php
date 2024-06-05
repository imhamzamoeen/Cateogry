<?php

namespace App\Http\Livewire;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Mail\ForgetPasswordMail;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Mail;

class ForgetPasswordBladeComponent extends Component
{




    protected $listeners = ['Reset' => 'resetForm',];

    public $email;


    protected $rules = [
        'email' => 'required|email|exists:users,email',
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
        $this->validate();
        try {

            $this->emit('toast', 'info', 'System is sending A Reset Mail ', 'Password Reset');
            DB::beginTransaction();
            $token = Str::random(64);
            $user = User::where('email', $this->email)->first();
            $roles = PasswordReset::create(['token' => $token, 'email' => $this->email]);
            if ($roles->exists()) {
                $details = array(
                    'email' => $this->email,
                    'user' => $user->name,
                    'token' => $token,
                );
                Mail::to($details['email'])->send(new ForgetPasswordMail($details['user'], $details['token']));

                DB::commit();
                $this->emit('toast', 'success', 'Reset Mail Sent Successfully', 'Password Reset');
                $this->emit('Reset');
            } else {
                $this->emit('toast', 'error', 'Reset Mail Could not be sent successfully', 'Password Reset');
            }
        } catch (Exception $exception) {
            DB::rollback();
            $this->emit('toast', 'success', $exception->getMessage(), 'Password Reset');
        }
    }
    public function render()
    {
        return view('livewire.forget-password-blade-component');
    }
}
