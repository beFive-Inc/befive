<?php

namespace App\Http\Livewire;

use App\Models\Chatroom;
use App\Models\ChatroomUser;
use Illuminate\Support\Collection;
use Livewire\Component;

class ConversationMessage extends Component
{
    public Chatroom $chatroom;
    public Collection $friends;
    public Collection $allChatrooms;
    public ChatroomUser $ownAuthor;
    public ChatroomUser $otherAuthor;
    public bool $isArchived = false;

    public $listeners = [
        "messageSent" => '$refresh'
    ];

    public function mount()
    {
        $this->ownAuthor = $this->chatroom
            ->authors
            ->filter(function ($author) {
                return $author->user->id === auth()->id();
            })->first();

        $this->otherAuthor = $this->chatroom
            ->authors
            ->filter(function ($author) {
                return $author->user->id != auth()->id();
            })->first();
    }

    public function render()
    {
        return view('livewire.conversation-message');
    }
}
