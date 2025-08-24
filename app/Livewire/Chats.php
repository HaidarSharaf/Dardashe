<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class Chats extends Component
{
    public User $user;
    public $chats = [];
    public function mount()
    {
        $this->user = auth()->user();
        $this->chats = $this->user->friendsList();
    }

    public function getLatestMessage($friendId)
    {
        $message = $this->user->latestMessage($this->user, User::find($friendId));

        if (!$message) {
            return [
                'sender' => null,
                'message'   => 'No messages yet. Tap here to start the conversation.',
                'time'   => null,
            ];
        }

        return [
            'sender' => $message->sender_id,
            'message' => $message->text ? $message->text : $message->medias()->media_type()->latest(),
            'time' => $message->created_at->diffForHumans(),
        ];
    }

    public function getUnseenMessagesCount($friendId)
    {
        return $this->user->unseenMessagesCount($this->user, User::find($friendId));
    }

    public function getLastMessageSenderName($sender_id)
    {
        if($sender_id === $this->user->id) {
            return 'You';
        }
        $sender = User::find($sender_id);
        return $sender->display_name;
    }

    public function render()
    {
        return view('livewire.chats');
    }
}
