<header class="header-m">
    <div class="profile-container">
        <a class="back"
           href="{{ route('homepage') }}">
            <span class="sr_only">{{ __('app.back') }}</span>
        </a>

        <div class="profile">
            <div class="profile__img_container">
                @foreach($otherInGroup->take(1) as $author)
                    @if($loop->first)
                        <img src="{{ $author->user?->getFirstMedia('profile')?->getUrl() ?? asset('parts/user/profile_img.webp') }}" class="profile__img first" alt>
                    @elseif($loop->last)
                        <img src="{{ $author->user?->getFirstMedia('profile')?->getUrl() ?? asset('parts/user/profile_img.webp') }}" class="profile__img second" alt>
                    @endif
                @endforeach
            </div>
            <h1 role="heading"
                aria-level="1"
                class="profile__name">
                @if($chatroom->name)
                    {{ $chatroom->name }}
                @else
                    @foreach($otherInGroup as $author)
                        @if($loop->last)
                            {{ $author->user->pseudo }}
                        @else
                            {{ $author->user->pseudo }},
                        @endif
                    @endforeach
                @endif
            </h1>
        </div>
    </div>

    <button class="btn-info"
            type="button"
            data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasRight"
            aria-controls="offcanvasRight">
        <span class="sr_only">{{ __('app.info') }}</span>
    </button>

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
