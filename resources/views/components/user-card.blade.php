<section class="user_card">
    @if(auth()->user()->getMedia('user_banner_pic')->last())
        <div class="user_card__bannerpic">
            <img src="{{ auth()->user()->getMedia('user_banner_pic')->last()->getFullUrl() }}"
                 alt>
        </div>
    @endif

    @if(auth()->user()->getMedia('user_profile_pic')->last())
        <div class="user_card__profilpic">
            <img src="{{ auth()->user()->getMedia('user_profile_pic')->last()->getFullUrl() }}"
                 alt>
        </div>
    @endif

    <div class="user_card__info">
        <h2 aria-level="2" role="heading" class="user_card__title">
            {{ auth()->user()->pseudo }} <span class="user_card__hashtag">{{ '#' . auth()->user()->hashtag }}</span>
        </h2>
        <p class="user_card__name">
            {{ auth()->user()->name }}
        </p>
    </div>
</section>
