<?php

namespace App\Traits;

use Illuminate\Support\Collection;

trait Chatroom
{
    /**
     * @param Collection $chatrooms
     * @param Collection $friends
     * @return Collection
     */
    public function checkIfThisChatroomExist(Collection $chatrooms, Collection $friends): Collection
    {
        return $chatrooms->filter(function ($chatroom) use ($friends) {
            if (!$chatroom->isCanal) {
                return $chatroom->authors->count() === $friends->count()
                    && $chatroom->authors->count() === $chatroom->authors->filter(function ($author) use ($chatroom, $friends) {
                        return $friends->filter(function ($friend) use ($author) {
                            return $author->user->id === $friend->id;
                        })->count();
                    })->count();
            } else {
                return false;
            }
        });
    }
}
