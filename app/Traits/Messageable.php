<?php

namespace App\Traits;

use App\Constant\ChatroomUserStatus;
use Illuminate\Support\Collection;

trait Messageable
{
    /**
     * @param bool $onlySoftDelete
     * @return Collection
     */
    public function getChatrooms(bool $onlySoftDelete = false) : Collection
    {
        $collection = $this->getChatroomsWithAll();

        $collection = $this->getAccepted($collection);

        if ($onlySoftDelete) {
            $collection = $this->getOnlySoftDelete($collection);
        } else {
            $collection = $this->removeSoftDelete($collection);
        }

        return $this->sort($collection);
    }

    /**
     * @param  Collection $collection
     * @return Collection
     */
    public function getAccepted(Collection $collection): Collection
    {
        return $collection->filter(function ($chatroom) {
            return $chatroom->authors->filter(function ($author) {
                return $author->status === ChatroomUserStatus::ACCEPTED;
            })->count();
        });
    }

    /**
     * @param  Collection $collection
     * @return Collection
     */
    public function getPending(Collection $collection): Collection
    {
        return $collection->filter(function ($chatroom) {
            return $chatroom->authors->filter(function ($author) {
                return $author->status === ChatroomUserStatus::PENDING && $author->user_id === auth()->id();
            })->count();
        });
    }

    /**
     * @param  Collection $collection
     * @return Collection
     */
    public function getDenied(Collection $collection): Collection
    {
        return $collection->filter(function ($chatroom) {
            return $chatroom->authors->filter(function ($author) {
                return $author->status === ChatroomUserStatus::DENIED;
            })->count();
        });
    }

    /**
     * @return Collection
     */
    public function getChatroomsWithAll() : Collection
    {
        return $this->chatrooms()
            ->with(['authors.user.sessions', 'messages.author.user'])
            ->get()
            ->filter(function ($chatroom) {
                if ($chatroom->isCanal) {
                    return true;
                } else {
                    return $chatroom->messages->count();
                }
            });
    }

    /**
     * @return Collection
     */
    public function getRequestedCanals() : Collection
    {
        $collection = $this->chatrooms()
            ->with(['authors'])
            ->get();

        return $this->getPending($collection);
    }

    /**
     * @return void
     */
    public function denyCanalRequest(): void
    {
        $this->update([
            'status' => ChatroomUserStatus::DENIED,
        ]);
    }

    /**
     * @return void
     */
    public function acceptCanalRequest(): void
    {
        $this->update([
            'status' => ChatroomUserStatus::ACCEPTED,
        ]);
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
    public function getOnlySoftDelete(Collection $collection): Collection
    {
        return $collection->filter(function ($chatroom) {
            return $chatroom->authors->filter(function ($author) {
                return !empty($author->deleted_at) && $author->user->id === auth()->id();
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
