<?php

namespace App\Http\Livewire;

use App\Constant\ChatroomStatus;
use App\Constant\ChatroomType;
use App\Models\Message;
use App\Models\User;
use App\Traits\Operator;
use Illuminate\Support\Collection;
use Livewire\Component;
use App\Models\Chatroom;

class SearchBar extends Component
{
    use Operator;
    const LIMIT = 5;
    const SUGGEST_LIMIT = 15;

    public Collection $suggestsFriends;
    public Collection $suggestsCanals;
    public Collection $friends;
    public Collection $others;
    public Collection $canals;

    public Collection $ownFriends;

    public string $query = '';

    public bool $isShowed;

    public function mount()
    {
        $this->isShowed = false;
    }

    /**
     * @return void
     */
    public function show(): void
    {
        $this->isShowed = true;
    }

    /**
     * @return void
     */
    public function hide(): void
    {
        $this->isShowed = false;
    }

    /**
     * @return Collection
     */
    public function showSuggestsFriends(): Collection
    {
        return auth()->user()
            ->getFriendsOfFriends()
            ->load('media')
            ->diffKeys($this->ownFriends)
            ->take(self::SUGGEST_LIMIT / 2);
    }

    /**
     * @return Collection
     */
    public function showSuggestsCanals(): Collection
    {
        return Chatroom::where('type', '=', ChatroomType::CANAL)
            ->where('status', '=', ChatroomStatus::PUBLIC)
            ->get()
            ->take(self::SUGGEST_LIMIT / 2);
    }

    /**
     * @return Collection
     */
    public function getSearchingFriends(): Collection
    {
        return $this->ownFriends->filter(function ($friend) {
            return $this->likeOperator("%$this->query%", $friend->pseudo);
        })->take(self::LIMIT);
    }

    /**
     * @return Collection
     */
    public function getOtherPeople(): Collection
    {
        return User::where('pseudo', 'LIKE', "%$this->query%")
            ->whereNotIn('id', $this->ownFriends->map(function ($friend) {
                return $friend->id;
            }))
            ->whereNotIn('id', [auth()->id()])
            ->limit(self::LIMIT)
            ->get();
    }

    public function getCanals()
    {
        return Chatroom::with('authors')
            ->where('type', '=', ChatroomType::CANAL)
            ->where('status', '=', ChatroomStatus::PUBLIC)
            ->where('name', 'LIKE', "%$this->query%")
            ->limit(self::LIMIT)
            ->get();
    }

    public function render()
    {
        if (empty($this->query)) {
            $this->suggestsFriends = $this->showSuggestsFriends();
            $this->suggestsCanals = $this->showSuggestsCanals();
        } else {
            $this->friends = $this->getSearchingFriends();
            $this->others = $this->getOtherPeople();
            $this->canals = $this->getCanals();
        }

        return view('livewire.search-bar');
    }
}
