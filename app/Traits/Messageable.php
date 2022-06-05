<?php

namespace App\Traits;

use App\Models\Chatroom;
use App\Models\ChatroomUser;
use Illuminate\Support\Collection;


trait Messageable
{

    /**
     * @param bool $removeSoftDelete Bool for removing soft delete
     * @return Collection
     */
    public function getChatrooms(bool $removeSoftDelete = true) : Collection
    {
        $collection = $this->getChatroomsWithAll();

        if ($removeSoftDelete) {
            $collection = $this->removeSoftDelete($collection);
        }

        return $this->sort($collection);
    }

    /**
     * @return Collection
     */
    public function getChatroomsWithAll() : Collection
    {
        return $this->chatrooms()
            ->with(['authors.user', 'messages.author.user'])
            ->get();
    }

    /**
     * @param Collection $collection
     * @return Collection
     */
    public function removeSoftDelete(Collection $collection): Collection
    {
        return $collection->filter(function ($chatroom) {
            return $chatroom->authors->filter(function ($author) {
                return empty($author->deleted_at) && $author->user->id === auth()->id();
            })->count();
        });
    }

    /**
     * @param Collection $collection
     * @return Collection
     */
    public function sort(Collection $collection): Collection
    {
        return $this->orderByCreatedAt($collection);
    }

    /**
     * Group a collection by canal
     *
     * @param Collection $collection
     * @return Collection
     */
    public function groupByCanal(Collection $collection): Collection
    {
        return $collection->groupBy(function ($chatroom) {
            return $chatroom->isCanal;
        })->collapse();
    }

    /**
     * Group a collection by group
     *
     * @param Collection $collection
     * @return Collection
     */
    public function groupByGroup(Collection $collection): Collection
    {
        return $collection->groupBy(function ($chatroom) {
            return $chatroom->isGroup;
        })->collapse();
    }

    /**
     * Group a collection by conversation
     *
     * @param Collection $collection
     * @return Collection
     */
    public function groupByConversation(Collection $collection): Collection
    {
        return $collection->groupBy(function ($chatroom) {
            return $chatroom->isConversation;
        })->collapse();
    }

    /**
     * Order by created_at collection
     *
     * @param Collection $collection
     * @return Collection
     */
    public function orderByCreatedAt(Collection $collection): Collection
    {
        return $collection->sort(function ($a, $b) {
            $al = $a->messages->first()->created_at;
            $bl = $b->messages->first()->created_at;

            if ($al == $bl) {
                return 0;
            }
            return ($al < $bl) ? +1 : -1;
        });
    }

}
