<?php

namespace App\Policies;

use App\Models\Friendship;
use App\Models\Message;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        return $user->id === $model->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return false;
    }

    public function addFriend(User $user, User $model)
    {
        return !Friendship::where(function($query) use ($user, $model) {
            $query->where('user1_id', $user->id)
                ->where('user2_id', $model->id);
        })->orWhere(function($query) use ($user, $model) {
            $query->where('user1_id', $model->id)
            ->where('user2_id', $user->id);
        })->exists();
    }

    public function removeFriend(User $user, User $model)
    {
        return Friendship::where(function ($query) use ($user, $model) {
            $query->where(function ($q) use ($user, $model) {
                $q->where('user1_id', $user->id)
                    ->where('user2_id', $model->id);
            })
            ->orWhere(function ($q) use ($user, $model) {
                $q->where('user1_id', $model->id)
                    ->where('user2_id', $user->id);
            });
        })
        ->where('status', 'accepted')
        ->exists();
    }

    public function sendMessage(User $user, User $model)
    {
        return Friendship::where(function ($query) use ($user, $model) {
            $query->where(function ($q) use ($user, $model) {
                $q->where('user1_id', $user->id)
                    ->where('user2_id', $model->id);
            })
            ->orWhere(function ($q) use ($user, $model) {
                $q->where('user1_id', $model->id)
                    ->where('user2_id', $user->id);
            });
        })
        ->where('status', 'accepted')
        ->exists();
    }


    public function viewMessage(User $user, Message $message){
        return $user->id === $message->sender_id || $user->id === $message->receiver_id;
    }

    public function viewChat(User $user, User $model){
        return $user->id !== $model->id
            &&
            (
                Message::where(function($query) use ($user, $model) {
                    $query->where('sender_id', $user->id)
                        ->where('receiver_id', $model->id);
                })->orWhere(function($query) use ($user, $model) {
                    $query->where('sender_id', $model->id)
                        ->where('receiver_id', $user->id);
                })->exists()

                ||

                $this->sendMessage($user, $model)
            );
    }


    public function access(User $user){
        return $user->email_verified_at !== null;
    }

}
