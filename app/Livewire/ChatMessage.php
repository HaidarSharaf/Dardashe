<?php

namespace App\Livewire;

use App\Models\Message;
use Livewire\Component;

class ChatMessage extends Component
{
    public Message $message;
    public bool $isSentByMe;

    public function render()
    {
        return view('livewire.chat-message');
    }
}
