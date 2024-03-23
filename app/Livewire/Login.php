<?php

namespace App\Livewire;

use App\Enums\UserRole;
use App\Events\UserLoggedIn;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Login extends Component
{
    #[Rule('required|string')]
    public $email;

    #[Rule('required|string')]
    public $password;

    public function render()
    {
        return view('livewire.login');
    }

    public function attributes(): array
    {
        return [
            'email' => 'login',
            'password' => 'senha',
        ];
    }

    public function messages(): array
    {
        return [
            'email.*' => 'Login inválido.',
        ];
    }

    public function handleLogin()
    {
        $this->validate();

        /** @var User|null $user */
        $user = User::whereEmail($this->email)->first();

        if (! $user) {
            $this->addError('general', __('login.generic_fail'));

            return redirect()->back();
        }

        if ($user->role !== UserRole::Student) {
            $this->addError('general', __('login.generic_fail'));

            return redirect()->back();
        }

        $success = Auth::attempt([
            'email' => $this->email,
            'password' => $this->password,
        ]);

        if (! $success) {
            $this->addError('general', __('login.generic_fail'));

            return redirect()->back();
        }

        event(new UserLoggedIn);

        return redirect()->route('home');
    }
}
