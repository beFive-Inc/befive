<div class="searchbar {{ $isShowed ? 'show' : '' }}">
    <button wire:click="hide">
        Retour en arrière
    </button>
    <form action="/search"
          method="get"
          class="header__form form"
          @if(!$isShowed)
            wire:click="show"
          @endif>
        <button class="form__btn">
            <img src="{{ asset('parts/icons/outline/search-normal-1.svg') }}"
                 alt>
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
                   name="query"
                   placeholder="{{ __('friends.field.search.placeholder') }}"
                   wire:model.debounce.400mx="query">
        </div>
    </form>
    <div>
        @if($isShowed)
            @if(empty($query))
                @foreach($suggests as $suggest)
                    <x-friend :friend="$suggest"/>
                @endforeach
            @else
                @if($friends->count())
                    <p>
                        Amis
                    </p>
                    @foreach($friends as $friend)
                        <x-friend :friend="$friend"/>
                    @endforeach
                @endif
                @if($others->count())
                    <p>
                        Autres
                    </p>
                    @foreach($others as $friend)
                        <x-friend :friend="$friend"/>
                    @endforeach
                @endif
                    @if($messages->count())
                        <p>
                            Messages
                        </p>
                        @foreach($messages as $message)
                            <x-message :message="$message" />
                        @endforeach
                    @endif
            @endif
        @endif
    </div>
</div>
