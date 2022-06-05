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
                        <x-friend :friend="$suggest" :actions-to-search="true"/>
                    @endforeach
                </div>
            </section>
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
    </div>
</div>
