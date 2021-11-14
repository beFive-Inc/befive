<article class="friend">
    <div class="friend__img_container
            @if($friend->isOnline())
                online
            @else
                offline
            @endif">
        <img src="" class="friend__img" alt>
    </div>
    <div class="friend__info">
        <h3 aria-level="3" role="heading" class="friend__pseudo">
            <a href="{{ route('user.show', $friend->slug) }}" class="friend__link">{{ $friend->pseudo }}</a>
        </h3>
    </div>
    <div>
        {{ $slot }}
    </div>
</article>
