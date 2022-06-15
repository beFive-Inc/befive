<div class="searchbar">
    <form action="/search"
          method="get"
          class="form">
        <div class="form__btn">
            <img src="{{ asset('parts/icons/outline/search-normal-1.svg') }}"
                 alt>
        </div>
        <div class="form__search_container">
            <label for="search"
                   class="sr_only"
                   aria-hidden="{{ __('friends.field.search.placeholder') }}">
                {{ __('friends.field.search') }}
            </label>
            <input type="search"
                   id="search"
                   class="form__search"
                   name="query"
                   placeholder="{{ __('friends.field.search.placeholder') }}"
                   wire:model.debounce.400ms="query">
        </div>
    </form>
    <div class="modal-scrollable">
        @if(empty($query))
            <section class="searchbar__container">
                <h2 aria-level="2" role="heading" class="title">
                    {{ __('search.suggestion') }}
                </h2>
                <div class="searchbar__query_container">
                    @foreach($suggestsFriends as $friend)
                        <x-friend :friend="$friend" :options="false" :actions="true">
                            <form action="{{ route('chatroom.store') }}" method="post">
                                @csrf
                                <input type="hidden" name="friends[]" value="{{ $friend->uuid }}">
                                <button class="action action__talk">
                                    <span class="sr_only">{{ __('friends.talk') }}</span>
                                </button>
                            </form>

                            <form method="post" action="{{ route('friends.add') }}">
                                @csrf
                                @method('post')

                                <input type="hidden" name="uuid" value="{{ $friend->uuid }}">

                                <button class="action action__friend-accept">
                                    <span class="sr_only">
                                        {{ __('friends.add') }}
                                    </span>
                                </button>
                            </form>
                        </x-friend>
                    @endforeach

                    @foreach($suggestsCanals as $canal)
                        <x-canal :chatroom="$canal">
                            <form action="{{ route('chatroom.join') }}" method="post">
                                @csrf

                                <input type="hidden" name="canal_uuid" value="{{ $canal->uuid }}">
                                <button class="btn btn-secondary btn-special-padding">
                                    {{ __('app.join') }}
                                </button>
                            </form>
                        </x-canal>
                    @endforeach
                </div>
            </section>
        @else
            @if($friends->count())
                <section class="searchbar__container">
                    <h2 aria-level="2" role="heading" class="title">
                        {{ __('search.friends') }}
                    </h2>

                    <div class="searchbar__query_container">
                        @foreach($friends as $friend)
                            <x-friend :friend="$friend" :actions="true">
                                <form action="{{ route('chatroom.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="friends[]" value="{{ $friend->uuid }}">
                                    <button class="action action__talk">
                                        <span class="sr_only">{{ __('friends.talk') }}</span>
                                    </button>
                                </form>
                            </x-friend>
                        @endforeach
                    </div>
                </section>
            @endif
            @if($others->count())
                <section class="searchbar__container">
                    <h2 aria-level="2" role="heading" class="title">
                        {{ __('search.others') }}
                    </h2>

                    <div class="searchbar__query_container">
                        @foreach($others as $friend)
                            <x-friend :friend="$friend" :actions="true" :options="false">
                                <form action="{{ route('chatroom.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="friends[]" value="{{ $friend->uuid }}">
                                    <button class="action action__talk">
                                        <span class="sr_only">{{ __('friends.talk') }}</span>
                                    </button>
                                </form>

                                <form method="post" action="{{ route('friends.add') }}">
                                    @csrf
                                    @method('post')

                                    <input type="hidden" name="uuid" value="{{ $friend->uuid }}">

                                    <button class="action action__friend-accept">
                                    <span class="sr_only">
                                        {{ __('friends.add') }}
                                    </span>
                                    </button>
                                </form>
                            </x-friend>
                        @endforeach
                    </div>
                </section>
            @endif
            @if($canals->count())
                <section class="searchbar__container">
                    <h2 aria-level="2" role="heading" class="title">
                        {{ __('search.canals') }}
                    </h2>

                    <div class="searchbar__query_container">
                        @foreach($canals as $chatroom)
                            <x-canal :chatroom="$chatroom">
                                <form action="{{ route('chatroom.join') }}" method="post">
                                    @csrf

                                    <input type="hidden" name="canal_uuid" value="{{ $chatroom->uuid }}">
                                    <button class="btn btn-secondary btn-special-padding">
                                        {{ __('app.join') }}
                                    </button>
                                </form>
                            </x-canal>
                        @endforeach
                    </div>
                </section>
            @endif
        @endif
    </div>
</div>
