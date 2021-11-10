<section class="friend_list">
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
        class="friend_list__title">
        {{ __('Liste d\'amis') }}
    </h2>

    <form action="#" method="get">
        <input type="search" name="search" wire:model.debounce.200ms="searchQuery">
    </form>

    <button wire:click="getGeneralView">
        General
    </button>
    <button wire:click="getRequestedView">
        Requête
    </button>
    <button wire:click="getOnlineView">
        En ligne
    </button>
    <button wire:click="getOfflineView">
        Hors ligne
    </button>

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
        @if($this->generalView)
            <p>
                {{ ('Vous n\'avez pas encore d\'amis.') }}
            </p>
        @elseif($this->requestedView)
            <p>
                {{ ('Vous n\'avez aucune requête pour le moment.') }}
            </p>
        @elseif($this->onlineView)
            <p>
                {{ ('Aucun de vos amis n\'est actuellement connecté.') }}
            </p>
        @elseif($this->offlineView)
            <p>
                {{ ('Aucun de vos amis n\'est actuellement hors ligne.') }}
            </p>
        @endif
    @endif
</section>

