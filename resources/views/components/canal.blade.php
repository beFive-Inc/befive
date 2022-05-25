<article class="friend">
    <div class="friend__info">
        <h3 aria-level="3" role="heading" class="friend__pseudo">
            <a href="{{ route('messages.show', $chatroom->uuid) }}" class="friend__link">
                # {{ $chatroom->name->title }}
            </a>
        </h3>
    </div>
</article>
