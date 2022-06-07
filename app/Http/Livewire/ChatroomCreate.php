<?php

// TODO: search-bar actions

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

    public Collection $allChatroom;
    public bool $chooseCreateCanal = false;

    public Collection $friendList;
    public Collection $rememberKeys;
    public Collection $rememberPreSelectKeys;
    public Collection $selectedFriends;
    public Collection $preSelectedFriends;
    public bool $preSelectedFriendsAreRequired = false;

    public string $query = '';
    public string $name = '';
    public string $error = '';

    public function mount()
    {
        $this->selectedFriends = collect();
        $this->rememberKeys = collect();
        $this->preSelectedFriends = $this->preSelectedFriends ?? collect();

        if ($this->preSelectedFriends->count()) {
            $this->preSelectedFriends = $this->removeOwnUser();
            $this->getUserFromPreselected();
        }
    }

    /**
     * @return void
     */
    public function getUserFromPreselected(): void
    {
        $this->preSelectedFriends = $this->preSelectedFriends->map(function ($author) {
            return $author->user;
        });
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
     * @return void
     */
    public function addOwnUser(): void
    {
        $this->selectedFriends->push(auth()->user());
    }

    /**
     * @param User $friend
     * @return void
     */
    public function addOtherFriendToSelectedFriend(User $friend)
    {
        $addFriend = User::find($friend->id);
        $this->friendList->push($addFriend);

        $this->friendList->search(function ($friend, $key) use ($addFriend) {
            if ($friend->id === $addFriend->id) {
                $this->rememberKeys->put($key, $key);
                $this->setKey($key,'key', $key);
                if ($this->preSelectedFriendsAreRequired) {
                    $this->setKey($key, 'isRequired', true);
                }
            }
        });
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
                    $this->setKey($key, 'key', $key);
                    if ($this->preSelectedFriendsAreRequired) {
                        $this->setKey($key, 'isRequired', true);
                    }
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
    }

    /**
     * @param int $key
     * @return void
     */
    public function addToChatroom(int $key): void
    {
        $this->rememberKeys->put($key, $key);
        $this->setKey($key, 'key', $key);
        $this->resetError();
        $this->refreshSelectedFriend();
    }

    /**
     * @param int $key
     * @return void
     */
    public function removeFromChatroom(int $key): void
    {
        $this->rememberKeys->pull($key);
        $this->setKey($key, 'key', null);
        $this->resetError();
        $this->refreshSelectedFriend();
    }

    /**
     * @param int $key
     * @param $value
     * @return void
     */
    public function setKey(int $key, string $attribute, $value): void
    {
        $this->friendList[$key]->{$attribute} = $value;
    }

    /**
     * @return void
     */
    public function resetError(): void
    {
        $this->error = '';
    }

    /**
     * @return void
     */
    public function refreshSelectedFriend(): void
    {
        $this->selectedFriends = $this->friendList->filter(function ($friend, $key) {
            return $this->rememberKeys->filter(function ($f, $k) use ($key) {
                $this->setKey($k, 'key', $k);
                return $k === $key;
            })->count();
        });
    }

    /**
     * @return Collection
     */
    public function checkIfAChatroomExist(): Collection
    {
        return $this->allChatroom->filter(function ($chatroom) {
            return $chatroom->authors->count() === $this->selectedFriends->count()
                && $chatroom->authors->count() === $chatroom->authors->filter(function ($author) {
                    return $this->selectedFriends->filter(function ($friend) use ($author) {
                        return $author->user->id === $friend->id;
                    })->count();
                })->count();
        });
    }


    public function createChatroom()
    {
        $this->addOwnUser();
        $isAlreadyAChatroom = $this->checkIfAChatroomExist();

        if ($isAlreadyAChatroom->count()) {
            $this->redirect(route('chatroom.show', $isAlreadyAChatroom->first()->uuid));

        } elseif($this->selectedFriends->count()) {
            $chatroom = Chatroom::create([
                'uuid' => Str::uuid(),
                'name' => $this->name,
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

        $this->error = __('validation.chatroom.create');

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
