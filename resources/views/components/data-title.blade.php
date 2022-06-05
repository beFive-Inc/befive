<div class="tooltip__container">
    <div class="tooltip__img">
        <img src="{{ $chatroom->authors->first()->user?->getFirstMedia('profile')?->getUrl() ?? asset('parts/user/profile_img.webp') }}" alt="">
    </div>
    <div class="tooltip_info">
        <h3 aria-level="3" role="heading">
            @if($chatroom->name)
                {{ $chatroom->name }}
            @else
                @foreach($chatroom->authors as $author)
                    {{ $author->user->pseudo }}
                @endforeach
            @endif
        </h3>
        <p>
            {{ $chatroom->messages->last()->message }}
        </p>
    </div>
</div>
