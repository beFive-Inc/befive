<article class="friend">
    <div class="friend__container {{ $onlyImageAndName ? 'special' : '' }}">
        <div class="friend__img_container">
            <img src="{{ $friend->media?->first()?->getUrl() ?? asset('parts/user/profile_img.webp') }}" class="friend__img" alt>
        </div>

        <div class="friend__info">
            <h3 aria-level="3" role="heading" class="friend__pseudo">
                {{ $friend->pseudo }}
            </h3>
            @if(!$onlyImageAndName)
                <p class="friend__hashtag">
                    {{ '#' . $friend->hashtag }}
                </p>
            @endif
        </div>
    </div>
    @if($actionsToSearch)
        <div class="actions">
            <form class="chatroom_create" action="{{ route('chatroom.create.conversation') }}" method="post">
                @csrf

                <input type="hidden" name="uuid" value="{{ $friend->uuid }}">

                <button type="submit">
                    <img src="{{ asset('parts/icons/outline/message-circle.svg') }}" alt>
                </button>
            </form>

            <form class="friend_add" action="{{ route('friends.add') }}" method="post">
                @csrf

                <input type="hidden" name="uuid" value="{{ $friend->uuid }}">

                <button type="submit">
                    @if(auth()->user()->hasSentFriendRequestTo($friend))
                        <img src="{{ asset('parts/icons/bold/add-circle.svg') }}" alt>
                    @else
                        <img src="{{ asset('parts/icons/outline/add-circle.svg') }}" alt>
                    @endif
                </button>
            </form>
        </div>
    @endif

    {{ $slot }}
</article>
