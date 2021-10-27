<article class="friend_list__friend friend">
    <div class="friend__img_container">
        <img src="" class="friend__img" alt="{{ __('Image de couverture de ') . $friend->pseudo }}">
    </div>
    <div class="friend__info">
        <h3 aria-level="3" role="heading" class="friend__pseudo">
            <a href="" class="friend__link">{{ $friend->pseudo }}</a>
        </h3>
        <p>
            @if($friend->isOnline())
                {{ __('En ligne') }}
            @else
                {{ __('Hors ligne') }}
            @endif
        </p>
    </div>
</article>
