<?php

namespace App\View\Components;

use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Layout extends Component
{
    public Collection $friends;
    public Collection $requestFriends;
    public Collection $medias;
    public Collection $chatrooms;
    public Collection $requestedCanals;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Collection $friends, Collection $requestFriends, Collection $medias, Collection $chatrooms, Collection $requestedCanals)
    {
        $this->friends = $friends;
        $this->requestFriends = $requestFriends;
        $this->medias = $medias;
        $this->chatrooms = $chatrooms;
        $this->requestedCanals = $requestedCanals;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.layout.layout');
    }
}
