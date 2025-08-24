<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class Chat extends Component
{
    public User $authUser;
    public ?User $user;
    public function mount(User$user){
        $this->user = $user;
        $this->authUser = auth()->user();
    }

    public function render()
    {
        return view('livewire.chat');
    }
}
