<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FriendList extends Component
{
    public $generalView = true;
    public $intervalRefresh = 30 * 1000;
    protected $limitFriends = 20;
    protected $requestedView = false;
    protected $refreshed = false;


    public function getSortingFriends()
    {
        return auth()->user()->getFriends()->sortByDesc(function ($friend) {
            return $friend->isOnline();
        })->take($this->limitFriends);
    }

    public function getRequestedFriends()
    {
        return auth()->user()->getFriendRequests();
    }

    public function refresh() {
        $this->refreshed = true;
    }

    public function getRequestedView()
    {
        $this->generalView = false;
        $this->requestedView = true;
    }

    public function getGeneralView()
    {
        $this->generalView = true;
        $this->requestedView = false;
    }

    public function render()
    {
        if ($this->generalView) {
            $friends = $this->getSortingFriends();
            if ($this->refreshed) {
                $friends = $this->getSortingFriends();
                $this->refreshed = false;
            }
        } elseif ($this->requestedView) {
            $friends = $this->getRequestedFriends();
        } else {
            $friends = $this->getSortingFriends();
        }

        return view('livewire.friend-list',[
            'friends' => $friends,
        ]);
    }
}
