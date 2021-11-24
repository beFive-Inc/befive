<section class="friends">
    <input type="hidden"
           x-data="{}"
           x-init="setInterval(() =>
           {
                if($wire.generalView
                ){
                    $wire.refresh()
                }
           }, $wire.intervalRefresh);"/>

    <h2 aria-level="2"
        role="heading"
        class="friends__title">
        {{ __('friends.title') }}
    </h2>

    <form action="#" method="get" class="header__form form">
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

    <nav role="navigation"
         class="friends__nav nav">
        <h3 aria-level="3"
            role="heading"
            class="sr_only">
            {{ __('friends.group.title') }}
        </h3>
        <ul class="nav__list">
            <li wire:click="getGeneralView">
                <a href="#" class="{{ $generalView ? 'active' : '' }}">
                    {{ __('friends.group.general') }}
                </a>
            </li>
            <li wire:click="getRequestedView">
                <a href="#"
                   class="{{ $requestedView ? 'active' : '' }}">
                    {{ __('friends.group.request') }}
                </a>
            </li>
        </ul>
    </nav>

    <div class="friends__container">
        @if($friends->count())
            @foreach($friends as $friend)
                <x-friend :friend="$friend">
                    @if ($requestedView)
                        @if(!$this->isFriendWith($friend->id))
                            <button wire:click="acceptFriendRequest({{ $friend->id }})">
                                {{ __('friends.accept') }}
                            </button>
                            <button wire:click="denyFriendRequest({{ $friend->id }})">
                                {{ __('friends.deny') }}
                            </button>
                        @endif
                    @endif
                </x-friend>
            @endforeach
        @else
            @if($generalView)
                <p>
                    {{ __('friends.group.general.no-friends') }}
                </p>
            @elseif($requestedView)
                <p>
                    {{ __('friends.group.request.no-friends') }}
                </p>
            @endif
        @endif
    </div>
</section>

