<article class="friend">
    <div class="friend__img_container
            @if(true)
                online
            @else
                offline
            @endif">
        @if(true)
            <img src="" class="friend__img" alt>
        @else
            <img src="" class="friend__img" alt>
        @endif
    </div>
    <div class="friend__info">
        <h3 aria-level="3" role="heading" class="friend__pseudo">
            <a href="{{ route('messages.show', $chatroom->uuid) }}" class="friend__link">
                @if($chatroom->name)
                    {{ $chatroom->name->title }}
                @else
                    @foreach($chatroom->members as $member)
                        @if($loop->last)
                            {{ $member->user->pseudo }}
                        @else
                            {{ $member->user->pseudo }},
                        @endif
                    @endforeach
                @endif
            </a>
        </h3>
        <p class="last_online">
            {{ $chatroom->messages->last()->message }}
        </p>
    </div>
    <div>
        {{ $slot }}
    </div>
</article>
