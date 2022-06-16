<?php

namespace App\Http\Livewire;

use App\Events\MessageSent;
use App\Models\ChatroomUser;
use App\Models\Message;
use App\Models\Chatroom as ChatroomModel;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Chatroom extends Component
{
    use WithFileUploads;

    public ChatroomModel $chatroom;
    public ChatroomUser $authIngroup;
    public Collection $otherIngroup;
    public string $message = '';

    public $relatedMessage;

    public bool $isSender = false;

    public Collection $messages;

    public $files;

    protected $listeners = [
        'messageSent' => 'EchoGetMessage',
        'changeChatroom' => 'changeChatroom',
        'resfreshMessage' => 'resfreshMessage',
    ];

    public function mount()
    {
        $this->relatedMessage = collect([]);
        $this->chatroom = $this->chatroom ?? auth()->user()->getChatrooms()->first();
        $this->authIngroup = $this->chatroom->authors->filter(function ($author) {
            return $author->user_id === auth()->id();
        })->first();
        $this->otherIngroup = $this->chatroom->authors->filter(function ($author) {
            return $author->user_id != auth()->id();
        });
        $this->messages = $this->chatroom->messages;
    }

    public function EchoGetMessage($message)
    {
        if (!$this->isSender) {
            $this->messages->prepend(Message::find($message['id']));
        }
        $this->resetIsSender();
    }

    public function resfreshMessage()
    {
        $this->messages = $this->chatroom->messages;
    }

    /**
     * @param string $uuid
     * @return void
     */
    public function changeChatroom(string $uuid)
    {
        $this->chatroom = ChatroomModel::where('uuid', '=', $uuid)
            ->first();

        $this->authIngroup = $this->chatroom->authors->filter(function ($author) {
            return $author->user_id === auth()->id();
        })->first();

        $this->otherIngroup = $this->chatroom->authors->filter(function ($author) {
            return $author->user_id != auth()->id();
        });

        $this->authIngroup->update([
            'view_at' => Carbon::now(),
        ]);

        $this->messages = $this->chatroom->messages;
    }

    /**
     * @param string $url
     * @return string
     */
    public function getTemporaryRealUrl(string $url): string
    {
        return Str::replace('livewire/preview-file', 'livewire-tmp', $url);
    }

    public function deleteFileFromArray(int $key)
    {
        unset($this->files[$key]);
    }

    public function setViewAt()
    {
        $this->authIngroup->view_at = Carbon::now();
        $this->authIngroup->save();
    }

    public function update()
    {
        $this->validate([
            'files.*' => 'max:4096', // 2MB Max
        ]);
    }

    public function save()
    {
        if (empty($this->message)) {
            $message = Message::create([
                'chatroom_user_id' => $this->authIngroup->id,
                'message_id' => $this->relatedMessage->count() ? $this->relatedMessage->id : null,
                'message' => Crypt::encrypt($this->message),
                'type' => 'message'
            ]);

            $this->message = '';

            $this->messages->prepend($message);

            $this->isSenderToTrue();

            if ($this->files) {
                foreach ($this->files as $file) {
                    $message->addMedia($file)
                        ->toMediaCollection('message');
                }
            }

            $this->authIngroup->update([
                'view_at' => Carbon::now(),
            ]);

            broadcast(new MessageSent($message, $this->chatroom->uuid));

            if ($this->messages->count() === 1) {
                foreach ($this->otherIngroup as $author) {
                    broadcast(new \App\Events\ChatroomCreated($this->chatroom, $author->user->uuid));
                }
            }

            $this->files = [];
        } else {
            $message = Message::create([
                'chatroom_user_id' => $this->authIngroup->id,
                'message_id' => $this->relatedMessage->count() ? $this->relatedMessage->id : null,
                'message' => Crypt::encrypt($this->message),
                'type' => 'message'
            ]);

            $this->message = '';

            $this->messages->prepend($message);

            $this->isSenderToTrue();

            if ($this->files) {
                foreach ($this->files as $file) {
                    $message->addMedia($file)
                        ->toMediaCollection('message');
                }
            }

            $this->authIngroup->update([
                'view_at' => Carbon::now(),
            ]);

            broadcast(new MessageSent($message, $this->chatroom->uuid));

            if ($this->messages->count() === 1) {
                foreach ($this->otherIngroup as $author) {
                    broadcast(new \App\Events\ChatroomCreated($this->chatroom, $author->user->uuid));
                }
            }

            $this->files = [];
        }

        $this->unsetRelatedMessage();
    }


    public function setRelatedMessage(int $id)
    {
        $this->relatedMessage = Message::where('id', '=', $id)
            ->first();
    }

    public function unsetRelatedMessage()
    {
        $this->relatedMessage = collect([]);
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
        if (Str::contains($this->message, 'https://www.youtube.com/')
            || Str::contains($this->message, 'www.youtube.com/')
            || Str::contains($this->message, 'youtube.com/')) {

        }
        if (Str::contains($this->message,'@')) {
            $content = Str::after($this->message, '@');

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
