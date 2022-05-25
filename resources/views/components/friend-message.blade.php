<article class="friend">
    <div class="friend__img_container
            @if(true)
                online
            @else
                offline
            @endif">
        @if(true)
            <img src="@foreach($chatroom->members as $member){{ $member->user?->getFirstMedia('profile')?->getUrl() }}@endforeach" class="friend__img" alt>
        @else
            <img src="" class="friend__img" alt>
        @endif
    </div>
    <div class="friend__info">
        <h3 aria-level="3"
            role="heading"
            class="friend__pseudo"
            data-bs-toggle="tooltip"
            data-bs-placement="right"
            data-bs-html="true"
            title='<x-data-title :chatroom="$chatroom"/>'>
            <a href="{{ route('messages.show', $chatroom->uuid) }}" class="friend__link">
                @if($chatroom->name)
                    {{ $chatroom->name->title }}
                @else
                    @foreach($chatroom->members as $member)
                        {{ $member->user->pseudo }}
                    @endforeach
                @endif
            </a>
        </h3>
        <p class="last_online">
            {{ $chatroom->messages->last()->message }}
        </p>
    </div>
    <div>
        <button type="button" class="btn btn-secondary dropdown-toggle show" data-bs-toggle="dropdown" aria-expanded="true">
            <img src="" alt="">
        </button>
        <ul class="dropdown-menu" data-popper-placement="bottom-end">
            <li><a class="dropdown-item" href="#">Bloquer la personne</a></li>
            <li><a class="dropdown-item" href="#">Archiver la conversation</a></li>
        </ul>
    </div>
</article>
