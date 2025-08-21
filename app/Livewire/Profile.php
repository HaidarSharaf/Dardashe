<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('My Profile - Dardashe')]
class Profile extends Component
{
    use WithFileUploads;

    public User $user;

    public $avatar;
    public $avatar_path = '';

    public function mount()
    {
        $this->user = auth()->user();
    }

    public function updateProfile()
    {
        $this->validate([
            'avatar' => 'required|image|max:2056',
        ]);

        if($this->user->avatar !== 'default_user_avatar.png') {
            Storage::disk('public')->delete('users_avatars' . $this->user->avatar);
        }

        $this->avatar_path = $this->avatar->storePublicly('users_avatars', ['disk' => 'public']);
        $filename = basename($this->avatar_path);

        $this->user->forceFill([
            'avatar' => $filename
        ])->save();

        $this->avatar = null;

        session()->flash('message', 'Profile picture updated successfully.');
    }

    public function render()
    {
        return view('livewire.profile');
    }
}
