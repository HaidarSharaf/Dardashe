<?php

namespace App\Livewire;

use App\Models\Friendship;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class MyFriendRequests extends Component
{
    public User $user;

    public function mount(){
        $this->user = auth()->user();
    }

    #[On('friendRequestSent')]
    public function loadMyRequests()
    {
        return Friendship::where('user1_id', $this->user->id)
            ->where('status', 'pending')
            ->get();
    }

    public function render()
    {
        return view('livewire.my-friend-requests', [
            'my_requests' => $this->loadMyRequests(),
        ]);
    }
}
