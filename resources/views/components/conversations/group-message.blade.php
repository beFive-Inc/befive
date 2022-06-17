<article class="chatroom">
    @php
        $ownAuthor = $chatroom->authors->filter(function ($author) {
            return $author->user_id === auth()->id();
        })->first()
    @endphp
    <div class="chatroom__container">
        <div class="chatroom__img_container status
            @if($chatroom->authors->filter(function ($author) {
                return $author->user->sessions->last()->last_activity >= \Carbon\Carbon::now() && $author->user_id != auth()->id();
})->count()) online @else offline @endif">
            @php
                $firstImg = $chatroom->messages->first()->author;
            @endphp
            <div class="chatroom__img second">
                <img src="{{ $firstImg->user?->getMedia('profile')?->last()?->getUrl() ?? asset('parts/user/profile_img.webp') }}"
                     alt="Photo de profil de {{ $firstImg->user->pseudo }}">
            </div>
            @php
                $otherUserImg = $chatroom->authors->filter(function ($author) use ($firstImg) {
                    return $author->user_id != $firstImg->user_id;
                })->shuffle()->first();
            @endphp
            <div class="chatroom__img first">
                <img src="{{ $otherUserImg->user?->getMedia('profile')?->last()?->getUrl() ?? asset('parts/user/profile_img.webp') }}"
                     alt="Photo de profil de {{ $otherUserImg->user->pseudo }}">
            </div>
        </div>
        <div class="chatroom__info">
            <h4 aria-level="4"
                role="heading"
                class="chatroom__name {{ $ownAuthor->isViewed() ? '' : 'new'  }}">
                <a href="{{ route('chatroom.show', $chatroom->uuid) }}" class="chatroom__link">
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
                </a>
            </h4>
            <div class="chatroom__message_container">
                <p class="chatroom__message {{ $ownAuthor->isViewed() ? '' : 'new'  }}">
                    {{ $chatroom->messages->first()->author->user_id === auth()->id() ? __('app.me') : $chatroom->messages->first()->author->user->pseudo }} : {{ $chatroom->messages->first()?->decryptedMessage }}
                </p>
                <p class="chatroom__date">
                    {{ $chatroom->messages->first()?->date }}
                </p>
            </div>
        </div>
    </div>
    <div>
        <button type="button" class="dropdown-options" data-bs-toggle="dropdown" aria-expanded="true">
            <span class="sr_only">{{ __('friends.options') }}</span>
        </button>
        <ul class="dropdown-menu menu" data-popper-placement="bottom-end">
            <li>
                <button class="dropdown-item menu__item menu__rename" data-bs-toggle="modal" data-bs-target="#groupRename-{{ $chatroom->uuid }}">
                    {{ __('app.groups.rename') }}
                </button>
            </li>
            <li>
                <button class="dropdown-item menu__item menu__danger menu__delete" data-bs-toggle="modal" data-bs-target="#chatroomLeave-{{ $chatroom->uuid }}">
                    {{ __('app.groups.leave') }}
                </button>
            </li>
        </ul>

        <div class="modal fade" id="groupRename-{{ $chatroom->uuid }}" tabindex="-1" aria-labelledby="groupRename-{{ $chatroom->uuid }}">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('chatroom.rename') }}"
                              method="post"
                              class="form">
                            @csrf
                            @method('put')

                            <input type="hidden" name="chatroom_uuid" value="{{ $chatroom->uuid }}">

                            <x-field type="text"
                                     name="name"
                                     :id="'name-' . $chatroom->id"
                                     :notice="__('field.group.rename.notice')"
                                     :labeltext="__('field.group.rename.label')"
                                     :placeholder="!empty($chatroom->name) ? $chatroom->name : __('app.placeholder')"
                                     :autocomplete="'name'"
                                     :required="true">
                            </x-field>

                            <div class="modal-footer">
                                <span type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('app.abort') }}</span>
                                <input type="submit" class="btn btn-primary" value="{{ __('field.conversation.rename.submit') }}"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="chatroomLeave-{{ $chatroom->uuid }}" tabindex="-1" aria-labelledby="chatroomLeave-{{ $chatroom->uuid }}">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post"
                              class="form"
                              action="{{ route('chatroom.delete') }}">
                            @csrf
                            @method('delete')

                            <p class="form__question">
                                {!! __('field.group.leave.question') !!}
                            </p>

                            <p class="form__explain">
                                {!! __('field.group.leave.explain') !!}
                            </p>

                            <input type="hidden" name="author_id" value="{{ $chatroom->authors->filter(function ($author) {
                                return $author->user_id === auth()->id(); })->first()->id }}">

                            <div class="modal-footer">
                                <span type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('app.abort') }}</span>
                                <input type="submit" class="btn btn-primary" value="{{ __('field.group.leave.submit') }}"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>
