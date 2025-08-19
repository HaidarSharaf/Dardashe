<?php

namespace App\Livewire\Auth;

use App\Models\User;
use App\Notifications\EmailVerification;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Title('Verify Email - Dardashe')]
class VerifyEmail extends AuthComponent
{
    #[Validate('required|digits:6|numeric')]
    public $otp = '';

    public $email = '';

    public ?User $user;

    public bool $send;

    public function mount(){
        $this->user = Auth::user();

        $this->email = $this->user->email;
        $this->send = false;

        if($this->user->email_verified_at){
            $this->redirect(route('home'), navigate: true);
            return;
        }
    }

    public function sendOtp()
    {
        $this->send = true;

        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $this->user->forceFill([
            'otp_code' => Hash::make($otp),
            'otp_expires_at' => now()->addMinutes(10),
            'otp_sent_at' => now()
        ])->save();

        try {
            $this->user->notify(new EmailVerification($otp));
            session()->flash('status', 'An OTP code was sent to your email.');
        } catch (Exception $e) {
            session()->flash('error', 'Failed to send OTP. Please try again.');
        }
    }

    private function clearOtp()
    {
        $this->user->forceFill([
            'otp_code' => null,
            'otp_expires_at' => null,
            'otp_sent_at' => null,
        ])->save();
    }

    public function render()
    {
        return view('livewire.auth.verify-email');
    }
}
