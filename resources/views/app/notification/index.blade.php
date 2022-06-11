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
                @if($requestFriends->count() || $requestCanals->count())
                    @if($requestFriends->count())
                        <section>
                            <h3 aria-level="3"
                                role="heading"
                                class="page__semi-title">
                                {{ __('app.notifications.friends.requests') }}
                            </h3>
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
                    @endif
                    @if($requestCanals->count())
                        <section>
                            <h3 role="heading"
                                aria-level="3"
                                class="page__semi-title">
                                {{ __('app.notifications.canals.requests') }}
                            </h3>
                            <div class="searchbar__query_container">
                                @foreach($requestCanals as $requestCanal)
                                    <x-canal :chatroom="$requestCanal">
                                        <form action="" method="post">
                                            @csrf
                                            @method('put')

                                            <input type="hidden" name="author_id" value="">

                                            <button class="action action__canal-accept">
                                                <span class="sr_only">
                                                    {{ __('app.chatroom.accept') }}
                                                </span>
                                            </button>
                                        </form>

                                        <form action="" method="post">
                                            @csrf
                                            @method('put')

                                            <input type="hidden" name="author_id" value="">

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
                    @endif
                @else
                    <p class="no_item">
                        {{ __('app.chatroom.no-archive') }}
                    </p>
                @endif
            </div>
        </section>
    </x-slot>

    <x-slot name="script">

    </x-slot>
</x-layout>
