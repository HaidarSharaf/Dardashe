<?php

namespace App\Livewire;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\MessageMedia;
use App\Models\User;
use Cache;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('Dardashe')]
class Chat extends Component
{
    use WithFileUploads;

    public User $user;
    public User $friend;

    public bool $reload = false;

    #[Validate('nullable|string')]
    public $text = '';

    #[Validate('nullable|file|mimes:jpeg,jpg,png,gif,svg,webp,mp4,pdf,doc,docx,xls,xlsx,ppt,pptx,txt,zip,rar|max:5120')]
    public $media = null;
    public $media_path;

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
        ->orderBy('created_at', 'asc')
        ->get()
        ->groupBy(function ($message){
            return $message->created_at->isToday() ? 'Today'
                : ($message->created_at->isYesterday() ? 'Yesterday'
                    : $message->created_at->format('M d, Y'));
        });
    }

    public function sendMessage($friendId){
        \Log::info('sendMessage called', ['friendId' => $friendId, 'text' => $this->text]);

        $this->authorize('send-message', User::find($friendId));

        if(trim((string)$this->text) === '' && !$this->media){
            return;
        }

        $this->validate();

        $isInChat = Cache::get('user_in_chat_' . $friendId) === (string)$this->user->id;

        $message = Message::create([
            'sender_id' => $this->user->id,
            'receiver_id' => $friendId,
            'text' => trim((string)$this->text) === '' ? null : $this->text,
            'is_seen' => $isInChat ? now() : null
        ]);

        if($this->media){
            $mime = $this->getMimeType($this->media);
            $this->media_path = $this->media->storePublicly('message_medias/' . $mime . 's', ['disk' => 'public']);

            $filename = basename($this->media_path);

            MessageMedia::create([
                'message_id' => $message->id,
                'media_path' => $filename,
                'media_type' => $mime,
            ]);
        }

        $this->text = '';
        $this->media = null;
        $this->resetValidation();

        broadcast(new MessageSent($message))->toOthers();

        $this->dispatch('$refresh');

        $this->dispatch('message-sent');
    }

    public function getListeners()
    {
        return [
            "echo:chat.{$this->user->id},MessageSent" => 'newMessage',
        ];
    }

    public function newMessage($payload){
        $this->reload = !$this->reload;
    }

    public function getMimeType($media){
        $mime = $media->getMimeType();

        $images = [
            'image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/svg+xml', 'image/webp'
        ];

        $videos = [
            'video/mp4'
        ];

        $files = [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/vnd.ms-powerpoint',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'text/plain',
            'application/zip',
            'application/x-rar-compressed'
        ];


        if (in_array($mime, $images)) {
            return 'image';
        } elseif (in_array($mime, $videos)) {
            return 'video';
        }
        return 'file';
    }

    public function render()
    {
        return view('livewire.chat', [
            'messages' => $this->loadMessages()
        ]);
    }
}
