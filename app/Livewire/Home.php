<?php

namespace App\Livewire;

use Livewire\Component;

class Home extends Component
{
    public function mount()
    {
        redirect()->route('texts');
    }
}
