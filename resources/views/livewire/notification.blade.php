<div>
    <span class="bulle {{ $requestFriends->count() || $requestCanals->count() ? 'notified' : '' }}"></span>
    <a href="{{ route('notification.index') }}"
       type="button"
       data-bs-toggle="dropdown"
       data-bs-auto-close="outside"
       class="dropdown-btn"
       aria-expanded="false">
                <span class="sr_only">
                    {{ __('app.notification') }}
                </span>
    </a>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuClickableInside">
        @if($requestedFriends->count())
            <li class="dropdown-header-container">
                <p class="dropdown-special-header">
                    {{ __('app.friend.request') }}
                    <span class="number">{{ $requestFriends->count() }}</span>
                </p>
                @if($requestFriends->count() > $limit)
                    <a href="{{ route('notification.friends') }}"
                       class="link">{{ __('app.view-all') }}</a>
                @endif
            </li>
            @foreach($requestedFriends as $requestedFriend)
                <li>
                    <x-friend :friend="$requestedFriend">
                        <form method="post"
                              action="{{ route('friends.accept') }}"
                              wire:submit.prevent="acceptFriend('{{$requestedFriend->uuid}}')">
                            @csrf
                            @method('put')

                            <input type="hidden" name="uuid" value="{{ $requestedFriend->uuid }}">

                            <button class="action action__friend-accept">
                            <span class="sr_only">
                                {{ __('friends.accept') }}
                            </span>
                            </button>
                        </form>

                        <form method="post"
                              action="{{ route('friends.deny') }}"
                              wire:submit.prevent="denyFriend('{{$requestedFriend->uuid}}')">
                            @csrf
                            @method('put')

                            <input type="hidden" name="uuid" value="{{ $requestedFriend->uuid }}">

                            <button class="action action__friend-deny danger">
                            <span class="sr_only">
                                {{ __('friends.deny') }}
                            </span>
                            </button>
                        </form>
                    </x-friend>
                </li>
            @endforeach
        @endif

        @if($requestedFriends->count() && $requestedCanals->count())
            <li><hr class="dropdown-divider"></li>
        @elseif(!$requestedFriends->count() && !$requestedCanals->count())
            <li><h6 class="dropdown-header dropdown-nomargin">{{ __('app.notification.none') }}</h6></li>
        @endif

        @if($requestedCanals->count())
            <li class="dropdown-header-container">
                <p class="dropdown-special-header">
                    {{ __('app.notifications.canals.requests') }}
                    <span class="number">{{ $requestCanals->count() }}</span>
                </p>
                @if($requestCanals->count() > $limit)
                    <a href="{{ route('notification.canals') }}"
                       class="link">{{ __('app.view-all') }}</a>
                @endif
            </li>
            @foreach($requestedCanals as $chatroom)
                <li>
                    <x-canal :chatroom="$chatroom">
                        <form action="{{ route('chatroom.accept') }}"
                              method="post"
                              wire:submit.prevent="acceptCanal({{ $chatroom->authors->filter(function ($author) {
                                            return $author->user->id === auth()->id();
                                        })->first()->id }})">
                            @csrf
                            @method('put')

                            <input type="hidden"
                                   name="author_id"
                                   value="{{ $chatroom->authors->filter(function ($author) {
                                            return $author->user->id === auth()->id();
                                        })->first()->id }}">

                            <button class="action action__canal-accept">
                            <span class="sr_only">
                                {{ __('app.chatroom.accept') }}
                            </span>
                            </button>
                        </form>

                        <form action="{{ route('chatroom.deny') }}"
                              method="post" wire:submit.prevent="denyCanal({{ $chatroom->authors->filter(function ($author) {
                                            return $author->user->id === auth()->id();
                                        })->first()->id }})">
                            @csrf
                            @method('put')

                            <input type="hidden"
                                   name="author_id"
                                   value="{{ $chatroom->authors->filter(function ($author) {
                                            return $author->user->id === auth()->id();
                                        })->first()->id }}">

                            <button class="action action__canal-deny danger">
                            <span class="sr_only">
                                {{ __('app.chatroom.deny') }}
                            </span>
                            </button>
                        </form>
                    </x-canal>
                </li>
            @endforeach
        @endif
    </ul>
</div>


