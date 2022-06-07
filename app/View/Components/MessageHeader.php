<?php

namespace App\View\Components;

use App\Models\Chatroom;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class MessageHeader extends Component
{
    public Chatroom $chatroom;
    public Collection $otherInGroup;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Chatroom $chatroom, Collection $otherInGroup)
    {
        $this->chatroom = $chatroom;
        $this->otherInGroup = $otherInGroup;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.message-header');
    }
}
