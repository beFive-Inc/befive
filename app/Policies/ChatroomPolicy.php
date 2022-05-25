<?php

namespace App\Policies;

use App\Models\Chatroom;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChatroomPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Chatroom  $chatroom
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Chatroom $chatroom)
    {
        return $chatroom->members
            ->filter(function($member) use ($user) {
                return $member->user->id === $user->id;
            })->count()
            ? Response::allow()
            : Response::deny(__('Vous ne faites pas partie de cette conversation'));
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Chatroom  $chatroom
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Chatroom $chatroom)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Chatroom  $chatroom
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Chatroom $chatroom)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Chatroom  $chatroom
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Chatroom $chatroom)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Chatroom  $chatroom
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Chatroom $chatroom)
    {
        //
    }
}
