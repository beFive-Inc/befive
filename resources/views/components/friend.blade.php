<article class="friend">
    <div class="friend__img_container
            @if($friend->isOnline())
                online
            @else
                offline
            @endif">
        @if($friend->media->count())
            <img src="{{ $friend->media[0]->getFullUrl() }}" class="friend__img" alt>
        @else
            <img src="" class="friend__img" alt>
        @endif
    </div>
    <div class="friend__info">
        <h3 aria-level="3" role="heading" class="friend__pseudo">
            <a href="{{ route('user.show', $friend->slug) }}" class="friend__link">{{ $friend->pseudo }}</a>
        </h3>
        <p class="last_online">
            {{ $friend->onlineStatus }}
        </p>
    </div>
    <div>
        {{ $slot }}
    </div>
</article>
