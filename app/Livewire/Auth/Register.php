<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('Register - Dardashe')]
class Register extends AuthComponent
{
    use WithFileUploads;

    public string $name = '';
    public string $email = '';
    public $display_name = '';
    public $avatar;
    public $avatar_path = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'display_name' => ['required', 'string', 'max:255', 'unique:users,display_name'],
            'avatar' => ['required', 'image', 'max:2056'],
            'password' => ['required', 'string', 'confirmed', 'min:10', Rules\Password::defaults()],
        ]);

        $this->avatar_path = $this->avatar->storePublicly('users_avatars', ['disk' => 'public']);
        $filename = basename($this->avatar_path);

        $user = User::create([
            'name' => $validated['name'],
            'display_name' => $validated['display_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'avatar' => $filename,
        ]);

        event(new Registered($user));

        Auth::login($user);

        $this->redirect(route('verify-email'), navigate: true);
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
