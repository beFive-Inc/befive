<article class="chatroom">
    <div class="chatroom__info">
        <h3 aria-level="3" role="heading" class="chatroom__name">
            <a href="{{ route('chatroom.show', $chatroom->uuid) }}" class="chatroom__link">
                # {{ $chatroom->name }}
            </a>
        </h3>

        <p class="chatroom__members">
            {{ $chatroom->authors->count() }} {{ $chatroom->authors->count() == 1 ? __('user.member') : __('user.members') }}
        </p>
    </div>
</article>
