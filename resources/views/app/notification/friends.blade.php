<x-layout :friends="$friends" :request-friends="$requestFriends" :medias="$medias" :chatrooms="$chatrooms" :requested-canals="$requestCanals">
    <x-slot name="title">
        {{ __('Be Five Chat | Notifications | Amis') }}
    </x-slot>

    <x-slot name="metaData">

    </x-slot>

    <x-slot name="content">
        <section class="accordion-item">
            <h2 aria-level="2" role="heading" class="page__title">
                {{ __('app.notifications') }}
            </h2>
            <div class="searchbar__query_container">
                @if($requestFriends->count())
                    <section>
                        <div class="flex-between">
                            <h3 aria-level="3"
                                role="heading"
                                class="page__semi-title">
                                {{ __('app.notifications.friends.requests') }} <span class="number">{{ $requestFriends->count() }}</span>
                            </h3>
                        </div>
                        <div class="searchbar__query_container">
                            @foreach($requestFriends as $requestFriend)
                                <x-friend :friend="$requestFriend">
                                    <form method="post" action="{{ route('friends.accept') }}">
                                        @csrf
                                        @method('put')

                                        <input type="hidden" name="uuid" value="{{ $requestFriend->uuid }}">

                                        <button class="action action__friend-accept">
                                            <span class="sr_only">
                                                {{ __('friends.accept') }}
                                            </span>
                                        </button>
                                    </form>

                                    <form method="post" action="{{ route('friends.deny') }}">
                                        @csrf
                                        @method('put')

                                        <input type="hidden" name="uuid" value="{{ $requestFriend->uuid }}">

                                        <button class="action action__friend-deny danger">
                                            <span class="sr_only">
                                                {{ __('friends.deny') }}
                                            </span>
                                        </button>
                                    </form>
                                </x-friend>
                            @endforeach
                        </div>
                    </section>
                @else
                    <p class="no_item">
                        {{ __('app.no-notifications.friends') }}
                    </p>
                @endif
            </div>
        </section>
    </x-slot>

    <x-slot name="script">
        <script>
            Echo.channel("user.{{ auth()->id() }}")
                .listen('FriendAdded', (e) => {
                    window.livewire.emit('friendAdded');
                });
        </script>
    </x-slot>
</x-layout>
