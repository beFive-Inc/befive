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
    public EloquentCollection $pendingFriends;

    public string $searchQuery = '';

    public Collection $navItems;

    protected int $limitFriends = 100;
    public int $intervalRefresh = 30 * 1000;

    public function mount()
    {
        $this->pendingFriends = auth()->user()
            ->getPendingFriendships();
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
            'sended' => [
                'isActive' => false,
                'title' => __('friends.sended.title'),
                'method' => 'getPendingRequestFriends',
            ],
            'blocked' => [
                'isActive' => false,
                'title' => __('friends.block.title'),
                'method' => 'getBlockedFriends',
            ]
        ]);
    }

    /**
     * @return EloquentCollection
     */
    protected function getSortingFriends(): EloquentCollection
    {
        return $this->friendships->sortByDesc(function ($friend) {
            return $friend->isOnline();
        })->take($this->limitFriends);
    }

    /**
     * @return void
     */
    protected function getSearchingFriends(): void
    {
        $this->friends = $this->friends->filter(function ($friend) {
            return $this->likeOperator("%$this->searchQuery%", $friend->pseudo);
        });
    }

    /**
     * @return EloquentCollection
     */
    protected function getBlockedFriends(): EloquentCollection
    {
        return $this->friendBlocked;
    }

    /**
     * @return EloquentCollection
     */
    protected function getRequestedFriends(): EloquentCollection
    {
        return $this->friendRequests
            ->sortByDesc('created_at')
            ->take($this->limitFriends);
    }

    /**
     * @return EloquentCollection
     */
    protected function getPendingRequestFriends(): EloquentCollection
    {
        return auth()->user()
            ->getPendingFriendships()
            ->filter(function ($friend) {
                return $friend->recipient_id != auth()->id();
            })->map(function ($user) {
                return User::find($user->recipient_id);
            });
    }

    /**
     * @return EloquentCollection
     */
    protected function getOnlineFriends(): EloquentCollection
    {
        return $this->friendships->filter(function ($friend) {
            return $friend->isOnline();
        });
    }

    /**
     * @param string $key
     * @return void
     */
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

    /**
     * @return void
     */
    protected function changeFriendList(): void
    {
        foreach ($this->navItems as $item) {
            if ($item['isActive']) {
                $this->friends = $this->{$item['method']}();
            }
        }
    }

    /**
     * @param int $friendID
     * @return bool
     */
    public function isFriendWith(int $friendID): bool
    {
        return auth()->user()->isFriendWith(User::find($friendID));
    }

    /**
     * @param int $friendID
     * @return void
     */
    public function acceptFriendRequest(int $friendID): void
    {
        auth()->user()->acceptFriendRequest(User::find($friendID));
    }

    /**
     * @param int $friendID
     * @return void
     */
    public function denyFriendRequest(int $friendID): void
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
