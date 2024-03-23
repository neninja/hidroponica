<?php

namespace App\Livewire;

use Livewire\Component;

class Logout extends Component
{
    public function mount()
    {
        session()->invalidate();
        session()->regenerateToken();
        redirect()->route('login');
    }
}
