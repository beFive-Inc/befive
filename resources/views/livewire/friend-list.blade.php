<section class="friend_list">
    <h2 aria-level="2" role="heading" class="friend_list__title">
        {{ __('Liste d\'amis') }}
    </h2>

    <button wire:click="getGeneralView">
        General
    </button>
    <button wire:click="getRequestedView">
        Requête
    </button>

    @if($friends)
        @foreach($friends as $friend)
            <x-friend :friend="$friend"></x-friend>
        @endforeach
    @endif

    <input type="hidden"
           x-data="{}"
           x-init="setInterval(() => { if($wire.generalView){ $wire.refresh() }}, $wire.intervalRefresh);"/>
</section>

