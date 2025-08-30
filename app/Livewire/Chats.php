<?php

namespace App\Livewire;

use App\Models\Message;
use App\Models\User;
use Cache;
use Livewire\Attributes\On;
use Livewire\Component;

class Chats extends Component
{
    public User $user;
    public $chats = [];
    public function mount()
    {
        $this->user = auth()->user();
        $this->chats = $this->user->chatsList();
    }

    public function getLatestMessage($friendId)
    {
        $message = $this->user->latestMessage(User::find($friendId));

        if (!$message) {
            return [
                'sender' => null,
                'message'   => 'No messages yet. Tap here to start the conversation.',
                'time'   => null,
            ];
        }

        return [
            'sender' => $message->sender_id,
            'message' => $message->text,
            'media' => $message->latestMedia?->media_type,
            'time' => $message->created_at->diffForHumans(),
        ];
    }

    public function getUnseenMessagesCount($friendId)
    {
        return $this->user->unseenMessagesCount(User::find($friendId));
    }

    public function getLastMessageSenderName($sender_id)
    {
        if($sender_id === $this->user->id) {
            return 'You';
        }
        $sender = User::find($sender_id);
        return $sender->display_name;
    }

    #[On('message-sent')]
    public function onMessageSent(): void
    {
        $this->chats = $this->user->chatsList();
    }

    public function goToChat($friendId){
        Cache::forget('user_in_chat_' . $this->user->id);
        Cache::put('user_in_chat_' . $this->user->id, $friendId);

        $friend = User::find($friendId);
        $this->user->updateIsSeen($friend);
        $this->redirect(route('chat', $friend), navigate: true);
    }

    public function render()
    {
        return view('livewire.chats');
    }
}
