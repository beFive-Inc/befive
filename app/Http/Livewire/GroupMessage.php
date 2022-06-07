<?php

namespace App\Http\Livewire;

use App\Models\Chatroom;
use Illuminate\Support\Collection;
use Livewire\Component;

class GroupMessage extends Component
{
    public Chatroom $chatroom;
    public Collection $allChatrooms;
    public Collection $friends;

    public $listeners = [
        "messageSent" => '$refresh'
    ];

    public function render()
    {
        return view('livewire.group-message');
    }
}
