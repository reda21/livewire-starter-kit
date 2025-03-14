<?php
namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.auth')]
class Register extends Component
{
    public $firstname;
    public $lastname;
    public $username;
    public $email;
    public $password;
    public $password_confirmation;

    public function render()
    {
        return view('livewire.auth.register');
    }

    public function rules()
    {
        return [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname'  => ['required', 'string', 'max:255'],
            'username'  => ['required', 'string', 'max:255', 'unique:users'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'  => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }

    public function register()
    {
        $this->validate();

        $user = User::create([
            'firstname' => $this->firstname,
            'lastname'  => $this->lastname,
            'username'  => $this->username,
            'email'     => $this->email,
            'password'  => bcrypt($this->password),
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
