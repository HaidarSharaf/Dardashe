<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Dardashe')]
class Home extends Component
{
    public function logout()
    {
        auth()->logout();
        $this->redirect(route('login'), navigate: true);
    }
    public function render()
    {
        return view('livewire.home');
    }
}
