<article class="friend">
    <div class="friend__container {{ $onlyImageAndName ? 'special' : '' }}">
        <div class="friend__img_container status
        {{ $friend->sessions->last()->last_activity >= \Carbon\Carbon::now() && $friend->type->name ? Str::slug($friend->type->name) : 'offline' }}">
            <img src="{{ $friend->media?->first()?->getUrl() ?? asset('parts/user/profile_img.webp') }}" class="friend__img" alt>
        </div>

        <div class="friend__info">
            <h4 aria-level="4" role="heading" class="friend__pseudo">
                {{ $friend->pseudo }}
            </h4>
            @if(!$onlyImageAndName)
                <p class="friend__hashtag">
                    {{ $getStatusMessage ? __($friend->statusMessage) : '#' . $friend->hashtag }}
                </p>
            @endif
        </div>
    </div>
   @if($actions)
        <div class="actions">
            {{ $slot }}
        </div>
    @endif
</article>
