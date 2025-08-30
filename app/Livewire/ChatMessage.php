<?php

namespace App\Livewire;

use App\Models\Message;
use Livewire\Component;

class ChatMessage extends Component
{
    public Message $message;
    public bool $isSentByMe;

    public function downloadFile(){
        $this->authorize('view-message', $this->message);
        $file = $this->message->latestMedia?->media_path;

        if(!$file){
            return;
        }

        return response()->download(storage_path('app/public/message_medias/files/' . $file));
    }

    public function render()
    {
        return view('livewire.chat-message');
    }
}
