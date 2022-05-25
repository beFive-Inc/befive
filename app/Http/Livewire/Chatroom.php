<?php

namespace App\Http\Livewire;

use App\Events\MessageSent;
use App\Models\ChatroomUser;
use App\Models\Message;
use App\Models\Chatroom as ChatroomModel;
use Livewire\Component;

class Chatroom extends Component
{
    public ChatroomModel $chatroom;
    public ChatroomUser $authIngroup;
    public $message;

    public $messages;

    protected $listeners = [
        'messageSent' => 'addMessage',
    ];

    public function mount()
    {
        $this->messages = $this->chatroom->messages;
    }

    public function send()
    {
        $message = Message::create([
            'group_member_id' => $this->authIngroup->id,
            'message_id' => null,
            'message' => $this->message,
            'type' => 'message'
        ]);

        $this->message = '';

        broadcast(new MessageSent($message, $this->chatroom->uuid));
    }

    public function check()
    {
        $specialCharacter = \Str::contains($this->message,' @');

        if ($specialCharacter) {
            dd($specialCharacter);
        }
    }

    public function addMessage($message)
    {
        $realMessage = Message::find($message['id']);
        $this->messages->push($realMessage);
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
