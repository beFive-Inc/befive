<x-layout :friends="$friends" :request-friends="$requestFriends" :medias="$medias" :chatrooms="$chatrooms" :requested-canals="$requestCanals">
    <x-slot name="title">
        {{ __('Be Five | Homepage') }}
    </x-slot>

    <x-slot name="metaData">

    </x-slot>

    <x-slot name="content">
        <section class="accordion-item">
            <h2 aria-level="2" role="heading" class="page__title">
                {{ __('app.notifications') }}
            </h2>
            <div class="searchbar__query_container">
                @if($requestCanals->count())
                    <section>
                        <div class="flex-between">
                            <h3 role="heading"
                                aria-level="3"
                                class="page__semi-title">
                                {{ __('app.notifications.canals.requests') }} <span class="number">{{ $requestCanals->count() }}</span>
                            </h3>
                            <a href="{{ route('notification.canals') }}" class="link">{{ __('app.view-all') }}</a>
                        </div>
                        <div class="searchbar__query_container">
                            @foreach($requestCanals as $requestCanal)
                                <x-canal :chatroom="$requestCanal">
                                    <form action="{{ route('chatroom.accept') }}" method="post">
                                        @csrf
                                        @method('put')

                                        <input type="hidden" name="author_id" value="{{ $requestCanal->authors->filter(function ($author) {
                                            return $author->user->id === auth()->id();
                                        })->first()->id }}">

                                        <button class="action action__canal-accept">
                                            <span class="sr_only">
                                                {{ __('app.chatroom.accept') }}
                                            </span>
                                        </button>
                                    </form>

                                    <form action="{{ route('chatroom.deny') }}" method="post">
                                        @csrf
                                        @method('put')

                                        <input type="hidden" name="author_id" value="{{ $requestCanal->authors->filter(function ($author) {
                                            return $author->user->id === auth()->id();
                                        })->first()->id }}">

                                        <button class="action action__canal-deny danger">
                                            <span class="sr_only">
                                                {{ __('app.chatroom.deny') }}
                                            </span>
                                        </button>
                                    </form>
                                </x-canal>
                            @endforeach
                        </div>
                    </section>
                @else
                    <p class="no_item">
                        {{ __('app.no-notifications.canals') }}
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
