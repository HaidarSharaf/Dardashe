<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Dardashe')]
class NoChat extends Component
{
    public function render()
    {
        return view('livewire.no-chat');
    }
}
