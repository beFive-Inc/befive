<?php

namespace App\View\Components;

use App\Models\Chatroom;
use Illuminate\View\Component;

class GroupMessage extends Component
{
    public Chatroom $chatroom;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Chatroom $chatroom)
    {
        $this->chatroom = $chatroom;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.conversations.group-message');
    }
}
