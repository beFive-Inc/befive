<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Friend extends Component
{
    public $friend;
    public $onlyImageAndName;
    public $actionsToAdd;
    public $actionsToSearch;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($friend, $actionsToAdd = false, $actionsToSearch = false, $onlyImageAndName = false)
    {
        $this->friend = $friend;
        $this->actionsToAdd = $actionsToAdd;
        $this->actionsToSearch = $actionsToSearch;
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
