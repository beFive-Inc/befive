<?php

namespace App\Http\Livewire;

use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Collection;
use Livewire\Component;

class SearchBar extends Component
{
    const LIMIT = 5;
    const SUGGEST_LIMIT = 15;

    public Collection $suggests;
    public Collection $friends;
    public Collection $others;
    public Collection $messages;

    public Collection $ownFriends;

    public string $query;

    public bool $isShowed;

    public function mount()
    {
        $this->isShowed = false;
        $this->query = '';

        $this->ownFriends = \Auth::user()->getFriends();
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
     * @param $pattern
     * @param $subject
     * @return bool
     */
    public function likeOperator($pattern, $subject): bool
    {
        $pattern = str_replace('%', '.*', preg_quote($pattern, '/'));
        return preg_match("/^{$pattern}$/i", $subject);
    }

    /**
     * @return Collection
     */
    public function showSuggests(): Collection
    {
        return $this->ownFriends->map(function ($friend) {
           return $friend->getFriends()
               ->filter(function ($friendFromFriend) use ($friend) {
                    return $friendFromFriend->id != \Auth::id();
               });
        })->collapse()
            ->take(self::SUGGEST_LIMIT);
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
            ->where('pseudo', '!=', \Auth::user()->pseudo)
            ->orWhere('hashtag', 'LIKE', "%$this->query%")
            ->orWhere('name', 'LIKE', "%$this->query%")
            ->whereNotIn('id', $this->ownFriends->map(function ($friend) {
                return $friend->id;
            }))
            ->limit(self::LIMIT)
            ->get();
    }

    public function getMessages()
    {
        return Message::whereHas('member', function ($query) {
                return $query->where('user_id', '=', \Auth::id());
            })->where('message', 'LIKE', "%$this->query%")
            ->limit(self::LIMIT)
            ->get();
    }

    public function render()
    {
        if (empty($this->query)) {
            $this->suggests = $this->showSuggests();
        } else {
            $this->friends = $this->getSearchingFriends();
            $this->others = $this->getOtherPeople();
            $this->messages = $this->getMessages();
        }

        return view('livewire.search-bar');
    }
}
