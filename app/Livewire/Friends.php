<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('My Friends - Dardashe')]
class Friends extends Component
{
    public function render()
    {
        return view('livewire.friends');
    }
}
