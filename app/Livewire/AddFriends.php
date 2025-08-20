<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Add Friends - Dardashe')]
class AddFriends extends Component
{
    public function render()
    {
        return view('livewire.add-friends');
    }
}
