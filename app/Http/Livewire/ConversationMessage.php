<?php

namespace App\Http\Livewire;

use App\Models\Chatroom;
use Illuminate\Support\Collection;
use Livewire\Component;

class ConversationMessage extends Component
{
    public Chatroom $chatroom;
    public Collection $friends;

    public $listeners = [
        "messageSent" => '$refresh'
    ];

    public function render()
    {
        return view('livewire.conversation-message');
    }
}
