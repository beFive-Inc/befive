<header class="header-m">
    <div class="profile-container">
        <a class="back"
           href="{{ route('homepage') }}">
            <span class="sr_only">{{ __('app.back') }}</span>
        </a>

        <div class="profile">
            <div class="profile__img_container">
                @if($chatroom->isConversation)
                    @foreach($otherInGroup->take(1) as $author)
                        <img src="{{ $author->user?->getFirstMedia('profile')?->getUrl() ?? asset('parts/user/profile_img.webp') }}" class="profile__img first" alt>
                    @endforeach
                @else
                    @foreach($otherInGroup->take(2) as $author)
                        @if($loop->first)
                            <img src="{{ $author->user?->getFirstMedia('profile')?->getUrl() ?? asset('parts/user/profile_img.webp') }}" class="profile__img first" alt>
                        @elseif($loop->last)
                            <img src="{{ $author->user?->getFirstMedia('profile')?->getUrl() ?? asset('parts/user/profile_img.webp') }}" class="profile__img second" alt>
                        @endif
                    @endforeach
                @endif
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
            <button type="button" class="btn-back" data-bs-dismiss="offcanvas" aria-label="Close">
                <span class="sr_only">{{ __('app.back') }}</span>
            </button>
        </div>
        <div class="offcanvas-body">
            <section>
                <div class="header-m__img-container">
                    @foreach($chatroom->authors->shuffle()->take(2) as $author)
                        @if($loop->first)
                            <img src="{{ $author->user?->getMedia('profile')?->last()?->getUrl() ?? asset('parts/user/profile_img.webp') }}"
                                 class="chatroom__img first"
                                 alt="Photo de profil de {{ $author->user->pseudo }}">
                        @endif
                        @if($loop->last)
                            <img src="{{ $author->user?->getMedia('profile')?->last()?->getUrl() ?? asset('parts/user/profile_img.webp') }}"
                                 class="chatroom__img second"
                                 alt="Photo de profil de {{ $author->user->pseudo }}">
                        @endif
                    @endforeach
                    <div class="box third">
                        {{ '+' . $chatroom->authors->count() - 2 }}
                    </div>
                </div>
                <h2 aria-level="2" role="heading" class="page__title header-m__title">
                    @if($chatroom->isConversation)
                        {{ $otherInGroup->first()->name ?? $otherInGroup->first()->user->pseudo }}
                    @else
                        @if($chatroom->name)
                            {{ $chatroom->name }}
                        @else
                            @foreach($chatroom->authors->take(3) as $author)
                                @if($loop->last)
                                    {{ $author->user->pseudo }}
                                @else
                                    {{ $author->user->pseudo }},
                                @endif
                            @endforeach
                        @endif
                    @endif
                </h2>
            </section>
        </div>
    </div>
</header>
