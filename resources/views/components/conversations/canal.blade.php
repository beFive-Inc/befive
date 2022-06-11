<article class="chatroom">
    <div class="chatroom__info">
        <h4 aria-level="4" role="heading" class="chatroom__name">
            <a href="{{ route('chatroom.show', $chatroom->uuid) }}" class="chatroom__link">
                # {{ $chatroom->name }}
            </a>
        </h4>

        <p class="chatroom__members">
            {{ $chatroom->authors->count() }} {{ $chatroom->authors->count() == 1 ? __('user.member') : __('user.members') }}
        </p>
    </div>

    <div class="actions">
        {{ $slot }}
    </div>
</article>
