<div>
    <ul class="dropdown-menu" aria-labelledby="dropdownCenterBtn">
        @if($requestedFriends->count())
            <li><p class="dropdown-header">{{ __('app.friend.request') }}</p></li>
            @foreach($requestedFriends as $requestedFriend)
                <li>
                    <x-friend :friend="$requestedFriend"/>
                </li>
            @endforeach
        @endif
        @if($requestedFriends->count())
            <li><hr class="dropdown-divider"></li>
        @else
            <li><h6 class="dropdown-header dropdown-nomargin">{{ __('app.notification.none') }}</h6></li>
        @endif
    </ul>
</div>
