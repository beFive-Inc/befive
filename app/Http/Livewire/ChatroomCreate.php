<?php

namespace App\Http\Livewire;

use App\Models\Chatroom;
use App\Models\ChatroomUser;
use App\Models\User;
use App\Traits\Operator;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Livewire\Component;

class ChatroomCreate extends Component
{
    use Operator;

    public bool $chooseCreateCanal = false;

    public Collection $friendList;
    public Collection $rememberKeys;
    public Collection $selectedFriends;
    public Collection $preSelectedFriends;

    public string $query = '';
    public string $name = '';

    public function mount()
    {
        $this->selectedFriends = collect();
        $this->rememberKeys = collect();
        $this->preSelectedFriends = $this->preSelectedFriends ?? collect();

        if ($this->preSelectedFriends->count()) {
            $this->preSelectedFriends = $this->removeOwnUser();
            $this->checkIfPreSelectedIsinFriendList();

        }
    }

    /**
     * @return Collection
     */
    public function removeOwnUser(): Collection
    {
         return $this->preSelectedFriends->filter(function ($author) {
            return $author->user->id != auth()->id();
        });
    }

    /**
     * @param User $friend
     * @return void
     */
    public function addOtherFriendToSelectedFriend(User $friend)
    {
        $randomKey = rand(1000, 9999);
        $this->friendList->put($randomKey, User::find($friend->id));
        $this->rememberKeys->put($randomKey, $randomKey);
    }

    /**
     * @return void
     */
    public function checkIfPreSelectedIsinFriendList(): void
    {
        foreach ($this->preSelectedFriends as $preFriend) {
            $check = $this->friendList->contains(function ($friend, $key) use ($preFriend) {
                if ($preFriend->user->id === $friend->id) {
                    $this->rememberKeys->put($key, $key);
                }
                return $preFriend->user->id === $friend->id;
            });
            if (!$check) {
                $this->addOtherFriendToSelectedFriend($preFriend->user);
            }
        }

        $this->refreshSelectedFriend();
    }

    /**
     * @return Collection
     */
    protected function getSortingFriends(): Collection
    {
        return $this->friendList;
    }

    /**
     * @return Collection
     */
    public function getSearchingFriends(): Collection
    {
        return $this->friendList->filter(function ($friend) {
            return $this->likeOperator("%$this->query%", $friend->pseudo);
        });
    }

    /**
     * @param int $key
     * @return void
     */
    public function toggleToChatroom(int $key)
    {
        if ($this->isInTheChatroom($key)) {
            $this->removeFromChatroom($key);
        } else {
            $this->addToChatroom($key);
        }

        $this->refreshSelectedFriend();
    }

    /**
     * @param int $key
     * @return void
     */
    public function addToChatroom(int $key): void
    {
        $this->rememberKeys->put($key, $key);
    }

    /**
     * @param int $key
     * @return void
     */
    public function removeFromChatroom(int $key): void
    {
        $this->rememberKeys->pull($key);
    }

    /**
     * @return void
     */
    public function refreshSelectedFriend(): void
    {
        $this->selectedFriends = $this->friendList->filter(function ($friend, $key) {
            return $this->rememberKeys->filter(function ($f, $k) use ($key) {
                return $k === $key;
            })->count();
        });
    }

    /**
     * @return bool
     */
    public function createChatroom(): bool
    {
        if ($this->selectedFriends->count()) {
            $chatroom = Chatroom::create([
                'uuid' => Str::uuid(),
                'name' => $this->name,
            ]);

            ChatroomUser::create([
                'chatroom_id' => $chatroom->id,
                'user_id' => auth()->id(),
                'status' => ChatroomUser::STATUS_ACCEPTED,
            ]);

            foreach ($this->selectedFriends as $friend) {
                ChatroomUser::create([
                    'chatroom_id' => $chatroom->id,
                    'user_id' => $friend->id,
                    'status' => ChatroomUser::STATUS_ACCEPTED,
                ]);
            }

            $this->redirect(route('chatroom.show', $chatroom->uuid));
        }

        return false;
    }

    /**
     * @param $key
     * @return bool
     */
    public function isInTheChatroom($key): bool
    {
        if (isset($this->rememberKeys[$key])) {
            return $this->rememberKeys[$key] === $key;
        }

        return false;
    }

    /**
     * @return void
     */
    public function createCanal()
    {
        $this->chooseCreateCanal = true;
    }

    /**
     * @return void
     */
    public function createGroup()
    {
        $this->chooseCreateCanal = false;
    }

    public function render()
    {
        if ($this->query) {
            $friends = $this->getSearchingFriends();
        } else {
            $friends = $this->getSortingFriends();
        }

        return view('livewire.chatroom-create', [
            'friends' => $friends,
        ]);
    }
}
