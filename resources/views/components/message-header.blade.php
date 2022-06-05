<header class="header">
    <a href="{{ route('homepage') }}">{{ __('Revenir en arrière') }}</a>

    <h1 role="heading" aria-level="1">
        @if($chatroom->name)
            {{ $chatroom->name }}
        @else
            @foreach($chatroom->authors as $author)
                @if($loop->last)
                    {{ $author->user->pseudo }}
                @else
                    {{ $author->user->pseudo }},
                @endif
            @endforeach
        @endif
    </h1>

    <div>
        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
            Info
        </button>

    </div>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasRightLabel">Offcanvas right</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            ...
        </div>
    </div>
</header>
