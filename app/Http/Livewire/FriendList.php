<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Traits\Operator;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class FriendList extends Component
{
    use Operator;

    public EloquentCollection $friends;
    public EloquentCollection $friendships;
    public EloquentCollection $friendRequests;
    public EloquentCollection $friendBlocked;

    public string $searchQuery = '';

    public Collection $navItems;

    protected int $limitFriends = 100;
    public int $intervalRefresh = 30 * 1000;

    public function mount()
    {
        $this->friendRequests = auth()->user()->getFriendRequests();
        $this->friendships = auth()->user()->getFriends()->load('media');
        $this->friendBlocked = auth()->user()->getBlockedFriendships();

        $this->navItems = collect([
            'all' => [
                'isActive' => true,
                'title' => __('friends.all.title'),
                'method' => 'getSortingFriends',
            ],
            'online' => [
                'isActive' => false,
                'title' => __('friends.online.title'),
                'method' => 'getOnlineFriends',
            ],
            'request' => [
                'isActive' => false,
                'title' => __('friends.request.title'),
                'method' => 'getRequestedFriends',
            ],
            'blocked' => [
                'isActive' => false,
                'title' => __('friends.block.title'),
                'method' => 'getBlockedFriends',
            ]
        ]);
    }

    protected function getSortingFriends(): EloquentCollection
    {
        return $this->friendships->sortByDesc(function ($friend) {
            return $friend->isOnline();
        })->take($this->limitFriends);
    }

    protected function getSearchingFriends()
    {
        $this->friends = $this->friends->filter(function ($friend) {
            return $this->likeOperator("%$this->searchQuery%", $friend->pseudo);
        });
    }

    protected function getBlockedFriends(): EloquentCollection
    {
        return $this->friendBlocked;
    }

    protected function getRequestedFriends(): EloquentCollection
    {
        return $this->friendRequests
            ->sortByDesc('created_at')
            ->take($this->limitFriends);
    }

    protected function getOnlineFriends(): EloquentCollection
    {
        return $this->friendships->filter(function ($friend) {
            return $friend->isOnline();
        });
    }

    public function changeData(string $key)
    {
        foreach ($this->navItems as $k => $item) {
            $this->navItems = $this->navItems->replaceRecursive([$k => [
                'isActive' => false,
            ]]);
        }
        $this->navItems = $this->navItems->replaceRecursive([$key => [
            'isActive' => true,
        ]]);

        $this->changeFriendList();
    }

    protected function changeFriendList()
    {
        foreach ($this->navItems as $item) {
            if ($item['isActive']) {
                $this->friends = $this->{$item['method']}();
            }

        }
    }

    public function isFriendWith($friendID): bool
    {
        return auth()->user()->isFriendWith(User::find($friendID));
    }

    public function acceptFriendRequest($friendID): void
    {
        auth()->user()->acceptFriendRequest(User::find($friendID));
    }

    public function denyFriendRequest($friendID): void
    {
        auth()->user()->denyFriendRequest(User::find($friendID));
    }

    public function render()
    {
        if ($this->searchQuery) {
            $this->getSearchingFriends();
        } else {
            $this->changeFriendList();
        }

        return view('livewire.friend-list');
    }
}
