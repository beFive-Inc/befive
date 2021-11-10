<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Illuminate\Database\Eloquent\Collection;
use function React\Promise\map;

class FriendList extends Component
{
    public Collection $friendships;
    public int $intervalRefresh = 30 * 1000;
    public bool $requestedView = false;
    public bool $generalView = true;
    public bool $onlineView = false;
    public bool $offlineView = false;
    public $searchQuery;
    protected int $limitFriends = 100;

    protected function getSortingFriends(): Collection
    {
        return auth()->user()->getFriends()->sortByDesc(function ($friend) {
            return $friend->isOnline();
        })->take($this->limitFriends);
    }

    protected function likeOperator($pattern, $subject): bool
    {
        $pattern = str_replace('%', '.*', preg_quote($pattern, '/'));
        return preg_match("/^{$pattern}$/i", $subject);
    }

    protected function getSearchingFriends($friends): Collection
    {
        return $friends->filter(function ($friend) {
            return $this->likeOperator("%$this->searchQuery%", $friend->pseudo);
        });
    }

    protected function getRequestedFriends(): Collection
    {
        return auth()->user()
            ->getFriendRequests()
            ->sortByDesc('created_at')
            ->map(function ($user) {
                return User::find($user->sender_id);
            })->take($this->limitFriends);
    }

    protected function getOnlineFriends(): Collection
    {
        return auth()->user()
            ->getOnlineFriends()
            ->sortByDesc(function ($user) {
                return $user->pseudo;
            })->take($this->limitFriends);
    }

    protected function getOfflineFriends(): Collection
    {
        return auth()->user()
            ->getOfflineFriends()
            ->sortByDesc(function ($user) {
                return $user->pseudo;
            });
    }

    public function isFriendWith($friendID): bool
    {
        return auth()->user()->isFriendWith(User::find($friendID));
    }

    public function acceptFriendRequest($friendID): void
    {
        auth()->user()->acceptFriendRequest(User::find($friendID));
        $this->refresh();
    }

    public function denyFriendRequest($friendID): void
    {
        auth()->user()->denyFriendRequest(User::find($friendID));
        $this->refresh();
    }

    public function refresh(): void
    {
        $this->friendships->map(function ($friend) {
            return Cache::get('user-is-online-' . $friend->id);
        });
    }

    public function getRequestedView(): void
    {
        $this->requestedView = true;
        $this->generalView = false;
        $this->onlineView = false;
        $this->offlineView = false;
    }

    public function getGeneralView(): void
    {
        $this->generalView = true;
        $this->requestedView = false;
        $this->onlineView = false;
        $this->offlineView = false;
    }

    public function getOnlineView(): void
    {
        $this->onlineView = true;
        $this->generalView = false;
        $this->requestedView = false;
        $this->offlineView = false;
    }

    public function getOfflineView(): void
    {
        $this->offlineView = true;
        $this->generalView = false;
        $this->requestedView = false;
        $this->onlineView = false;
    }

    public function render()
    {
        if ($this->searchQuery) {
            $friends = $this->getSearchingFriends($this->friendships);
        } elseif ($this->generalView) {
            $friends = $this->getSortingFriends();
        } elseif ($this->requestedView) {
            $friends = $this->getRequestedFriends();
        } elseif ($this->onlineView) {
            $friends = $this->getOnlineFriends();
        } elseif ($this->offlineView) {
            $friends = $this->getOfflineFriends();
        } else {
            $friends = $this->getSortingFriends();
        }

        $this->friendships = $friends;

        return view('livewire.friend-list',[
            'friends' => $friends,
        ]);
    }
}
