<?php

namespace App\Http\Livewire;

use App\Models\ChatroomUser;
use App\Models\User;
use Illuminate\Support\Collection;
use Livewire\Component;

class Notification extends Component
{
    public int $limit = 2;
    public Collection $requestCanals;
    public Collection $requestFriends;
    public Collection $requestedCanals;
    public Collection $requestedFriends;

    protected $listeners = [
        'friendAdded' => 'check'
    ];

    public function mount()
    {
        $this->requestedCanals = $this->requestCanals->take($this->limit);
        $this->requestedFriends = $this->requestFriends->take($this->limit);
    }

    /**
     * @return void
     */
    public function check()
    {
        $this->requestCanals = $this->getRequestedCanals();
        $this->requestedCanals = $this->requestCanals->take($this->limit);
        $this->requestFriends = $this->getRequestedFriends();
        $this->requestedFriends = $this->requestFriends->take($this->limit);
    }


    /**
     * @return void
     */
    public function acceptCanal(int $authorID)
    {
        $user = ChatroomUser::find($authorID);

        $user->acceptCanalRequest();

        $this->requestCanals = $this->getRequestedCanals();
        $this->requestedCanals = $this->requestCanals->take($this->limit);
    }

    /**
     * @return void
     */
    public function denyCanal(int $authorID)
    {
        $user = ChatroomUser::find($authorID);

        $user->denyCanalRequest();

        $this->requestCanals = $this->getRequestedCanals();
        $this->requestedCanals = $this->requestCanals->take($this->limit);
    }

    /**
     * @param string $uuid
     * @return void
     */
    public function acceptFriend(string $uuid)
    {
        $user = User::where('uuid', '=', $uuid)
            ->first();

        auth()->user()->acceptFriendRequest($user);

        $this->emit('friendRefresh');

        $this->requestFriends = $this->getRequestedFriends();
        $this->requestedFriends = $this->requestFriends->take($this->limit);
    }

    /**
     * @param string $uuid
     * @return void
     */
    public function denyFriend(string $uuid)
    {
        $user = User::where('uuid', '=', $uuid)
            ->first();

        auth()->user()->denyFriendRequest($user);

        $this->requestFriends = $this->getRequestedFriends();
        $this->requestedFriends = $this->requestFriends->take($this->limit);
    }

    /**
     * Get Requested Friends
     *
     * @return Collection
     */
    public function getRequestedFriends(): Collection
    {
        return auth()->user()
            ->getFriendRequests()
            ->map(function ($user) {
                return User::find($user->sender_id);
            });
    }

    /**
     * Get Requested Canal
     *
     * @return Collection
     */
    public function getRequestedCanals(): Collection
    {
        return auth()
            ->user()
            ->getRequestedCanals();
    }

    public function render()
    {
        return view('livewire.notification');
    }
}
