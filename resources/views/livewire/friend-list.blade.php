<div class="friends" wire:poll.30000ms>
    <section class="friends">
        <h2 aria-level="2"
            role="heading"
            class="page__title">
            {{ __('friends.title') }}
        </h2>

        <nav class="nav">
            <h3 aria-level="2"
                role="heading"
                class="sr_only">
                {{ __('friends.nav.title') }}
            </h3>
            <ul class="nav__container">
                @foreach($navItems as $key => $item)
                    <li class="nav__item">
                        <a class="nav__link {{ $item['isActive'] ? 'active' : '' }}"
                           wire:click.prevent="changeData('{{$key}}')">
                            {{ $item['title'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>

        <div class="searchbar">
            <form action="#"
                  method="get"
                  class="form special"
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
        </div>

        <div class="friends__container">
            @if($friends->count())
                @foreach($friends as $friend)
                    <x-friend :friend="$friend" :get-status-message="true"></x-friend>
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
