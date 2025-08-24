<?php

namespace App\Livewire;

use App\Models\Friendship;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Add Friends - Dardashe')]
#[Layout('components.layouts.pages')]
class AddFriends extends Component
{

    public User $user;

    public $search = '';
    public $searchResults = [];

    public function mount()
    {
        $this->user = auth()->user();
    }

    #[On('friendRequestRejected')]
    public function loadFriendSuggestions()
    {
        $excludedUsers = Friendship::where(function ($query) {
            $query->where('user1_id', $this->user->id)
                ->orWhere('user2_id', $this->user->id);
        })
            ->pluck('user1_id')
            ->merge(
                Friendship::where(function ($query) {
                    $query->where('user1_id', $this->user->id)
                        ->orWhere('user2_id', $this->user->id);
                })->pluck('user2_id')
            )
            ->push($this->user->id)
            ->unique();


        return User::whereNotIn('id', $excludedUsers)
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('display_name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })
            ->limit(5)
            ->get();
    }

    public function addFriend($userId)
    {
        Friendship::create([
            'user1_id' => $this->user->id,
            'user2_id' => $userId,
            'status' => 'pending',
        ]);
        session()->flash('message', 'Friend request sent successfully.');
        $this->search = '';
        $this->dispatch('friendRequestSent');

    }

    public function render()
    {
        return view('livewire.add-friends', [
            'suggestions' => $this->loadFriendSuggestions(),
        ]);
    }
}
