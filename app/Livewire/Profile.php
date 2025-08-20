<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('My Profile - Dardashe')]
class Profile extends Component
{
    public function render()
    {
        return view('livewire.profile');
    }
}
