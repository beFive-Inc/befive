<div class="tooltip__container">
    <div class="tooltip__img">
        <img src="@foreach($chatroom->members as $member){{ $member->user?->getFirstMedia('profile')?->getUrl() }}@endforeach" alt="">
    </div>
    <div class="tooltip_info">
        <h3 aria-level="3" role="heading">
            @if($chatroom->name)
                {{ $chatroom->name->title }}
            @else
                @foreach($chatroom->members as $member)
                    {{ $member->user->pseudo }}
                @endforeach
            @endif
        </h3>
        <p>
            {{ $chatroom->messages->last()->message }}
        </p>
    </div>
</div>
