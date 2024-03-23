<?php

namespace App\Livewire\Texts;

use App\Models\Text;
use Illuminate\Support\Collection;
use Livewire\Component;

class Dashboard extends Component
{
    public Collection $texts;

    public function __construct()
    {
        $this->texts = Text::all();
    }

    public function render()
    {
        return view('livewire.texts.index');
    }
}
