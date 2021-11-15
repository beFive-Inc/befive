<section class="friends">
    <input type="hidden"
           x-data="{}"
           x-init="setInterval(() =>
           {
                if($wire.generalView
                    || $wire.onlineView
                    || $wire.offlineView
                ){
                    $wire.refresh()
                }
           }, $wire.intervalRefresh);"/>

    <h2 aria-level="2"
        role="heading"
        class="friends__title">
        {{ __('Mes amis') }}
    </h2>

    <form action="#" method="get" class="header__form form">
        <button class="form__btn">
            <img src="" alt>
        </button>
        <div class="form__search_container">
            <label for="search" class="sr_only" aria-hidden="{{ __('Rechercher un joueur') }}">{{ __('Rechercher') }}</label>
            <input type="search" id="search" class="form__search" wire:model.debounce.100ms="searchQuery" name="s" placeholder="{{ __('Rechercher un joueur') }}">
        </div>
    </form>


    <nav role="navigation" class="friends__nav nav">
        <h3 aria-level="3" role="heading" class="sr_only">
            {{ __('Navigations des amis') }}
        </h3>
        <ul class="nav__list">
            <li wire:click="getGeneralView">
                <a href="#"
                    @if($generalView)
                        class="active"
                    @endif>{{ __('Général') }}</a>
            </li>
            <li wire:click="getRequestedView">
                <a href="#"
                    @if($requestedView)
                        class="active"
                    @endif>{{ __('Requête') }}</a>
            </li>
            <li wire:click="getOnlineView">
                <a href="#"
                    @if($onlineView)
                        class="active"
                    @endif>{{ __('En ligne') }}</a>
            </li>
            <li wire:click="getOfflineView">
                <a href="#"
                    @if($offlineView)
                        class="active"
                    @endif>{{ __('Hors ligne') }}</a>
            </li>
        </ul>
    </nav>

    <div class="friends__container">
        @if($friends->count())
            @foreach($friends as $friend)
                <x-friend :friend="$friend">
                    @if(!$this->isFriendWith($friend->id))
                        <button wire:click="acceptFriendRequest({{ $friend->id }})">
                            Accepter
                        </button>
                        <button wire:click="denyFriendRequest({{ $friend->id }})">
                            Décliner
                        </button>
                    @endif
                </x-friend>
            @endforeach
        @else
            @if($generalView)
                <p>
                    {{ ('Vous n\'avez pas encore d\'amis.') }}
                </p>
            @elseif($requestedView)
                <p>
                    {{ ('Vous n\'avez aucune requête pour le moment.') }}
                </p>
            @elseif($onlineView)
                <p>
                    {{ ('Aucun de vos amis n\'est actuellement connecté.') }}
                </p>
            @elseif($offlineView)
                <p>
                    {{ ('Aucun de vos amis n\'est actuellement hors ligne.') }}
                </p>
            @endif
        @endif
    </div>
</section>

