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
    public Chatroom $selectedChatroom;

    public Collection $canals;
    public Collection $groups;
    public Collection $conversations;

    protected function getListeners(): array
    {
        $listeners = [];

        foreach ($this->chatrooms as $chatroom) {
            $listeners["messageSent-$chatroom->uuid"] = '$refresh';
        }

        return $listeners;
    }

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
        $this->selectedChatroom = $this->chatrooms->first();
    }

    /**
     * @param string $uuid
     * @return void
     */
    public function changeSelectedChatroom(string $uuid)
    {
        $this->selectedChatroom = $this->chatrooms->filter(function ($chatroom) use ($uuid) {
            return $chatroom->uuid === $uuid;
        })->first();

        $this->emit('changeChatroom', $uuid);
    }

    public function render()
    {
        return view('livewire.homepage');
    }
}
