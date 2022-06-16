<?php

namespace App\View\Components;

use App\Models\Chatroom;
use Illuminate\View\Component;

class Canal extends Component
{
    public Chatroom $chatroom;
    public bool $settings;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Chatroom $chatroom, bool $settings = false)
    {
        $this->chatroom = $chatroom;
        $this->settings = $settings;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.conversations.canal');
    }
}
