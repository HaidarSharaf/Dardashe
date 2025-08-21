<?php

namespace App\Livewire;

use App\Models\Friendship;
use App\Models\User;
use Livewire\Component;

class IncomingRequests extends Component
{
    public User $user;

    public function mount()
    {
        $this->user = auth()->user();
    }

    public function acceptRequest($requestId)
    {
        $request = Friendship::find($requestId);
        $request->update(['status' => 'accepted']);
        session()->flash('message', 'Request accepted successfully.');
    }

    public function rejectRequest($requestId)
    {
        $request = Friendship::find($requestId);
        $request->delete();
        $this->dispatch('friendRequestRejected');
        session()->flash('message', 'Request rejected.');
    }

    public function loadIncomingRequests()
    {
        return Friendship::where('user2_id', $this->user->id)
            ->where('status', 'pending')
            ->get();
    }
    public function render()
    {
        return view('livewire.incoming-requests', [
            'incoming_requests' => $this->loadIncomingRequests(),
        ]);
    }
}
