<article class="chatroom">
    <div class="chatroom__container">
        <div class="chatroom__img_container
            @if(true) online @else offline @endif">

            @foreach($chatroom->messages->take(2) as $message)
                @if($loop->first)
                    <img src="{{ $message->author->user?->getFirstMedia('profile')?->getUrl() ?? asset('parts/user/profile_img.webp') }}" class="chatroom__img first" alt>
                @endif
                @if($loop->last)
                    <img src="{{ $message->author->user?->getFirstMedia('profile')?->getUrl() ?? asset('parts/user/profile_img.webp') }}" class="chatroom__img second" alt>
                @endif
            @endforeach
        </div>
        <div class="chatroom__info">
            <h3 aria-level="3" role="heading" class="chatroom__name">
                <a href="{{ route('chatroom.show', $chatroom->uuid) }}" class="chatroom__link">
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
                </a>
            </h3>
            <div class="chatroom__message_container">
                <p class="chatroom__message">
                    {{ $chatroom->messages->first()?->decryptedMessage }}
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
                <button class="dropdown-item menu__item menu__block" data-bs-toggle="modal" data-bs-target="#chatroomCreateWith-{{ $chatroom->uuid }}">
                    {{ __('app.groups.add') }}
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

        <div class="modal fade" id="chatroomCreateWith-{{ $chatroom->uuid }}" tabindex="-1" aria-labelledby="chatroomCreateWith-{{ $chatroom->uuid }}">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content modal-special-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <livewire:chatroom-create :friend-list="$friends" :pre-selected-friends="$chatroom->authors" :pre-selected-friends-are-required="true" :all-chatroom="$allChatrooms"/>
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
                              action="{{ route('chatroom.archive') }}">
                            @csrf
                            @method('delete')

                            <p class="form__question">
                                {!! __('field.group.leave.question') !!}
                            </p>

                            <p class="form__explain">
                                {!! __('field.group.leave.explain') !!}
                            </p>

                            <input type="hidden" name="uuid" value="{{ $chatroom->uuid }}">

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
