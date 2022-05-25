<?php

namespace App\Events;

use App\Models\Chatroom;
use App\Models\ChatroomUser;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $uuid;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message, $uuid)
    {
        $this->message = $message;
        $this->uuid = $uuid;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PresenceChannel('chatroom.' . $this->uuid);
    }

    public function broadcastWith()
    {
        return ['message' => $this->message->append(['date'])->toArray()];
    }
}
