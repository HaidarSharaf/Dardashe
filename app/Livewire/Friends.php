<?php

namespace App\Livewire;

use App\Models\Friendship;
use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('My Friends - Dardashe')]
class Friends extends Component
{
    public User $user;

    public function mount()
    {
        $this->user = auth()->user();
    }

    public function loadFriends()
    {
        return $this->user->friendsList();
    }

    public function removeFriend($friendId)
    {
        $friendship = Friendship::whereIn('user1_id', [$friendId, $this->user->id])
            ->whereIn('user2_id', [$friendId, $this->user->id])
            ->first();
        $friendship->delete();
        session()->flash('message', 'Friend removed.');
    }

    public function render()
    {
        return view('livewire.friends', [
            'friends' => $this->loadFriends(),
        ]);
    }
}
