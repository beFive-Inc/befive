<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Traits\Operator;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Illuminate\Database\Eloquent\Collection;
use function React\Promise\map;

class FriendList extends Component
{
    use Operator;

    public Collection $friendships;
    public int $intervalRefresh = 30 * 1000;
    public bool $generalView = true;
    public $searchQuery;
    protected int $limitFriends = 100;

    protected function getSortingFriends(): Collection
    {
        return auth()->user()->getFriends()->load('media')->sortByDesc(function ($friend) {
            return $friend->isOnline();
        })->take($this->limitFriends);
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

    public function render()
    {
        $requestFriend = $this->getRequestedFriends() ?? null;
        $countFriendsRequest = $requestFriend->count() ?? 0;

        if ($this->searchQuery) {
            $friends = $this->getSearchingFriends($this->friendships);
        } else {
            $friends = $this->getSortingFriends();
        }

        if (!$this->searchQuery) {
            $this->friendships = $friends;
        }

        return view('livewire.friend-list',[
            'friends' => $friends,
            'requestFriends' => $requestFriend,
            'countFriendsRequest' => $countFriendsRequest,
        ]);
    }
}
