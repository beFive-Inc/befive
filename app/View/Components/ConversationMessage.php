<?php

namespace App\View\Components;

use App\Models\Chatroom;
use App\Models\ChatroomUser;
use Illuminate\View\Component;

class ConversationMessage extends Component
{
    public bool $isArchived;
    public Chatroom $chatroom;
    public ChatroomUser $ownAuthor;
    public ChatroomUser $otherAuthor;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Chatroom $chatroom, ChatroomUser $ownAuthor, ChatroomUser $otherAuthor, bool $isArchived = false)
    {
        $this->chatroom = $chatroom;
        $this->ownAuthor = $ownAuthor;
        $this->otherAuthor = $otherAuthor;
        $this->isArchived = $isArchived;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.conversations.conversation-message');
    }
}
