<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Collection;

class Header extends Component
{
    public Collection $medias;
    public Collection $friends;
    public Collection $chatrooms;
    public Collection $requestCanals;
    public Collection $requestFriends;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Collection $friends, Collection $requestFriends, Collection $medias, Collection $chatrooms, Collection $requestCanals)
    {
        $this->medias = $medias;
        $this->friends = $friends;
        $this->chatrooms = $chatrooms;
        $this->requestCanals = $requestCanals;
        $this->requestFriends = $requestFriends;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.header');
    }
}
