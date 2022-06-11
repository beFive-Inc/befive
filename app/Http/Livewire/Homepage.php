<?php

namespace App\Http\Livewire;

use App\Models\Chatroom;
use App\Models\ChatroomUser;
use Illuminate\Support\Collection;
use Livewire\Component;

class Homepage extends Component
{
    public Collection $friends;
    public Collection $chatrooms;

    public Collection $canals;
    public Collection $groups;
    public Collection $conversations;

    public ChatroomUser $ownAuthor;
    public ChatroomUser $otherAuthor;
    public bool $isArchived = false;

    public $listeners = [
        "messageSent" => '$refresh'
    ];

    public function mount()
    {
        $this->canals = $this->chatrooms->filter(function ($chatroom) {
            return $chatroom->isCanal;
        });

        $this->groups = $this->chatrooms->filter(function ($chatroom) {
            return $chatroom->isGroup;
        });

        $this->conversations = $this->chatrooms->filter(function ($chatroom) {
            return $chatroom->isConversation;
        });
    }

    public function render()
    {
        return view('livewire.homepage');
    }
}
