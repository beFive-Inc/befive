<?php

namespace App\Traits;

use App\Models\Chatroom;
use App\Models\ChatroomUser;
use Illuminate\Database\Eloquent\Collection;

trait Messageable
{

    /**
     * @param bool $removeOwnUser Bool for removing Own User
     * @return Collection
     */
    public function getGroups(bool $removeOwnUser = true) : Collection
    {
        $collection = $removeOwnUser ? $this->removeOwnUser() : $this->getGroupsWithAll();

        return $this->sort($collection);
    }

    /**
     * @return Collection
     */
    public function removeOwnUser(): Collection
    {
        return $this->groups()
            ->with('members.user', 'messages', 'name')
            ->get()
            ->each(function ($group) {
                return $group->members = $group->members->filter(function ($member) {
                    return $member->user->id != \Auth::id();
                });
            });
    }

    /**
     * @return Collection
     */
    public function getGroupsWithAll() : Collection
    {
        return $this->groups()
            ->with('members.user', 'messages', 'name')
            ->get();
    }

    public function sort(Collection $collection): Collection
    {
        $newCollection = $this->sortByGroup($collection);
        return $this->sortByCanal($newCollection);
    }

    /**
     * Sort a collection by canal
     *
     * @param Collection $collection
     * @return Collection
     */
    public function sortByCanal(Collection $collection): Collection
    {
        return $collection->sort(function ($a, $b) {
            $al = $a->isCanal;
            $bl = $b->isCanal;
            if ($al == $bl) {
                return 0;
            }
            return ($al < $bl) ? +1 : -1;
        });
    }

    /**
     * Sort a collection by group
     *
     * @param Collection $collection
     * @return Collection
     */
    public function sortByGroup(Collection $collection): Collection
    {
        return $collection->sort(function ($a, $b) {
            $al = $a->isGroup;
            $bl = $b->isGroup;
            if ($al == $bl) {
                return 0;
            }
            return ($al < $bl) ? +1 : -1;
        });
    }

}
