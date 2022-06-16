<div class="friends" wire:poll.30000ms>
    <section class="friends">
        <h2 aria-level="2"
            role="heading"
            class="page__title">
            {{ __('friends.title') }}
        </h2>

        <nav class="nav">
            <h3 aria-level="3"
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
            @if(!$navItems['add']['isActive'])
                @if($friends->count())
                    @foreach($friends as $friend)
                        <x-friend
                            :friend="$friend"
                            :get-status-message="$navItems['all']['isActive'] || $navItems['online']['isActive'] ? true : false"
                            :actions="$navItems['request']['isActive'] ? true : false"
                            :options="$navItems['request']['isActive'] ? false : true"
                            :is-friend="$navItems['all']['isActive'] || $navItems['online']['isActive'] ? true : false"
                            :is-asked="$navItems['sended']['isActive'] ? true : false"
                            :is-blocked="$navItems['blocked']['isActive'] ? true : false">
                            @if($navItems['request']['isActive'])
                                <form method="post" action="{{ route('friends.accept') }}">
                                    @csrf
                                    @method('put')

                                    <input type="hidden" name="uuid" value="{{ $friend->uuid }}">

                                    <button class="action action__friend-accept">
                                        <span class="sr_only">
                                            {{ __('friends.accept') }}
                                        </span>
                                    </button>
                                </form>

                                <form method="post" action="{{ route('friends.deny') }}">
                                    @csrf
                                    @method('put')

                                    <input type="hidden" name="uuid" value="{{ $friend->uuid }}">

                                    <button class="action action__friend-deny danger">
                                        <span class="sr_only">
                                            {{ __('friends.deny') }}
                                        </span>
                                    </button>
                                </form>
                            @endif
                        </x-friend>
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
            @else
                <section class="auth special-auth">
                    <h3 aria-level="3" role="heading" class="page__title block nomargin">
                        {{ __('friends.send-request.title') }}
                    </h3>
                    <form action="{{ route('friends.add.hashtag') }}" class="form special-form" method="post" wire:submit.prevent="submit">
                        @csrf

                        <div class="form__field">
                            <label for="pseudo"
                                   data-bs-toggle="tooltip"
                                   data-bs-placement="top"
                                   title="{{ __('friends.send-request.notice') }}"
                                   class="form__label">
                                {{  __('friends.send-request.label') }}
                            </label>

                            <input type="text"
                                   id="pseudo"
                                   name="pseudo"
                                   class="form__input @error('pseudo'){{ 'error' }}@enderror"
                                   placeholder="{{ __('friends.send-request.placeholder')}}"
                                   autocomplete="pseudo"
                                   wire:model="pseudo"
                                   required>

                            @error('pseudo')
                                <span class="error">
                                    {{ $message }}
                                </span>
                            @enderror
                            @if($success)
                                <span class="success">
                                    {{ $success }}
                                </span>
                            @endif
                        </div>

                        <button class="btn btn-primary">
                            {{ __('friends.send-request.submit') }}
                        </button>
                    </form>
                </section>
            @endif
        </div>
    </section>
</div>
