<?php

namespace App\Http\Livewire;

use App\Events\MessageSent;
use App\Models\ChatroomUser;
use App\Models\Message;
use App\Models\Chatroom as ChatroomModel;
use Illuminate\Support\Collection;
use Livewire\Component;

class Chatroom extends Component
{
    public ChatroomModel $chatroom;
    public ChatroomUser $authIngroup;
    public string $message = '';

    public bool $isSender = false;

    public Collection $messages;

    protected $listeners = [
        'messageSent' => 'EchoGetMessage',
    ];

    public function mount()
    {
        $this->messages = $this->chatroom->messages;
    }

    public function EchoGetMessage($message)
    {
        if (!$this->isSender) {
            $this->messages->prepend(Message::find($message['id']));
        }
        $this->resetIsSender();
    }

    public function send()
    {
        $message = Message::create([
            'chatroom_user_id' => $this->authIngroup->id,
            'message_id' => null,
            'message' => $this->message,
            'type' => 'message'
        ]);

        $this->message = '';

        $this->messages->prepend($message);

        $this->isSenderToTrue();

        broadcast(new MessageSent($message, $this->chatroom->uuid));
    }

    public function isSenderToTrue()
    {
        $this->isSender = true;
    }

    public function resetIsSender()
    {
        $this->isSender = false;
    }

    public function check()
    {
        if (\Str::contains($this->message,'@')) {

        }
    }

    public function render()
    {
        return view(
            'livewire.chatroom',
            [
                'messages' => $this->messages,
                'authInGroup' => $this->authIngroup
            ]
        );
    }
}
