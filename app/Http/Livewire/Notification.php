<?php

namespace App\Http\Livewire;

use Illuminate\Support\Collection;
use Livewire\Component;

class Notification extends Component
{
    public Collection $requestedFriends;
    public Collection $requestedCanals;
    public Collection $requestFriends;
    public int $limit = 3;

    protected $listeners = [
        'friendAdded' => 'check'
    ];

    public function check()
    {
        dd('oui');
    }

    /**
     * Get Requested Friends
     *
     * @return Collection
     */
    public function getRequestedFriends(): Collection
    {
        return $this->requestFriends
            ->sortByDesc('created_at')
            ->take($this->limit);
    }

    /**
     * Get Requested Canal
     *
     * @return Collection
     */
    public function getRequestedCanals(): Collection
    {
        return $this->requestFriends
            ->sortByDesc('created_at')
            ->take($this->limit);
    }

    public function render()
    {
        $this->requestedFriends = $this->getRequestedFriends();
        $this->requestedCanals = $this->getRequestedCanals();

        return view('livewire.notification');
    }
}
