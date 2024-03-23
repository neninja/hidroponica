<?php

namespace App\Livewire\Texts;

use App\Models\Text;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class TextReading extends Component
{
    public Text $text;

    public function render()
    {
        // dd(Storage::url($this->text->audio));
        return view('livewire.texts.read');
    }
}
