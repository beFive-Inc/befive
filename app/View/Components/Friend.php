<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\View\Component;

class Friend extends Component
{
    public User $friend;
    public bool $actions;
    public bool $options;
    public bool $isFriend;
    public bool $isAsked;
    public bool $isBlocked;
    public bool $getStatusMessage;
    public bool $onlyImageAndName;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(User $friend, bool $actions = true, bool $options = false, bool $isFriend = false, bool $isAsked = false, bool $isBlocked = false, bool $getStatusMessage = false, bool $onlyImageAndName = false)
    {
        $this->friend = $friend;
        $this->actions = $actions;
        $this->options = $options;
        $this->isFriend = $isFriend;
        $this->isAsked = $isAsked;
        $this->isBlocked = $isBlocked;
        $this->getStatusMessage = $getStatusMessage;
        $this->onlyImageAndName = $onlyImageAndName;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.friend');
    }
}
