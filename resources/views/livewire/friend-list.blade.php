<div class="friends_group" wire:poll.30000ms>
    @if($countFriendsRequest)
        <section class="friends request_friends">
            <h2 aria-level="2"
                role="heading"
                class="friends__title">
                {{ __('friends.request.title') . " ($countFriendsRequest)" }}
            </h2>
            @foreach($requestFriends as $friend)
                <x-friend :friend="$friend">
                    @if(!$this->isFriendWith($friend->id))
                        <button wire:click="acceptFriendRequest({{ $friend->id }})">
                            {{ __('friends.accept') }}
                        </button>
                        <button wire:click="denyFriendRequest({{ $friend->id }})">
                            {{ __('friends.deny') }}
                        </button>
                    @endif
                </x-friend>
            @endforeach
        </section>
    @endif
    <section class="friends">
        <h2 aria-level="2"
            role="heading"
            class="friends__title">
            {{ __('friends.title') }}
        </h2>

        <form action="#"
              method="get"
              class="header__form form"
              wire:submit.prevent="refresh">
            <button class="form__btn">
                <img src="{{ asset('parts/icons/outline/search-normal-1.svg') }}" alt/>
            </button>
            <div class="form__search_container">
                <label for="search"
                       class="sr_only"
                       aria-hidden="{{ __('friends.field.search.placeholder') }}">
                    {{ __('friends.field.search') }}
                </label>
                <input type="search"
                       id="search"
                       class="form__search"
                       wire:model.debounce.100ms="searchQuery"
                       name="searchFriend"
                       placeholder="{{ __('friends.field.search.placeholder') }}">
            </div>
        </form>

        <div class="friends__container">
            @if($friends->count())
                @foreach($friends as $friend)
                    <x-friend :friend="$friend"></x-friend>
                @endforeach
            @else
                @if($searchQuery)
                    <p>
                        {{ __('friends.searching.no-friends', ['keyword' => $searchQuery]) }}
                    </p>
                @else
                    <p>
                        {{ __('friends.general.no-friends') }}
                    </p>
                @endif
            @endif
        </div>
    </section>
</div>
