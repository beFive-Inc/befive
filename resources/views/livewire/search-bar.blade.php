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
                    @foreach($suggests as $suggest)
                        <x-friend :friend="$suggest" :actions="true"/>
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
                                <form action="{{ route('chatroom.create.conversation') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="uuid" value="{{ $friend->uuid }}">
                                    <button>
                                        Parler
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
                            <x-friend :friend="$friend" :actions="true">
                                <form action="{{ route('friends.add') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="uuid" value="{{ $friend->uuid }}">
                                    <button>
                                        Valider
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
                        {{ __('search.messages') }}
                    </h2>

                    <div class="searchbar__query_container">
                        @foreach($canals as $chatroom)
                            <livewire:canal :chatroom="$chatroom"/>
                        @endforeach
                    </div>
                </section>
            @endif
        @endif
    </div>
</div>
