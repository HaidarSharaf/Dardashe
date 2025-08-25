<?php

namespace App\Livewire;

use App\Models\Message;
use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Dardashe')]
class Chat extends Component
{
    public User $user;
    public User $friend;

    public function mount(User $friend){
        $this->friend = $friend;
        $this->user = auth()->user();
    }

    public function loadMessages(){
        return Message::where(function ($query) {
            $query->where('sender_id', $this->user->id)
                ->where('receiver_id', $this->friend->id);
        })->orWhere(function ($query) {
            $query->where('sender_id', $this->friend->id)
                ->where('receiver_id', $this->user->id);
        })
        ->orderBy('created_at', 'desc')
        ->get();
    }

    public function render()
    {
        return view('livewire.chat', [
            'messages' => $this->loadMessages()
        ]);
    }
}
